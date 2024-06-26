<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            User::factory()->create([
                'email' => 'admin@test.com',
                'password' => bcrypt('admin')
            ]);
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }

    }
}
