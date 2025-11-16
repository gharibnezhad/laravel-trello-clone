<?php
namespace Web\TaskList\Services;
use Web\TaskList\Contracts\TaskListInterface;

class TaskListService
{
    protected $taskListRepo;
    public function __construct(TaskListInterface $taskListRepo)
    {
        $this->taskListRepo = $taskListRepo;
    }

    public function findTaskList($id)
    {
        return $this->taskListRepo->findById($id);
    }

    public function getAllTaskLists()
    {
        return $this->taskListRepo->getAllTaskList();
    }

    public function storeTaskList($request)
    {
        $data = [
            'name' => $request->name,
            'position' => $request->position,
            'board_id' => $request->board_id,
        ];

        return $this->taskListRepo->store($data);
    }

    public function updateTaskList($request,$id)
    {
        $data = [
            'name' => $request->name,
            'position' => $request->position,
            'board_id' => $request->board_id,
        ];

        return $this->taskListRepo->update($data,$id);
    }

    public function delete($taskList)
    {
        return $this->taskListRepo->destroy($taskList);
    }

}
