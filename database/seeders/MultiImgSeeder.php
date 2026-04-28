<?php

namespace Database\Seeders;

use App\Models\MultiImg;
use App\Models\Product;
use Illuminate\Database\Seeder;

class MultiImgSeeder extends Seeder
{
    public function run(): void
    {
        Product::select('id')->get()->each(function ($product) {
            MultiImg::factory()->count(fake()->numberBetween(2, 4))->create([
                'product_id' => $product->id,
            ]);
        });
    }
}
