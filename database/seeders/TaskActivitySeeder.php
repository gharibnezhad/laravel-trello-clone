<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\TaskActivity;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $tasks = Task::all();

        foreach ($tasks as $task) {
            $randomUser = $users->random();
            TaskActivity::create([
                'task_id' => $task->id,
                'user_id' => $randomUser->id,
                'description' => 'created the task'

            ]);
        }
    }
}
