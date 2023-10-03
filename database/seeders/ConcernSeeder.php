<?php

namespace Database\Seeders;

use App\Models\Action;
use App\Models\Concern;
use App\Models\Observation;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ConcernSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Concern::factory()
            ->has(Observation::factory()->count(1))
            ->has(Tag::factory()->count(3))
            ->has(Action::factory()->count(1))
            ->create();
    }
}
