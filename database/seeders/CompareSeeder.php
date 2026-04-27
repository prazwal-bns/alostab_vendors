<?php

namespace Database\Seeders;

use App\Models\Compare;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompareSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'user')->pluck('id');
        $products = Product::pluck('id');

        if ($users->isEmpty() || $products->isEmpty()) {
            return;
        }

        foreach ($users->take(15) as $userId) {
            foreach ($products->random(fake()->numberBetween(1, 3)) as $productId) {
                Compare::firstOrCreate([
                    'user_id' => $userId,
                    'product_id' => $productId,
                ]);
            }
        }
    }
}
