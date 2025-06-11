<?php

namespace Web\Task\Database\Seeder;

use Illuminate\Database\Seeder;
use Web\Task\Models\Task;
use Web\TaskList\Models\TaskList;
use Web\User\Models\User;

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
