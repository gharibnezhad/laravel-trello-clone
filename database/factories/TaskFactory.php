<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Models\TaskList;

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
    public function definition()
    {
        return [
            'title'=>$this->faker->title,
            'description'=>$this->faker->paragraph,
            'due_time'=>$this->faker->dateTime,
            'task_list_id' => TaskList::factory(),
        ];
    }
}
