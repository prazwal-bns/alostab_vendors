<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Database\Seeders\Support\DemoAssetCatalog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $brands = Brand::pluck('id');
        $vendors = User::where('role', 'vendor')->pluck('id');
        $subCategories = SubCategory::with('Category')->get();
        $categoriesByName = Category::all()->keyBy('category_name');

        foreach (DemoAssetCatalog::curatedProducts() as $item) {
            $category = $categoriesByName->get($item['category'])
                ?? $categoriesByName->first();
            $subCategory = $subCategories
                ->where('category_id', $category?->id)
                ->first()
                ?? $subCategories->random();

            Product::factory()->active()->create([
                'brand_id' => $brands->random(),
                'category_id' => $subCategory->category_id,
                'subcategory_id' => $subCategory->id,
                'product_name' => $item['product_name'],
                'product_slug' => Str::slug($item['product_name']),
                'product_tags' => $item['product_tags'],
                'selling_price' => (string) $item['selling_price'],
                'short_desc' => $item['short_desc'],
                'product_thumbnail' => DemoAssetCatalog::productImage($item['number']),
                'vendor_id' => fake()->boolean(75) && $vendors->isNotEmpty() ? $vendors->random() : null,
            ]);
        }

        foreach (range(1, 25) as $i) {
            $subCategory = $subCategories->random();
            $imageNumber = (($i - 1) % 19) + 1;

            Product::factory()->active()->create([
                'brand_id' => $brands->random(),
                'category_id' => $subCategory->category_id,
                'subcategory_id' => $subCategory->id,
                'product_thumbnail' => DemoAssetCatalog::productImage($imageNumber),
                'vendor_id' => fake()->boolean(75) && $vendors->isNotEmpty() ? $vendors->random() : null,
            ]);
        }
    }
}
