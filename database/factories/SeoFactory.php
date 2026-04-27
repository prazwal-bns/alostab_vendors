<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SeoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'meta_title' => 'Alostab Vendors | Trusted Multi-Vendor Marketplace',
            'meta_author' => 'Alostab Vendors Team',
            'meta_keyword' => 'ecommerce,multi-vendor,online shopping,nepal marketplace',
            'meta_description' => fake()->sentence(20),
        ];
    }
}
