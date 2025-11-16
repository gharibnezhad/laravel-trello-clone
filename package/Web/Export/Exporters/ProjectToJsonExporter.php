<?php

namespace Web\Export\Exporters;

use Web\Export\Contracts\JsonExporterInterface;

class ProjectToJsonExporter implements JsonExporterInterface
{

    public function export(mixed $resource): array
    {
        return [
            "id" => $resource->id,
            "name" => $resource->name,
            "boards" => $resource->boards->map(function($board) {
                return [
                    'id' => $board->id,
                    'name' => $board->name,
                    'taskLists' => $board->taskLists->map(function ($list) {
                        return [
                            'id' => $list->id,
                            'name' => $list->name,
                            'tasks' => $list->tasks->map(function ($task) {
                                return [
                                    'id' => $task->id,
                                    'title' => $task->title,
                                    'priority' => $task->priority,
                                    'status' => $task->status,
                                ];
                            })->values()->all(),
                        ];
                    })->values()->all(),
                ];
            })->values()->all(),
        ];
    }
}
