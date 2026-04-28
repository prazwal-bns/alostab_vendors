<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class MultiImgFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'photo_image' => 'upload/products/multi/' . fake()->numberBetween(1, 120) . '.jpg',
        ];
    }
}
