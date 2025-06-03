<?php
namespace Web\Project\Database\Seeder;

use Illuminate\Database\Seeder;
use Web\Project\Models\Project;
use Web\User\Models\User;

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

        $roles = ['panel','member','viewer'];

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
