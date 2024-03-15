<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ObservationSeeder::class,
            TagSeeder::class,
            ConcernSeeder::class,
            ActionSeeder::class,
            UserSeeder::class
        ]);
    }
}
