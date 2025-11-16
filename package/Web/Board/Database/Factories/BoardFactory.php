<?php
namespace Web\Board\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Web\Board\Models\Board;
use Web\Project\Models\Project;

class BoardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(2,true),
            'project_id' => Project::factory(),
            'order'=>$this->faker->numberBetween(1,10),
            'visibility'=>Board::VISIBILITY_PRIVATE,
        ];
    }
}
