<?php

namespace Database\Seeders;

use App\Models\Seo;
use Illuminate\Database\Seeder;

class SeoSeeder extends Seeder
{
    public function run(): void
    {
        Seo::updateOrCreate(
            ['id' => 1],
            Seo::factory()->make()->toArray()
        );
    }
}
