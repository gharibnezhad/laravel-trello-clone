<?php

namespace Web\Board\Repositories;

use Web\Board\Models\Board;

class BoardRepositories implements BoardInterface
{

    public function findById($id)
    {
        return Board::findOrFail($id);
    }

    public function getAllBoards()
    {
       return Board::all();
    }

    public function store($request)
    {
        return Board::create([
            "name" => $request->name,
            "project_id" => $request->project_id,
            "visibility" => $request->visibility,
            "order" => $request->order,
        ]);
    }
}
