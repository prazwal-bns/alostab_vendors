<?php

namespace Database\Seeders;

use App\Models\Banner;
use Database\Seeders\Support\DemoAssetCatalog;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            'Weekend Flash Deal',
            'Exclusive Member Offer',
            'Back to Work Specials',
            'Top Picks This Month',
        ];

        foreach ($banners as $index => $title) {
            Banner::factory()->create([
                'banner_title' => $title,
                'banner_image' => DemoAssetCatalog::bannerImage($index + 1),
            ]);
        }
    }
}
