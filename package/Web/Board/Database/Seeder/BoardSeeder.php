<?php

namespace Web\Board\Database\Seeder;

use App\Models\TaskList;
use Web\Board\Models\Board;
use Illuminate\Database\Seeder;

class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Board::factory(3)->create();


        Board::all()->each(function ($board){
            $taskList=TaskList::factory(2)->make();
            $board->taskLists()->saveMany($taskList);

        });
    }
}
