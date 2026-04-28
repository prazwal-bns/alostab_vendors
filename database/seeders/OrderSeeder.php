<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\ShipCity;
use App\Models\ShipState;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $customers = User::where('role', 'user')->pluck('id');
        $states = ShipState::select('id', 'city_id', 'district_id')->get();

        if ($customers->isEmpty() || $states->isEmpty()) {
            return;
        }

        foreach (range(1, 45) as $i) {
            $state = $states->random();

            Order::factory()->create([
                'user_id' => $customers->random(),
                'district_id' => $state->district_id,
                'city_id' => $state->city_id,
                'state_id' => $state->id,
            ]);
        }
    }
}
