<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::get();
        if ($products->isEmpty()) {
            return;
        }

        Order::select('id')->get()->each(function ($order) use ($products) {
            foreach (range(1, fake()->numberBetween(1, 3)) as $i) {
                $product = $products->random();
                $qty = fake()->numberBetween(1, 3);
                $unitPrice = (float) $product->selling_price - (float) ($product->discount_price ?? 0);

                OrderItem::factory()->create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'vendor_id' => $product->vendor_id,
                    'color' => $product->product_color ? fake()->randomElement(explode(',', $product->product_color)) : null,
                    'size' => $product->product_size ? fake()->randomElement(explode(',', $product->product_size)) : null,
                    'qty' => $qty,
                    'price' => max(1, $unitPrice) * $qty,
                ]);
            }
        });
    }
}
