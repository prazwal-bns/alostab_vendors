<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->randomElement([
            'Wireless Noise Cancelling Headphones',
            '4K Smart LED TV',
            'Ergonomic Office Chair',
            'Gaming Mechanical Keyboard',
            'Portable Bluetooth Speaker',
            'Running Performance Shoes',
            'Stainless Steel Blender',
            'Professional Hair Dryer',
            'Waterproof Smart Watch',
            'USB-C Fast Charging Adapter',
        ]) . ' ' . fake()->numberBetween(100, 999);

        $sellingPrice = fake()->numberBetween(1200, 120000);
        $hasDiscount = fake()->boolean(65);
        $discount = $hasDiscount ? fake()->numberBetween(200, max(250, (int) floor($sellingPrice * 0.35))) : null;

        return [
            'brand_id' => Brand::factory(),
            'category_id' => Category::factory(),
            'subcategory_id' => SubCategory::factory(),
            'product_name' => $name,
            'product_slug' => Str::slug($name . '-' . fake()->unique()->numberBetween(1000, 9999)),
            'product_code' => strtoupper(fake()->bothify('PRD-###??')),
            'product_quantity' => (string) fake()->numberBetween(5, 150),
            'product_tags' => implode(',', fake()->randomElements(['new', 'popular', 'eco', 'premium', 'smart', 'trending'], fake()->numberBetween(2, 4))),
            'product_size' => fake()->optional(0.5)->randomElement(['S,M,L,XL', '32,34,36,38', null]),
            'product_color' => fake()->optional(0.7)->randomElement(['Black,White,Blue', 'Red,Gray', 'Green,Blue,Orange', null]),
            'selling_price' => (string) $sellingPrice,
            'discount_price' => $discount ? (string) $discount : null,
            'short_desc' => fake()->sentence(20),
            'long_desc' => fake()->paragraphs(3, true),
            'product_thumbnail' => 'upload/products/' . fake()->numberBetween(1, 60) . '.jpg',
            'vendor_id' => fake()->boolean(70) ? User::factory()->vendor() : null,
            'hot_deals' => fake()->boolean(20),
            'featured' => fake()->boolean(35),
            'special_offer' => fake()->boolean(25),
            'special_deals' => fake()->boolean(20),
            'status' => true,
        ];
    }

    public function active(): static
    {
        return $this->state(fn () => ['status' => true]);
    }
}
