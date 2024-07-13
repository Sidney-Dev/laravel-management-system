<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence,
            'start_date' => fake()->dateBetween('now', '+1 year'),
            'end_date' => fake()->dateBetween('+1 year', '+2 years'),
            'description' => fake()->paragraphs(3, true),
            'priority' => fake()->randomElement(['low', 'medium', 'urgent']),
        ];
    }
}
