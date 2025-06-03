<?php

namespace Web\Board\Repositories;

interface BoardInterface
{

    public function findById($id);

    public function getAllBoards();


}
