<?php

namespace Web\RolePermissions\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Web\RolePermissions\Models\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RoleFactory extends Factory
{

    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name,
        ];
    }
}
