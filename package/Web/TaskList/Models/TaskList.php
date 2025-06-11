<?php

namespace Web\TaskList\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Web\Board\Models\Board;
use Web\Task\Models\Task;

class TaskList extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }


}
