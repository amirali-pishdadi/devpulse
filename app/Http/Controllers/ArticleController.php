<?php

namespace App\Http\Controllers;

use App\Helper\AiGeneration;
use App\Helper\PersianVoice;
use App\Models\Article;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(6);

        return view("blog.blog", ["articles" => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view("blog.create", ["categories" => $categories]);

    }


    public function like($id)
    {
        $article = Article::findOrFail($id);
        $article->increment('likes_count');
        return response()->json([
            'success'     => true,
            'likes_count' => $article->likes_count,
        ]);
    }


    public function store(Request $request)
    {
        // Validate form data
        $formFields = $request->validate([
            "title"              => ["required", "string", "min:5", "max:255"],
            "content"            => ["required", "string", "min:50"],
            "slug"               => ["required", "unique:articles", "regex:/^[a-z0-9-]+$/", "max:100"],

            "excerpt"            => ["required", "string", "max:255"], // Make excerpt optional if it's optional in the form
            "tags"               => ["required", "string"], // Expecting a comma-separated string
            "category"           => ["required", "string"],
            "featured_image_url" => "required|file|mimes:jpg,png|max:10240", // File upload validation
            "reading_time"       => ["required", "integer", "min:1"],
            "is_pinned"          => ["nullable", "boolean"],

        ]);

        // Get all category names to validate the category selection
        $categories = Category::pluck("slug")->toArray();

        $currentUser = Auth::user();

        // Check if the category exists
        if (!in_array($formFields["category"], $categories)) {
            return redirect()->back()->withErrors(['category' => 'Selected category is invalid.']);
        }

        // Find the Category model instance
        $category = Category::where("slug", $formFields["category"])->first();
        $slug = $formFields["slug"];
        // Handle file upload if provided
        $fileName = null;
        if ($request->hasFile("featured_image_url")) {
            $uploadedFile = $request->file("featured_image_url");
            $fileName = time() . "-" . $slug . "." . $uploadedFile->getClientOriginalName();
            $uploadedFile->move(public_path("uploads/" . $currentUser->username . "/" . $slug), $fileName);
        }

        // Create the article
        $article = Article::create([
            "title"              => $formFields["title"],
            "slug"               => $slug,
            "content"            => $formFields["content"],
            "excerpt"            => $formFields["excerpt"],
            "status"             => "draft",
            "category_id"        => $category->id,
            "author_id"          => Auth::user()->id,
            "featured_image_url" => $fileName,
            "reading_time"       => $formFields["reading_time"],
            "views_count"        => 0,
            "likes_count"        => 0,
            "is_pinned"          => $request->has('is_pinned') ? 1 : 0,

        ]);

        // Process tags
        $tagNames = explode(',', $formFields["tags"]);
        $tagIds = [];
        foreach ($tagNames as $tagName) {
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

        // create telegram message : 
        // $message = AiGeneration::summarizer($article->title, $article->slug);





        return redirect("/articles")->with("message", "مقاله با موفقیت ساخته شد.");
    }


    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $article = Article::with(['user', 'comments', "tags", "category"])->where("slug", $slug)->first();

        $tags = Tag::pluck('name')->toArray(); // Only fetch the names

        if (!$article) {
            abort(404);
        }

        $article->increment('views_count');
        function intWithStyle($n)
        {
            if ($n < 1000)
                return $n;
            $suffix = ['', 'k', 'M'];
            $power = floor(log($n, 1000));
            return round($n / (1000 ** $power), 1, PHP_ROUND_HALF_EVEN) . $suffix[$power];
        }
        ;


        $article->views_count = intWithStyle($article->views_count);
        $relatedArticles = Article::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(4)
            ->get();

        $mostViewedArticle = Article::all()->sortByDesc("views_count")
            ->where('id', '!=', $article->id)

            ->take(6);

        // $summerize = AiGeneration::summarizer($article->content);
        // dd($summerize);


        return view("blog.single-blog", ["article" => $article, "relatedArticles" => $relatedArticles, 'tags' => $tags , "mostViewed" => $mostViewedArticle]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $categories = Category::all();
        $article = Article::where('slug', $slug)->firstOrFail();

        return view("blog.update", ["categories" => $categories, "article" => $article]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        $formFields = $request->validate([
            "title"              => ["required", "string", "min:5", "max:255"],
            "content"            => ["required", "string", "min:50"],
            "slug"               => [
                "required",
                "regex:/^[a-z0-9-]+$/",
                "max:100",
                Rule::unique('articles')->ignore($article->id),
            ],

            "excerpt"            => ["nullable", "string", "max:300"], // Optional
            "tags"               => ["required", "string"], // Comma-separated string
            "category"           => ["required", "string"],
            "featured_image_url" => "nullable|file|mimes:jpg,png|max:10240", // Optional file
            "reading_time"       => ["required", "integer", "min:1"],
        ]);

        $user = Auth::user();
        $categories = Category::pluck("slug")->toArray();


        // Validate category
        if (!in_array($formFields["category"], $categories)) {
            return redirect()->back()->withErrors(['category' => 'Selected category is invalid.']);
        }

        $category = Category::where("slug", $formFields["category"])->first();

        // Check if the user is the author
        if ($article->author_id !== $user->id) {
            return abort(404);
        }

        // Manage image upload
        if ($request->hasFile("featured_image_url")) {
            $oldPicturePath = public_path("uploads/$user->username/$article->slug/") . $article->featured_image_url;

            // Delete old image if it exists
            if (File::exists($oldPicturePath)) {
                File::delete($oldPicturePath);
            }

            // Upload new image
            $uploadedFile = $request->file("featured_image_url");
            $fileName = time() . "-" . $formFields['slug'] . "." . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move(public_path("uploads/" . $user->username . "/" . $formFields['slug']), $fileName);
            $formFields['featured_image_url'] = $fileName;
        } else {
            $formFields['featured_image_url'] = $article->featured_image_url;
        }

        // Update article fields
        $article->update([
            'title'              => $formFields["title"],

            'content'            => $formFields["content"],
            'excerpt'            => $formFields["excerpt"],
            'category_id'        => $category->id,
            'featured_image_url' => $formFields['featured_image_url'],
            'reading_time'       => $formFields["reading_time"],
            'slug'               => $formFields['slug'],
        ]);

        // Process tags
        $tagNames = explode(',', $formFields["tags"]);
        $tagIds = [];
        foreach ($tagNames as $tagName) {
            $tagName = trim($tagName);
            if ($tagName) {
                $tag = Tag::firstOrCreate(
                    ['name' => Str::slug($tagName)],
                    ['title' => $tagName],
                );
                $tagIds[] = $tag->id;
            }
        }

        $article->tags()->sync($tagIds);

        return redirect("/articles")->with("message", "مقاله با موفقیت بروزرسانی گردید.");
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $article = Article::where("slug", $slug)->first();
        $user = Auth::user();

        if (!$article) {
            return back()->with("message", "مقاله مورد نظر یافت نشد !");
        }

        if ($user->is_admin || $user->id == $article->author_id) {
            $article->delete();

            return redirect("/articles")->with("message", "با موفقیت حذف شد !");

        }

        return back()->with("message", "دسترسی ندارید !");


    }
}
