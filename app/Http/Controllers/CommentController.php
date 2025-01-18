<?php

namespace App\Http\Controllers;

use App\Helper\AiGeneration;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            "content"    => ["required", "string", "min:3"],
            "article_id" => ["required", "exists:articles,id"],
            "user_id"    => ["required", "exists:users,id"],
        ]);

        $user = Auth::user();
        $article = Article::findOrFail((int) $formFields["article_id"]);
        // $commentChecker = AiGeneration::commentChecker($formFields["content"]);

        // if ($commentChecker === "true") {
        //     if ($user->id == $formFields["user_id"] && $article) {
        //         $comment = Comment::create([
        //             "user_id"    => $user->id,
        //             "article_id" => $formFields["article_id"],
        //             "content"    => $formFields["content"],
        //             "is_checked" => true,

        //         ]);

        //         return back()->with("message", "کامنت شما با موفقیت تایید شد !");
        //     } else {
        //         return back()->with("message", "User ID mismatch or unauthorized action.");

        //     }
        // } else {
        //     return back()->with("message", "!! کامنت شما به دلیل محتوای نامناسب تایید نشد");

        // }

        if ($user->id == $formFields["user_id"] && $article) {
                $comment = Comment::create([
                    "user_id"    => $user->id,
                    "article_id" => $formFields["article_id"],
                    "content"    => $formFields["content"],
                    "is_checked" => false,

                ]);

                return back()->with("message", "کامنت شما با موفقیت ثبت شد و پس از بازبینی مدیران به نمایش در خواهد آمد .");
            } else {
                return back()->with("message", "User ID mismatch or unauthorized action.");

            }



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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
