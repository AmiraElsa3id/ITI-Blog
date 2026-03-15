<?php

namespace App\Http\Requests\Api;

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
            'image'       => ['nullable', 'image', 'mimes:jpg,png', 'max:2048'],
        ];
    }

    // ✅ runs after rules() pass — perfect place for the user-level check
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $rule = new MaxPostsPerUser($this->user()->id);

            $rule->validate('user', $this->user()->id, function ($message) use ($validator) {
                $validator->errors()->add('user', $message);
            });
        });
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