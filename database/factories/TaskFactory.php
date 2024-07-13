<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
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

        $faked_data = [
            'name' => fake()->sentence,
            'description' => fake()->paragraphs(3, true),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => fake()->randomElement(['pending', 'in progress', 'in review', 'done', 'needs assistance']),
        ];

        $projectIds = Project::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();

        if(count($projectIds) > 0) {
            $faked_data['project_id'] = fake()->randomElement($projectIds);
        } else {
            $faked_data['project_id'] = Project::factory();
        }

        if(count($userIds) > 0) {
            $faked_data['owner_id'] = fake()->randomElement($userIds);
            $faked_data['reporter_id'] = fake()->randomElement($userIds);
        } else {
            $faked_data['owner_id'] = User::factory();
            $faked_data['reporter_id'] = User::factory();
        }

        return $faked_data;
    }
}
