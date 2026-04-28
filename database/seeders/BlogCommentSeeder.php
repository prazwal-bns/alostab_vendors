<?php

namespace Database\Seeders;

use App\Models\BlogComment;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogCommentSeeder extends Seeder
{
    public function run(): void
    {
        $posts = BlogPost::pluck('id');
        $users = User::where('role', 'user')->pluck('id');

        if ($posts->isEmpty() || $users->isEmpty()) {
            return;
        }

        foreach ($posts as $postId) {
            foreach (range(1, fake()->numberBetween(1, 5)) as $i) {
                BlogComment::factory()->create([
                    'blog_id' => $postId,
                    'user_id' => $users->random(),
                ]);
            }
        }
    }
}
