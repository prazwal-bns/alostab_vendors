<?php

namespace Database\Seeders;

use App\Models\MultiImg;
use App\Models\Product;
use Database\Seeders\Support\DemoAssetCatalog;
use Illuminate\Database\Seeder;

class MultiImgSeeder extends Seeder
{
    public function run(): void
    {
        Product::select('id')->orderBy('id')->get()->each(function (Product $product, int $index) {
            $productNumber = ($index % 19) + 1;
            $paths = DemoAssetCatalog::multiImagesForProduct($productNumber, $product->id);

            foreach ($paths as $path) {
                MultiImg::factory()->create([
                    'product_id' => $product->id,
                    'photo_image' => $path,
                ]);
            }
        });
    }
}
