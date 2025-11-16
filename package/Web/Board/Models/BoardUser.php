<?php

namespace Web\Board\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Web\RolePermissions\Models\Role;

class BoardUser extends Pivot
{
    use HasFactory;

    protected $table = 'board_user';

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
