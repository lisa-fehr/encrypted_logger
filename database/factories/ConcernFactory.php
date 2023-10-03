<?php

namespace Database\Factories;

use App\Models\Observation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Concern>
 */
class ConcernFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'observation_id' => Observation::factory()->create()->id,
            'description' => fake()->sentence()
        ];
    }
}
