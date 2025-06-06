<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Web\User\Models\User;

class Task extends Model
{
    use HasFactory;

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
}
