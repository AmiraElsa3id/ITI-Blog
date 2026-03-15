<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'body' => ['required', 'string', 'min:3'],
        ];
    }

    public function messages(): array
    {
        return [
            'body.required' => 'Comment body is required.',
            'body.min'      => 'Comment must be at least 3 characters.',
        ];
    }
}