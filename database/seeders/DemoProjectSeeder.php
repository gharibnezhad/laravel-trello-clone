<?php

namespace Database\Seeders;

use App\Models\TaskActivity;
use Board;
use Illuminate\Database\Seeder;
use Models\Project;
use Models\TaskList;
use User;
use Web\Task\Models\Task;

class DemoProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'email'=>'aliDev@gmail.com'
        ]);

        $project=Project::factory()->create();

        $project->users()->attach($user->id,['role'=>'panel']);

        $boards = Board::factory(3)->for($project)->create();

        $boards->each(function ($bord) use ($user){
            $lists = TaskList::factory(2)->for($bord)->create();

            $lists->each(function ($list) use ($user){

                $tasks = Task::factory(3)->for($list)->create();

                $tasks->each(function ($task) use ($user){
                    $task->users()->attach($user->id);

                    TaskActivity::factory()->create([
                        'task_id'=>$task->id,
                        'user_id'=>$user->id,
                        'description' => 'created the task'
                    ]);
                });
            });
        });
    }
}
