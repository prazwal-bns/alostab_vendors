<?php

namespace Database\Seeders;

use App\Models\Coupoun;
use Illuminate\Database\Seeder;

class CoupounSeeder extends Seeder
{
    public function run(): void
    {
        Coupoun::factory()->count(8)->create();
    }
}
