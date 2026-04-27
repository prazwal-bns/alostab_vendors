<?php

namespace Database\Factories;

use App\Models\ShipDistrict;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShipCityFactory extends Factory
{
    public function definition(): array
    {
        return [
            'city_name' => fake()->city(),
            'district_id' => ShipDistrict::factory(),
        ];
    }
}
