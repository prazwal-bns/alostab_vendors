<?php

namespace Database\Seeders;

use App\Models\ShipCity;
use App\Models\ShipState;
use Illuminate\Database\Seeder;

class ShipStateSeeder extends Seeder
{
    public function run(): void
    {
        foreach (ShipCity::with('District')->get() as $city) {
            ShipState::factory()->create([
                'district_id' => $city->district_id,
                'city_id' => $city->id,
                'state_name' => $city->city_name . ' State',
            ]);
        }
    }
}
