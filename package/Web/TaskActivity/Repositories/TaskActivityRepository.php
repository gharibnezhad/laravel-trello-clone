<?php
namespace Web\TaskActivity\Repositories;


use Web\TaskActivity\Contracts\TaskActivityInterface;
use Web\TaskActivity\Models\TaskActivity;

class TaskActivityRepository implements TaskActivityInterface
{

    public function getAll()
    {
        return TaskActivity::all();
    }

    public function delete($id)
    {
        $taskActivity = TaskActivity::findOrFail($id);
        $taskActivity->delete();
        return $taskActivity;
    }
}
