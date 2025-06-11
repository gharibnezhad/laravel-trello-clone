<?php

namespace Web\Task\Contracts;

interface TaskInterface
{

    public function findById($id);

    public function getAllTask();

    public function store(array $data);

    public function update(array $data,$id);

    public function destroy($id);
}
