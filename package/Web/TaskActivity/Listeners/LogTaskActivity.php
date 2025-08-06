<?php

namespace Web\TaskActivity\Listeners;


use Web\Task\Events\TaskCreated;
use Web\Task\Events\TaskMoved;
use Web\Task\Events\TaskUpdated;
use Web\TaskActivity\Models\TaskActivity;

class LogTaskActivity
{

    public function handle($event)
    {
        TaskActivity::create([
            "task_id" => $event->task->id,
            "user_id" => $event->user?->id ?? auth()->id(),
            "action" => $this->getActionName($event),
            "old_values" => property_exists($event,'oldValues') ? json_encode($event->oldValues) : null,
            "new_values" => property_exists($event,'newValues') ? json_encode($event->oldValues) : null,
            "description" => $this->getDescription($event)
        ]);
    }

    public function getActionName($event)
    {
        return match (true){
            $event instanceof TaskCreated => 'created',
            $event instanceof TaskUpdated => 'updated',
            $event instanceof TaskMoved => 'moved',
            default => "unknown"
        };
    }

    public function getDescription($event)
    {
        if ($event instanceof TaskCreated){
            return "تسک جدید ایجاد شد: {$event->task->title}";
        }
        if ($event instanceof TaskUpdated){
            return "تسک بروزرسانی شد: {$event->task->title}";
        }
        if ($event instanceof TaskMoved){
            return "تسک منتقل شد: {$event->task->title}";
        }
        return '';
    }
}
