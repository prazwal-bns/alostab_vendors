<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'user')->pluck('id');
        $products = Product::get();

        if ($users->isEmpty() || $products->isEmpty()) {
            return;
        }

        foreach ($products->take(60) as $product) {
            foreach (range(1, fake()->numberBetween(1, 4)) as $i) {
                Review::factory()->create([
                    'product_id' => $product->id,
                    'user_id' => $users->random(),
                    'vendor_id' => $product->vendor_id,
                ]);
            }
        }
    }
}
