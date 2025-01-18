<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
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
            "comments_count"     => ["required", "integer"],
            "likes_count"        => ["required", "integer"],
        ];
    }
}
