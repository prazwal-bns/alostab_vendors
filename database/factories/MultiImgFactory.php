<?php

namespace Database\Factories;

use Database\Seeders\Support\DemoAssetCatalog;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class MultiImgFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'photo_image' => DemoAssetCatalog::galleryImage(fake()->numberBetween(1, 34)),
        ];
    }
}
