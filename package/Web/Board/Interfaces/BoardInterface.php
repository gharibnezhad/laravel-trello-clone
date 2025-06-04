<?php

namespace Web\Board\Interfaces;

interface BoardInterface
{

    public function findById($id);

    public function getAllBoards();

    public function store(array $data);

    public function update(array $data,$id);

    public function destroy($id);
}
