<?php

namespace Web\TaskList\Repositories;

use Web\TaskList\Contracts\TaskListInterface;
use Web\TaskList\Models\TaskList;

class TaskListRepository implements TaskListInterface
{

    public function findById($id)
    {
      return TaskList::findOrFail($id);
    }

    public function getAllTaskList()
    {
        return TaskList::all();
    }

    public function store(array $data)
    {
        return TaskList::create($data);
    }

    public function update(array $data, $id)
    {
        $taskList = TaskList::findOrFail($id);

        return $taskList->update($data);
    }

    public function destroy($id)
    {
        return TaskList::destroy($id);
    }
}
