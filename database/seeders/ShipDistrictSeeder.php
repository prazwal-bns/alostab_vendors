<?php

namespace Database\Seeders;

use App\Models\ShipDistrict;
use Illuminate\Database\Seeder;

class ShipDistrictSeeder extends Seeder
{
    public function run(): void
    {
        $districts = [
            'Kathmandu',
            'Lalitpur',
            'Bhaktapur',
            'Pokhara',
            'Chitwan',
            'Butwal',
            'Biratnagar',
            'Dharan',
        ];

        foreach ($districts as $district) {
            ShipDistrict::factory()->create([
                'district_name' => $district,
            ]);
        }
    }
}
