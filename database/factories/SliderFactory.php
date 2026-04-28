<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SliderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'slider_title' => fake()->randomElement([
                'Mega Electronics Sale',
                'Style Refresh Week',
                'Smart Home Festival',
                'Fitness Essentials Deals',
            ]),
            'short_title' => fake()->randomElement(['Up to 40% Off', 'Limited Time', 'New Arrivals', 'Shop Now']),
            'slider_image' => 'upload/sliders/' . fake()->numberBetween(1, 12) . '.jpg',
        ];
    }
}
