<?php

namespace Web\Board\Services;

use Web\Board\Contracts\BoardInterface;
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
        $board = $this->boardRepo->findById($id);

         $this->TaskRepo->store([
            "title" => $request->title,
            "task_list_id" => $request->taskList
        ]);
    }

    public function deleteBoard($id)
    {
        return $this->boardRepo->destroy($id);
    }
}
