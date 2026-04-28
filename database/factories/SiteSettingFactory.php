<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SiteSettingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'logo' => 'upload/logo/default-logo.png',
            'support_phone' => '+977-9800000000',
            'phone_one' => '+977-9811111111',
            'email' => 'support@alostabvendors.test',
            'company_address' => fake()->address(),
            'facebook' => 'https://facebook.com/alostabvendors',
            'twitter' => 'https://twitter.com/alostabvendors',
            'instagram' => 'https://instagram.com/alostabvendors',
            'copyright' => 'Alostab Vendors',
        ];
    }
}
