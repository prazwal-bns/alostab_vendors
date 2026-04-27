<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    public function definition(): array
    {
        $qty = fake()->numberBetween(1, 4);
        $price = fake()->numberBetween(800, 15000);

        return [
            'order_id' => Order::factory(),
            'product_id' => Product::factory(),
            'vendor_id' => fake()->boolean(65) ? User::factory()->vendor() : null,
            'color' => fake()->optional()->safeColorName(),
            'size' => fake()->optional()->randomElement(['S', 'M', 'L', 'XL']),
            'qty' => $qty,
            'price' => $price * $qty,
        ];
    }
}
