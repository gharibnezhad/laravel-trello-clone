<?php

namespace Web\Report\Services;

use Web\Report\Contracts\ReportInterface;
use Web\Task\Models\Task;
use Web\TaskList\Models\TaskList;
use Web\User\Models\User;

class ReportService
{
    protected $reportRepo;

    public function __construct(ReportInterface $reportRepo)
    {
        $this->reportRepo = $reportRepo;
    }

    public function all()
    {
        return $this->reportRepo->getAll();
    }


    public function countTasks()
    {
        $tasks = $this->all();
        $countTasks = $tasks->count();

        return $countTasks;
    }

    public function getAllNameTaskList()
    {
        $nameTaskList = TaskList::$nameTaskList;
        return $nameTaskList;
    }

    public function loadReportPageData($filterName = null)
    {
        $nameTaskLists = $this->getAllNameTaskList();
        $countTasks = $this->countTasks();
        $countTasksEachTaskList = $this->getTasksEachTaskList($filterName)->count();
        $getTasksEachTaskLists = collect();
        if ($filterName){
            $getTasksEachTaskLists = $this->getTasksEachTaskList($filterName);
        }

        return compact('nameTaskLists','countTasks','getTasksEachTaskLists','countTasksEachTaskList');
    }

    public function getTasksEachTaskList($name)
    {
        $taskListIds = TaskList::where('name',$name)
        ->pluck('id');
        $countTasks = Task::whereIn('task_list_id',$taskListIds)
            ->get();
        return $countTasks;
    }

    public function getTasksUsers()
    {
        return User::with('tasks')->get();
    }

}
