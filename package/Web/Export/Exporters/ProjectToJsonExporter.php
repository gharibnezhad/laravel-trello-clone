<?php

namespace Web\Export\Exporters;

use Web\Export\Contracts\JsonExporterInterface;

class ProjectToJsonExporter implements JsonExporterInterface
{

    public function export(mixed $resource)
    {
        return response()->json([
            "id" => $resource->id,
            "name" => $resource->name,
            "boards" => $resource->boards->map(fn($board)=>[
                "name" =>$board->name,
                "taskList" => $board->taskLists->map(fn($list)=>[
                    'name' => $list->name,
                    "tasks" => $list->tasks->map(fn($task)=>[
                        "title" => $task->title,
                        "priority" => $task->priority,
                        "status" => $task->status,
                    ])
                ])
            ]),
        ]);
    }
}
