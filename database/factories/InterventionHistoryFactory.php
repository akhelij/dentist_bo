<?php

namespace Database\Factories;

use App\Models\Intervention;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InterventionHistory>
 */
class InterventionHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'intervention_id' => Intervention::factory()->create()->id,
            'tooth' => json_encode(fake()->randomDigit(1, 32)),
            'description' => fake()->text()
        ];
    }
}
