<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogCategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Marketplace News',
            'Seller Tips',
            'Buying Guides',
            'Product Updates',
            'Ecommerce Trends',
            'Customer Stories',
        ]);

        return [
            'blog_category_name' => $name,
            'blog_category_slug' => Str::slug($name),
        ];
    }
}
