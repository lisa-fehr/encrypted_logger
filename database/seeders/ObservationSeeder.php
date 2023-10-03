<?php

namespace Database\Seeders;

use App\Models\Observation;
use Illuminate\Database\Seeder;

class ObservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Observation::factory()
            ->create();
    }
}
