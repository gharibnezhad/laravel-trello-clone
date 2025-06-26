<?php

namespace Web\Board\Services;

use Web\Board\Contracts\BoardInterface;
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

        $this->TaskRepo->store([
            "title" => $validated['title'],
            "task_list_id" => $taskListId,
            "order" => $nextOrder
        ]);

    }

    public function deleteBoard($id)
    {
        return $this->boardRepo->destroy($id);
    }
}
