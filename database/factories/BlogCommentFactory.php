<?php

namespace Database\Factories;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogCommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'blog_id' => BlogPost::factory(),
            'user_id' => User::factory()->customer(),
            'blog_comment' => fake()->sentences(2, true),
        ];
    }
}
