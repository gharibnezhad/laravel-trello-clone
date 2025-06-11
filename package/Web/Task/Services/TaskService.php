<?php

namespace Web\Task\Services;


use Web\Task\Contracts\TaskInterface;

class TaskService
{

    protected $taskRepo;

    public function __construct(TaskInterface $taskRepo,)
    {
        $this->taskRepo = $taskRepo;
    }

    public function store($request)
    {
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'task_list_id' => $request->task_list_id,
            'due_time' => $request->due_time,
            'priority' => $request->priority,
            'status' => $request->status,
            'order' => $request->order,
        ];

       $tasks = $this->taskRepo->store($data);

       if ($request->has('users')){
           $tasks->users()->sync($request->users);
       }

       return $tasks;
    }


}
