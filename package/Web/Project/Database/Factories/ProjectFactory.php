<?php

namespace Web\Project\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Web\Category\Models\Category;
use Web\Project\Models\Project;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Web\Project\Models\Project>
 */
class ProjectFactory extends Factory
{
    protected $model=Project::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(3,true),
            'slug' => $this->faker->slug,
            'description' => $this->faker->paragraph,
            'category_id' =>Category::factory(),
            'is_archived' => false,
        ];
    }
}
