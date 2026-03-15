<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Only the post owner can update
        return $this->user()->id === $this->route('post')->user_id;
    }

    public function rules(): array
    {
        $postId = $this->route('post')->id; // ✅ route model binding

        return [
            'title'       => ['required', 'string', 'min:3', Rule::unique('posts', 'title')->ignore($postId)],
            'description' => ['required', 'string', 'min:10'],
            'image'       => ['nullable', 'image', 'mimes:jpg,png', 'max:2048'],
            // no user_id — owner is the authenticated user
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'       => 'Title is required.',
            'title.min'            => 'Title must be at least 3 characters.',
            'title.unique'         => 'This title is already taken.',
            'description.required' => 'Description is required.',
            'description.min'      => 'Description must be at least 10 characters.',
            'image.image'          => 'File must be an image.',
            'image.mimes'          => 'Image must be a jpg or png file.',
            'image.max'            => 'Image must not exceed 2MB.',
        ];
    }
}