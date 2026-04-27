<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BrandFactory extends Factory
{
    public function definition(): array
    {
        $brand = fake()->unique()->company();

        return [
            'brand_name' => $brand,
            'brand_slug' => Str::slug($brand),
            'brand_image' => 'upload/brand/' . fake()->numberBetween(1, 20) . '.png',
        ];
    }
}
