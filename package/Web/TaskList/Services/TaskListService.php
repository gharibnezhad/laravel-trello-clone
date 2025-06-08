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

    public function all()
    {
        return $this->taskListRepo->getAllTaskList();
    }

    public function storeTaskList($request)
    {
        $data = [
            'name' => $request->name,
            'order' => $request->order,
            'board_id' => $request->board_id,
        ];

        return $this->taskListRepo->store($data);
    }

    public function updateTaskList($request,$id)
    {
        $data = [
            'name' => $request->name,
            'order' => $request->order,
            'board_id' => $request->board_id,
        ];

        return $this->taskListRepo->update($data,$id);
    }

}
