<?php

namespace Web\Task\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Web\Task\Models\Task;

class TaskMoved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $task;

    public $user;
    public $oldValues;
    public $newValues;
    public function __construct(Task $task,$user,$oldValues,$newValues)
    {
        $this->task = $task;
        $this->user = $user;
        $this->oldValues = $oldValues;
        $this->newValues = $newValues;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
