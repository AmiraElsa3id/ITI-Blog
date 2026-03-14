<?php

namespace App\Rules;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MaxPostsPerUser implements ValidationRule
{
    public function __construct(private int $userId) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $count = Post::where('user_id', $this->userId)->count();

        if ($count >= 3) {
            $fail('This user has already reached the maximum of 3 posts.');
        }
    }
}