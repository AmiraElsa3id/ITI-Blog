<?php

namespace App\Http\Requests;

use App\Rules\MaxPostsPerUser;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'min:3', 'unique:posts,title'],
            'description' => ['required', 'string', 'min:10'],
            'user_id'     => ['required', 'exists:users,id', new MaxPostsPerUser((int) $this->user_id)],
            'image'       => ['nullable', 'image', 'mimes:jpg,png', 'max:2048'],
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
            'user_id.required'     => 'Please select a creator.',
            'user_id.exists'       => 'Selected user does not exist.',
            'image.image'          => 'File must be an image.',
            'image.mimes'          => 'Image must be a jpg or png file.',
            'image.max'            => 'Image must not exceed 2MB.',
        ];
    }
}