<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $brands = Brand::pluck('id');
        $vendors = User::where('role', 'vendor')->pluck('id');
        $subCategories = SubCategory::with('Category')->get();

        foreach (range(1, 120) as $i) {
            $subCategory = $subCategories->random();

            Product::factory()->active()->create([
                'brand_id' => $brands->random(),
                'category_id' => $subCategory->category_id,
                'subcategory_id' => $subCategory->id,
                'vendor_id' => fake()->boolean(75) && $vendors->isNotEmpty() ? $vendors->random() : null,
            ]);
        }
    }
}
