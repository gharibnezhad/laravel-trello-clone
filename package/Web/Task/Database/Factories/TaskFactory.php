<?php

namespace Web\Task\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Web\TaskList\Models\TaskList;


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
