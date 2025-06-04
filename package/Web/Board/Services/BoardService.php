<?php

namespace Web\Board\Services;

use Web\Board\Interfaces\BoardInterface;

class BoardService
{

    protected $boardRepo;

    public function __construct(BoardInterface $boardRepo)
    {
        $this->boardRepo = $boardRepo;
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

        return $this->boardRepo->update($data,$id);
    }

    public function deleteBoard($id)
    {
        return $this->boardRepo->destroy($id);
    }
}
