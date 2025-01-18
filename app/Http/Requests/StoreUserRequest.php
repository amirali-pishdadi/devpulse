<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            "name"      => ["required", "string", "min:3"],
            "email"     => ["required", "email", "min:3"],
            "username" => ["required", "string", "min:8"],
            "password"  => ["required", "string", "min:8", "confirmed"],
            "is_admin"  => ["required"],
        ];
    }
}
