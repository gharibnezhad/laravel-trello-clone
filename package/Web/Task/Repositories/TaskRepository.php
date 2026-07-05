<?php

namespace Web\Task\Repositories;

use Web\Task\Contracts\TaskInterface;
use Web\Task\Models\Task;

class TaskRepository implements TaskInterface
{

    public function findById($id)
    {
        return Task::findOrFail($id);
    }

    public function getAllTask()
    {
        return Task::all();
    }

    public function store(array $data)
    {
        return Task::create($data);
    }

    public function update(array $data, $id)
    {
        $task = Task::findOrFail($id);
        return $task->update($data);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        return $task->delete();
    }

    public function getTaskWithRelations(Task $task): Task
    {
        return $task->loadMissing('taskList.board');
    }
}
