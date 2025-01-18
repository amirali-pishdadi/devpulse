<?php

namespace App\Http\Requests\Comments;

use Illuminate\Foundation\Http\FormRequest;

class CreateCommentRequest extends FormRequest
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
            "content"    => ["required", "string", "min:3"],
            "article_id" => ["required", "exists:articles,id"],
            "user_id"    => ["required", "exists:users,id"],
        ];
    }
}
