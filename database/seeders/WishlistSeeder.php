<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Database\Seeder;

class WishlistSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'user')->pluck('id');
        $products = Product::pluck('id');

        if ($users->isEmpty() || $products->isEmpty()) {
            return;
        }

        foreach ($users->take(20) as $userId) {
            foreach ($products->random(fake()->numberBetween(1, 4)) as $productId) {
                Wishlist::firstOrCreate([
                    'user_id' => $userId,
                    'product_id' => $productId,
                ]);
            }
        }
    }
}
