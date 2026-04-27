<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ShipDistrictFactory extends Factory
{
    public function definition(): array
    {
        return [
            'district_name' => fake()->unique()->city() . ' District',
        ];
    }
}
