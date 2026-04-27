<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $baseCategories = [
            'Electronics',
            'Fashion',
            'Home & Kitchen',
            'Sports',
            'Beauty',
            'Books',
        ];

        foreach ($baseCategories as $name) {
            Category::factory()->create([
                'category_name' => $name,
                'category_slug' => str($name)->slug(),
                'category_image' => 'upload/category/' . fake()->numberBetween(1, 20) . '.jpg',
            ]);
        }

        Category::factory()->count(4)->create();
    }
}
