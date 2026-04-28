<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CoupounFactory extends Factory
{
    public function definition(): array
    {
        return [
            'coupoun_name' => strtoupper(fake()->bothify('SAVE##??')),
            'coupoun_discount' => fake()->numberBetween(5, 30),
            'coupoun_validity' => now()->addDays(fake()->numberBetween(10, 120))->format('Y-m-d'),
            'status' => fake()->boolean(80) ? 1 : 0,
        ];
    }
}
