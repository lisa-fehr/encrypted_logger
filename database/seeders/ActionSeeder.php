<?php

namespace Database\Seeders;

use App\Models\Action;
use App\Models\Concern;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Action::factory()
            ->create([
                'description' => 'no concern',
            ]);

        Action::factory()
            ->create([
                'concern_id' => Concern::first()->id,
                'description' => 'longer action',
                'started_at' => Date::yesterday(),
                'ended_at' => Date::tomorrow()
            ]);
    }
}
