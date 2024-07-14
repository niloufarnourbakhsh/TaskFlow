<?php

namespace Database\Factories;

use App\Models\Plan;
use App\TaskStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'plan_id'=>Plan::factory()->create(),
            'body'=>$this->faker->paragraph(2),
            'status'=>TaskStatus::NotDone->value,
        ];
    }
}
