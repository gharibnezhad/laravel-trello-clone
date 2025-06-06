<?php

namespace Web\Export\Exporters;

use Web\Export\Contracts\JsonExporterInterface;

class BoardToJsonJsonExporter implements JsonExporterInterface
{

    public function export(mixed $resource)
    {
        return response()->json([
            "id" => $resource->id,
            "name" => $resource->name,
            "task_list" => $resource->taskList->map(fn($list)=>[
                "name"=> $list->name,
                "tasks" => $list->tasks->map(fn($task)=>[
                    "title" => $task->title,
                    "priority" => $task->priority,
                    "status" => $task->status,
                ])
            ]),
        ]);
    }
}
