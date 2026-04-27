<?php

namespace Database\Seeders;

use App\Models\ShipCity;
use App\Models\ShipDistrict;
use Illuminate\Database\Seeder;

class ShipCitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            'Kathmandu' => ['New Road', 'Baneshwor', 'Koteshwor'],
            'Lalitpur' => ['Jawalakhel', 'Pulchowk'],
            'Bhaktapur' => ['Suryabinayak', 'Thimi'],
            'Pokhara' => ['Lakeside', 'Hemja'],
            'Chitwan' => ['Bharatpur', 'Ratnanagar'],
        ];

        foreach ($cities as $districtName => $cityList) {
            $district = ShipDistrict::where('district_name', $districtName)->first();
            if (! $district) {
                continue;
            }

            foreach ($cityList as $cityName) {
                ShipCity::factory()->create([
                    'district_id' => $district->id,
                    'city_name' => $cityName,
                ]);
            }
        }
    }
}
