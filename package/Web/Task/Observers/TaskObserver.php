<?php

namespace Web\Task\Observers;

use Web\Task\Events\TaskCreated;
use Web\Task\Events\TaskMoved;
use Web\Task\Events\TaskUpdated;
use Web\Task\Models\Task;

class TaskObserver
{

    public function created(Task $task)
    {

        event(new TaskCreated($task,auth()->user()));
    }


    public function updated(Task $task)
    {
        if ($task->isDirty('order') || $task->isDirty('task_list_id')){
             event(new TaskMoved($task,auth()->user(), $task->getOriginal(), $task->getChanges()));
        }else {
            event(new TaskUpdated($task,auth()->user() , $task->getOriginal(),$task->getChanges()));
        }
    }


    public function deleted(Task $task)
    {
        //
    }


    public function restored(Task $task)
    {
        //
    }


    public function forceDeleted(Task $task)
    {
        //
    }
}
