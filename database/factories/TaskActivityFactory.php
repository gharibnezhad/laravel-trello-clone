<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Web\TaskList\Models\TaskList;
use Web\User\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\TaskActivity>
 */
class TaskActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'description'=>$this->faker->paragraph,
            'task_id'=>TaskList::factory(),
            'user_id'=>User::factory(),
        ];
    }
}
