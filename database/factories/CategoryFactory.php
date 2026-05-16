<?php

namespace Database\Factories;

use Database\Seeders\Support\DemoAssetCatalog;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Electronics', 'Fashion', 'Home Appliances', 'Fitness', 'Books',
            'Beauty', 'Gaming', 'Smart Home', 'Outdoor', 'Office Supplies',
        ]) . ' ' . fake()->optional(0.4)->word();

        $cleanName = ucwords(trim($name));

        return [
            'category_name' => $cleanName,
            'category_slug' => Str::slug($cleanName) . '-' . fake()->unique()->numberBetween(10, 999),
            'category_image' => DemoAssetCatalog::categoryImage(fake()->numberBetween(1, 16)),
        ];
    }
}
