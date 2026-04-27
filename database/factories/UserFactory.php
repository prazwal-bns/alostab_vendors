<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name();

        return [
            'name' => $name,
            'username' => Str::slug($name) . fake()->unique()->numberBetween(10, 999),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'provider' => null,
            'provider_id' => null,
            'provider_token' => null,
            'phone' => fake()->phoneNumber,
            'address' => fake()->address,
            'photo' => 'upload/user_images/default.png',
            'role' => 'user',
            'status' => fake()->randomElement(['active', 'inactive']),
            'last_seen' => now()->subMinutes(fake()->numberBetween(1, 120))->toDateTimeString(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
            'status' => 'active',
            'photo' => 'upload/admin_images/default.png',
        ]);
    }

    public function vendor(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'vendor',
            'status' => 'active',
            'photo' => 'upload/vendor_images/default.png',
        ]);
    }

    public function customer(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'user',
            'status' => 'active',
            'photo' => 'upload/user_images/default.png',
        ]);
    }
}
