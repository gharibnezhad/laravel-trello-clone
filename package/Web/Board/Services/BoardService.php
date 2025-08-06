<?php

namespace Web\Board\Services;

use Web\Board\Contracts\BoardInterface;
use Web\Task\Events\TaskCreated;
use Web\Task\Models\Task;
use Web\Task\Repositories\TaskRepository;

class BoardService
{

    protected $boardRepo;
    protected $TaskRepo;

    public function __construct(BoardInterface $boardRepo, TaskRepository $TaskRepo)
    {
        $this->boardRepo = $boardRepo;
        $this->TaskRepo = $TaskRepo;
    }

    public function storeBoard($request)
    {
        $data = [
            "name" => $request->name,
            "project_id" => $request->project_id,
            "visibility" => $request->visibility,
            "order" => $request->order,
        ];

        return $this->boardRepo->store($data);
    }

    public function updateBoard($request, $id)
    {
        $board = $this->boardRepo->findById($id);
        $data = [
            "name" => $request->filled('name') ? $request->name : $board->name,
            "project_id" => $request->filled('project_id') ? $request->project_id : $board->project_id,
            "visibility" => $request->filled('visibility') ? $request->visibility : $board->visibility,
            "order" => $request->filled('order') ? $request->order : $board->order,
        ];

        return $this->boardRepo->update($data, $id);
    }

    public function addTask($request, $id)
    {

        $this->boardRepo->findById($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'taskList' => 'required|exists:task_lists,id',
        ]);

        $taskListId = $validated['taskList'];

        $maxOrder = Task::where('task_list_id',$taskListId)->max('order');
        $nextOrder = $maxOrder ? $maxOrder + 1 : 1 ;

       $task = $this->TaskRepo->store([
            "title" => $validated['title'],
            "task_list_id" => $taskListId,
            "order" => $nextOrder
        ]);

        if (auth()->check()) {
            $task->users()->attach(auth()->id()); // حالا که مدل ذخیره شده
        }

        return $task;
    }

    public function updateTaskOrder($request)
    {
        $request->validate([
            'task_list_id' => 'required|integer|exists:task_lists,id',
            'tasks' => 'required|array',
            'tasks.*.id' => 'required|integer|exists:tasks,id',
            'tasks.*.order' => 'required|integer|min:1',
        ]);

        $taskListId = $request->input('task_list_id');
        $tasks = $request->input('tasks');

        foreach ($tasks as $taskData) {
            $task = Task::find($taskData['id']);
               $task->task_list_id = $taskListId;
               $task->order = $taskData['order'];

               $task->save();
        }

        return $tasks;
    }

    public function deleteBoard($id)
    {
        return $this->boardRepo->destroy($id);
    }
}
