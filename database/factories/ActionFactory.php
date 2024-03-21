<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Action>
 */
class ActionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::first(),
            'description' => fake()->sentence(),
            'active' => true,
            'started_at' => Date::now(),
            'ended_at' => Date::now()->endOfDay()
        ];
    }
}
