<?php

namespace Web\TaskList\Contracts;

interface TaskListInterface
{

    public function findById($id);

    public function getAllTaskList();

    public function store(array $data);

    public function update(array $data,$id);

    public function destroy($id);
}
