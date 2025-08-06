<?php

namespace Web\TaskActivity\Services;

use Web\TaskActivity\Contracts\TaskActivityInterface;

class TaskActivityService
{

    protected $taskActivityRepo;

    public function __construct(TaskActivityInterface $taskActivityRepo)
    {
        $this->taskActivityRepo = $taskActivityRepo;
    }

    public function all()
    {
        return $this->taskActivityRepo->getAll();
    }

    public function delete($id)
    {
        return $this->taskActivityRepo->delete($id);
    }
}
