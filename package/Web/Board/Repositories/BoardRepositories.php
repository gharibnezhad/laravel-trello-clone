<?php

namespace Web\Board\Repositories;

use Web\Board\Contracts\BoardInterface;
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

    public function store($data)
    {
        return Board::create($data);
    }

    public function update($data,$id)
    {
        $board = Board::findOrFail($id);

        return $board->update($data);
    }

    public function destroy($id)
    {
        $board = Board::findOrFail($id);

        return $board->destroy($id);
    }
}
