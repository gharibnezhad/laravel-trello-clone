<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\TaskList;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $lists = TaskList::all();
        $users = User::all();
        $lists->each(function ($list) use ($users) {
            $tasks = Task::factory(3)->make();

            $list->tasks()->saveMany($tasks);

            $tasks->each(function ($task) use ($users) {
                $randomUsers = $users->random(rand(1, 2));
                $task->users()->attach($randomUsers);
            });
        });

    }
}
