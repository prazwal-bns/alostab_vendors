<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'user_id' => User::factory()->customer(),
            'comment' => fake()->paragraph(),
            'rating' => fake()->numberBetween(3, 5),
            'status' => fake()->boolean(85),
            'vendor_id' => fake()->boolean(70) ? User::factory()->vendor() : null,
        ];
    }
}
