<?php

namespace Database\Seeders;

use App\Models\Slider;
use Database\Seeders\Support\DemoAssetCatalog;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        $sliders = [
            ['title' => 'Mega Electronics Sale', 'short' => 'Up to 40% Off'],
            ['title' => 'Style Refresh Week', 'short' => 'New Arrivals'],
            ['title' => 'Smart Home Festival', 'short' => 'Shop Now'],
            ['title' => 'Fitness Essentials Deals', 'short' => 'Limited Time'],
            ['title' => 'Home & Living Collection', 'short' => 'Featured Picks'],
        ];

        foreach ($sliders as $index => $slider) {
            Slider::factory()->create([
                'slider_title' => $slider['title'],
                'short_title' => $slider['short'],
                'slider_image' => DemoAssetCatalog::sliderImage($index + 1),
            ]);
        }
    }
}
