<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateArticleRequest;
use App\Models\Tag;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with(['user', 'comments'])->latest()->take(4)->get();
        return $this->success(['success' => true, 'data' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "title"              => ["required", "string", "min:5", "max:255"],
            "slug"               => ["required", "string", "unique:articles,slug", "max:255"],
            "content"            => ["required", "string", "min:50"],
            "excerpt"            => ["nullable", "string", "max:255"],
            "tags"               => ["nullable", "array"],
            "tags.*"             => ["string", "distinct"],
            "status"             => ["required"],
            "category_id"        => ["nullable", "exists:categories,id"],
            "author_id"          => ["required", "exists:users,id"],
            "featured_image_url" => ["nullable", "string"],
            "reading_time"       => ["nullable", "integer", "min:1"],
            "views_count"        => ["required", "integer"],
            "likes_count"        => ["required", "integer"],
            "is_pinned"          => ["nullable", "boolean"],

        ]);

        
        $tags = is_array($request->tags) ? json_encode($request->tags) : json_encode([]);

        $article = Article::create([
            "title"              => $request->title,
            "slug"               => $request->slug,
            "content"            => $request->content,
            "excerpt"            => $request->excerpt,
            "status"             => $request->status,
            "category_id"        => $request->category_id,
            "author_id"          => Auth::user()->id,
            "featured_image_url" => $request->featured_image_url,
            "reading_time"       => $request->reading_time,
            "views_count"        => $request->views_count,
            "likes_count"        => $request->likes_count,
            "is_pinned"        => $request->is_pinned,

        ]);

        $tagIds = [];
        foreach ($request->tags as $tagName) {
            $tagName = trim($tagName);
            if ($tagName) {
                $tag = Tag::firstOrCreate(
                    [
                        'name' => Str::slug($tagName),
                    ],
                    [
                        'title' => $tagName,

                    ],

                );
                $tagIds[] = $tag->id;
            }
        }

        $article->tags()->sync($tagIds);
        
        return $this->success([
            "article" => $article,

        ], "article created succsesfully");


    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $article = Article::with(['user', 'comments'])->where("slug", $slug)->first();

        if (!$article) {
            return response()->json([
                'success' => false,
                'message' => 'Article not found',
                'error'   => 'NOT_FOUND',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => [
                'article' => $article,
            ],
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $article = Article::where("slug", $slug)->first();

        $formFields = $request->validate([
            "title"              => ["required", "string", "min:5", "max:255"],
            "slug"               => [
                "required",
                "string",
                "max:255",
                Rule::unique('articles', 'slug')->ignore($article->id)
            ],
            "content"            => ["required", "string", "min:50"],
            "excerpt"            => ["nullable", "string", "max:255"],
            "tags"               => ["nullable", "array"],
            "tags.*"             => ["string", "distinct"],
            "status"             => ["required"],
            "category_id"        => ["nullable", "exists:categories,id"],
            "featured_image_url" => ["nullable", "string"],
            "reading_time"       => ["nullable", "integer", "min:1"],
            "views_count"        => ["required", "integer"],
            "likes_count"        => ["required", "integer"],
        ]);

        $user = Auth::user();
        if (!$article) {
            return response()->json([
                'success' => false,
                'message' => 'Article not found',
                'error'   => 'NOT_FOUND',
            ], 404);
        }

        if ($user->is_admin || $user->id == $article->author_id) {

            $tagIds = [];
            foreach ($request->tags as $tagName) {
                $tagName = trim($tagName);
                if ($tagName) {
                    $tag = Tag::firstOrCreate(
                        [
                            'name' => Str::slug($tagName),
                        ],
                        [
                            'title' => $tagName,

                        ],

                    );
                    $tagIds[] = $tag->id;
                }
            }

            $article->tags()->sync($tagIds);

            
            $article->title = $formFields["title"];
            $article->slug = $formFields["slug"];
            $article->content = $formFields["content"];
            $article->status = $formFields["status"];
            $article->category_id = $formFields["category_id"];
            $article->featured_image_url = $formFields["featured_image_url"];
            $article->reading_time = $formFields["reading_time"];
            $article->views_count = $formFields["views_count"];
            $article->likes_count = $formFields["likes_count"];

            $article->save();

            return response()->json([
                'success' => true,
                'message' => 'Article updated successfully',
            ], 200);
        }


        

        return response()->json([
            'success' => false,
            'message' => 'Unauthorized action',
            'error'   => 'UNAUTHORIZED',
        ], 403);



    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $article = Article::where("slug", $slug)->first();
        $user = Auth::user();

        if (!$article) {
            return response()->json([
                'success' => false,
                'message' => 'Article not found',
                'error'   => 'NOT_FOUND',
            ], 404);
        }

        if ($user->is_admin || $user->id == $article->author_id) {
            $article->delete();

            return response()->json([
                'success' => true,
                'message' => 'Article deleted successfully',
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Unauthorized action',
            'error'   => 'UNAUTHORIZED',
        ], 403);

    }
}
