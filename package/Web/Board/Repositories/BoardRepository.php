<?php

namespace Web\Board\Repositories;

use Web\Board\Contracts\BoardInterface;
use Web\Board\Models\Board;
use Web\User\Models\User;

class BoardRepository implements BoardInterface
{

    public function findBoardWithProject($id)
    {
        return Board::with('project')->findOrFail($id);
    }

    public function getBoardsWithProject()
    {
       return Board::with('project')->get();
    }

    public function store(array $data)
    {
        return Board::create($data);
    }

    public function update($data,$id)
    {
        $board = Board::findOrFail($id);
        $board->update($data);
        return $board;
    }

    public function destroy($id)
    {
        return Board::findOrFail($id)->delete();
    }

    public function findBoardsWithNameAndId()
    {
        return Board::query()->pluck('name','id');
    }

    public function getAllBoardForUser(User $user)
    {
        return Board::whereHas('users',function ($query) use ($user){
            $query->where('users.id',$user->id);
        })->with('project')->get();
    }

    public function findBoardWithTaskLists(int $boardId)
    {
        return Board::with(['taskLists'=>function ($q) {
            $q->select('id','name','board_id');
        }])->findOrFail($boardId);
    }
}
