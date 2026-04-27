<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $categories = BlogCategory::pluck('id');
        if ($categories->isEmpty()) {
            return;
        }

        foreach (range(1, 24) as $i) {
            BlogPost::factory()->create([
                'category_id' => $categories->random(),
            ]);
        }
    }
}
