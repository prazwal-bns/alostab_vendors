<?php

namespace Database\Factories;

use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogPostFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->unique()->sentence(6);

        return [
            'category_id' => BlogCategory::factory(),
            'post_title' => $title,
            'post_slug' => Str::slug($title),
            'post_image' => 'upload/blog/' . fake()->numberBetween(1, 30) . '.jpg',
            'post_short_description' => fake()->paragraph(),
            'post_long_description' => fake()->paragraphs(4, true),
        ];
    }
}
