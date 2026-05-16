<?php

namespace Database\Factories;

use Database\Seeders\Support\DemoAssetCatalog;
use Illuminate\Database\Eloquent\Factories\Factory;

class BannerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'banner_title' => fake()->randomElement([
                'Weekend Flash Deal',
                'Exclusive Member Offer',
                'Back to Work Specials',
                'Top Picks This Month',
            ]),
            'banner_url' => fake()->url(),
            'banner_image' => DemoAssetCatalog::bannerImage(fake()->numberBetween(1, 19)),
        ];
    }
}
