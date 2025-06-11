<?php

namespace Web\Task\Models;

use App\Models\TaskActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Web\TaskList\Models\TaskList;
use Web\User\Models\User;

class Task extends Model
{
    use HasFactory;

    protected $guarded=[];

    const PRIORITY_LOW = 'low';
    const PRIORITY_MEDIUM = 'medium';
    const PRIORITY_HIGH = 'high';

    static $priority = [
      self::PRIORITY_LOW,
      self::PRIORITY_MEDIUM,
      self::PRIORITY_HIGH
    ];

    const STATUS_TODO = 'todo';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_DONE = 'done';

    static $status = [
        self::STATUS_TODO,
        self::STATUS_IN_PROGRESS,
        self::STATUS_DONE
    ];

    public function taskList()
    {
        return $this->belongsTo(TaskList::class);
    }

    public function activities()
    {
        return $this->hasMany(TaskActivity::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    protected static function newFactory()
    {
        return \Web\Task\Database\Factories\TaskFactory::class;
    }
}
