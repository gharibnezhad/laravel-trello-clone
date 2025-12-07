<?php

namespace Web\TaskList\Contracts;

interface TaskListInterface
{

    public function findTaskListWithBoard($id);

    public function getTaskListWithBoard();

    public function store(array $data);

    public function update(array $data,$id);

    public function destroy($id);
}
