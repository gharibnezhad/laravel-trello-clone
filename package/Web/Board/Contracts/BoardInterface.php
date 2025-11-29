<?php

namespace Web\Board\Contracts;

use Web\User\Models\User;

interface BoardInterface
{

    public function findBoardWithProject($id);

    public function getBoardsWithProject();

    public function store(array $data);

    public function update(array $data,$id);

    public function destroy($id);

    public function findBoardsWithNameAndId();

    public function getAllBoardForUser(User $user);

}
