<?php
namespace Web\TaskActivity\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Web\Task\Models\Task;
use Web\User\Models\User;

class TaskActivity extends Model
{
    use HasFactory;
    protected $fillable = ['task_id','user_id','description',
        'action','old_values','new_values','created_at','updated_at'
    ];

    const CREATED = 'created';
    const UPDATED = 'updated';
    const DELETED = 'deleted';
    const MOVED = 'moved';

    public static $action = [
        self::CREATED,
        self::UPDATED,
        self::DELETED,
        self::MOVED,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
