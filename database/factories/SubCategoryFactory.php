<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubCategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->randomElement([
            'Smartphones', 'Laptops', 'Headphones', 'Sneakers', 'Jackets',
            'Kitchen Tools', 'Supplements', 'Fiction', 'Skincare', 'Monitors',
        ]);

        return [
            'category_id' => Category::factory(),
            'subcategory_name' => $name . ' ' . fake()->optional(0.3)->randomElement(['Series', 'Collection', 'Essentials']),
            'subcategory_slug' => Str::slug($name . '-' . fake()->unique()->numberBetween(100, 999)),
        ];
    }
}
