<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comments\CreateCommentRequest;
use App\Models\Article;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index($slug)
    {
        $article = Article::with(['user', 'comments'])->where("slug", $slug)->firstOrFail();
        $comments = $article->comments()->with([
            'user' => function ($query) {
                $query->select('id', 'name', 'username');
            }
        ])->get();

        return response()->json([
            'success' => true,
            'data'    => $comments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(CreateCommentRequest $request)
    {
        $formFields = $request->validate([
            "content"    => ["required", "string", "min:3"],
            "article_id" => ["required", "exists:articles,id"],
            "user_id"    => ["required", "exists:users,id"],
        ]);

        $user = Auth::user();
        $article = Article::findOrFail((int) $formFields["article_id"]);

        if ($user->id == $formFields["user_id"] && $article) {
            $comment = Comment::create([
                "user_id"    => $user->id,
                "article_id" => $formFields["article_id"],
                "content"    => $formFields["content"],
            ]);

            return $this->success([
                "comment" => $comment,
            ], "Comment created successfully !");
        }

        return $this->error([], "User ID mismatch or unauthorized action.", 403);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $formFields = $request->validate([
            "content" => ["required", "string", "min:3"],
        ]);

        $user = Auth::user();

        if (!$comment) {
            return $this->error([
                'error' => 'NOT_FOUND',
            ], "Comment not found", $code = 404);
        }
        if ($user->is_admin || $user->id == $comment->user_id) {
            $comment->content = $formFields["content"];

            $comment->save();

            return $this->success([
                'success' => true,
                'message' => "Comment updated successfully",
            ], 200);
        }

        return $this->error([
            'error' => 'UNAUTHORIZED',
        ], 'Unauthorized action', 403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $user = Auth::user();

        if (!$comment) {
            return $this->error([
                'error' => 'NOT_FOUND',
            ], "Comment not found", $code = 404);
        }

        if ($user->is_admin || $user->id == $comment->user_id) {
            $comment->delete();

            return $this->success([
                'message' => 'Comment deleted successfully',
            ], 200);
        }

        return $this->error([
            'error'   => 'UNAUTHORIZED',
        ], 'Unauthorized action', 403);
    }
}
