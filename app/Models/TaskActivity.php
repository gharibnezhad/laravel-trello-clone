<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use User;

class TaskActivity extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(\Web\User\Models\User::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
