<?php

namespace Database\Seeders;

use App\Models\Category;
use Database\Seeders\Support\DemoAssetCatalog;
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

        foreach ($baseCategories as $index => $name) {
            Category::factory()->create([
                'category_name' => $name,
                'category_slug' => str($name)->slug(),
                'category_image' => DemoAssetCatalog::categoryImage($index + 1),
            ]);
        }

        Category::factory()->count(4)->create();
    }
}
