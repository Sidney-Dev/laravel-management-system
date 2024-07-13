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

        $startDate = fake()->dateTimeBetween('now', '+1 year');
        $endDate = fake()->dateTimeBetween($startDate, (clone $startDate)->modify('+1 year'));

        return [
            'name' => fake()->sentence,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'description' => fake()->paragraphs(3, true),
            'priority' => fake()->randomElement(['low', 'medium', 'urgent']),
        ];
    }
}
