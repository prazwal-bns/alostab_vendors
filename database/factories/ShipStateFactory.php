<?php

namespace Database\Factories;

use App\Models\ShipCity;
use App\Models\ShipDistrict;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShipStateFactory extends Factory
{
    public function definition(): array
    {
        return [
            'district_id' => ShipDistrict::factory(),
            'city_id' => ShipCity::factory(),
            'state_name' => fake()->state(),
        ];
    }
}
