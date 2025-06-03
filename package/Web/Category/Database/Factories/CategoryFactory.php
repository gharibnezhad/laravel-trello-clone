<?php

namespace Web\Category\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Web\Category\Models\Category;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory
 */
class CategoryFactory extends Factory
{
    protected $model=Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->title,
            'slug' => $this->faker->slug,
        ];
    }
}
