<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use App\Http\Controllers\Controller;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return $this->success(['success' => true, 'data' => $tags]);
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
        $formFeilds = $request->validate([
            'name'  => 'required|unique:tags,name|max:255',
            'title' => 'required|string|max:255',

        ]);

        $tag = Tag::create([
            'name'  => Str::slug($formFeilds["name"]),
            "title" => $formFeilds["title"],
        ]);

        return $this->success(['success' => true, 'data' => $tag]);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $tag = Tag::with('articles')->where("name", $slug)->first();

        if (!$tag) {
            return $this->error([
                'error' => 'NOT_FOUND',
            ], 'Tag not found', 404);
        }


        return $this->success(['success' => true, 'data' => $tag], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $tag = Tag::where("name", $slug)->first();

        $formFields = $request->validate([
            'name'  => ['required', Rule::unique('articles', 'slug')->ignore($tag->id), 'max:255'],
            'title' => ['required', 'string', 'max:255'],
        ]);

        if (!$tag) {
            return $this->error([
                'error' => 'NOT_FOUND',
            ], "Tag not found", 404);
        }

        $tag->title = $formFields["title"];
        $tag->name = Str::slug($formFields["name"]);

        $tag->save();

        return $this->success([
            'success' => true,
            'message' => 'Tag updated successfully',
        ], 200);



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $tag = Tag::where("name", $slug)->first();

        if (!$tag) {
            return $this->error([
                'error' => 'NOT_FOUND',
            ], "Tag not found", 404);
        }

        $tag->delete();

        return $this->success([
            'success' => true,
            'message' => 'Tag deleted successfully',
        ], 200);


    }
}
