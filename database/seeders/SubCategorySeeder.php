<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            SubCategory::factory()
                ->count(fake()->numberBetween(2, 4))
                ->create([
                    'category_id' => $category->id,
                ]);
        }
    }
}
