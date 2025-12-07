<?php
namespace Web\TaskList\Services;
use Illuminate\Support\Facades\DB;
use Web\TaskList\Contracts\TaskListInterface;
use Web\TaskList\Models\TaskList;

class TaskListService
{
    protected $taskListRepo;
    public function __construct(TaskListInterface $taskListRepo)
    {
        $this->taskListRepo = $taskListRepo;
    }

    public function findTaskListWithBoard($id)
    {
        return $this->taskListRepo->findTaskListWithBoard($id);
    }

    public function getTaskListWithBoard()
    {
        return $this->taskListRepo->getTaskListWithBoard();
    }



    public function storeTaskList(array $data)
    {
        DB::transaction(function ()use ($data){
            return $this->taskListRepo->store($data);
        });
    }

    public function updateTaskList(TaskList $taskList,array $data)
    {
        DB::transaction(function ()use ($data,$taskList){
            return $this->taskListRepo->update($data,$taskList->id);
        });
    }

    public function delete($taskList)
    {
        return $this->taskListRepo->destroy($taskList);
    }

}
