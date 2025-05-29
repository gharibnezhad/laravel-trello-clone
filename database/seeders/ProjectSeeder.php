<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $project = Project::factory()->create();

        $roles = ['admin','member','viewer'];

        $users = User::all();

        $project->each(function ($project) use ($users,$roles){
            $users->each(function ($user) use ($project,$roles){
                $project->users()->attach($user->id,[
                    'role'=>$roles[array_rand($roles)]
                ]);
            });
        });
    }
}
