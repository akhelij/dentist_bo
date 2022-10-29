<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Intervention>
 */
class InterventionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'patient_id' => Patient::factory()->create()->id,
            'dents' => json_encode(fake()->randomDigit(1, 32)),
            'description' => fake()->text(),
            'total_amount' => fake()->randomFloat(2,50, 699),
        ];
    }
}
