<?php

namespace Database\Factories;

use App\Models\ShipCity;
use App\Models\ShipDistrict;
use App\Models\ShipState;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        $status = fake()->randomElement(['pending', 'confirm', 'processing', 'delivered']);
        $amount = fake()->numberBetween(1500, 60000);
        $discount = fake()->boolean(50) ? fake()->numberBetween(100, 2500) : null;

        return [
            'user_id' => User::factory()->customer(),
            'district_id' => ShipDistrict::factory(),
            'city_id' => ShipCity::factory(),
            'state_id' => ShipState::factory(),
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->streetAddress(),
            'post_code' => fake()->postcode(),
            'notes' => fake()->optional()->sentence(12),
            'payment_type' => fake()->randomElement(['Card', 'Cash on Delivery', 'Khalti']),
            'payment_method' => fake()->randomElement(['Stripe', 'Khalti', 'COD']),
            'transaction_id' => strtoupper(fake()->bothify('TXN-#####??')),
            'currency' => 'NPR',
            'amount' => $amount,
            'discount_amount' => $discount,
            'order_number' => strtoupper(fake()->bothify('ORD-######')),
            'invoice_number' => strtoupper(fake()->bothify('INV-######')),
            'order_date' => now()->format('d F Y'),
            'order_month' => now()->format('F'),
            'order_year' => now()->format('Y'),
            'confirmed_date' => $status !== 'pending' ? now()->format('d F Y') : null,
            'processing_date' => in_array($status, ['processing', 'delivered'], true) ? now()->format('d F Y') : null,
            'picked_date' => $status === 'delivered' ? now()->format('d F Y') : null,
            'shipped_date' => $status === 'delivered' ? now()->format('d F Y') : null,
            'delivered_date' => $status === 'delivered' ? now()->format('d F Y') : null,
            'cancel_date' => null,
            'return_date' => null,
            'return_order' => 0,
            'return_reason' => null,
            'status' => $status,
        ];
    }
}
