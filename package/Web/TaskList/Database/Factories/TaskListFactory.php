<?php

namespace Web\TaskList\Database\Factories;

use Web\Board\Models\Board;
use Illuminate\Database\Eloquent\Factories\Factory;


class TaskListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->words(2,true),
            'board_id' => Board::factory(),
        ];
    }
}
