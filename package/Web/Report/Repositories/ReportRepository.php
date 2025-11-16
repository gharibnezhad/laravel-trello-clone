<?php

namespace Web\Report\Repositories;

use Web\Report\Contracts\ReportInterface;
use Web\Task\Models\Task;

class ReportRepository implements ReportInterface
{

    public function getAll()
    {
        return Task::all();
    }


}
