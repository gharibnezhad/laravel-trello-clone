<?php

namespace Web\Task\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Web\Board\Models\Board;
use Web\Comment\Models\Comment;
use Web\TaskActivity\Models\TaskActivity;
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
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable')->whereNull('parent_id');
    }



    protected static function newFactory()
    {
        return \Web\Task\Database\Factories\TaskFactory::class;
    }
}
