<?php

namespace Web\RolePermissions\Models;

use Illuminate\Database\Eloquent\Model;
use Web\User\Models\User;

class Permission extends Model
{
    const PERMISSION_MANAGE_ROLE_PERMISSION = 'manage role_permissions';
    const PERMISSION_MANAGE_USERS = 'manage users';

    const PERMISSION_SUPER_ADMIN = 'super admin';
    const PERMISSION_MANAGE_OWN_PROJECT = 'manage own projects';
    const PERMISSION_MANAGE_OWN_BOARD = 'manage own boards';

    static $permissions = [
        self::PERMISSION_SUPER_ADMIN,
        self::PERMISSION_MANAGE_USERS,
        self::PERMISSION_MANAGE_OWN_PROJECT,
        self::PERMISSION_MANAGE_OWN_BOARD,
        self::PERMISSION_MANAGE_ROLE_PERMISSION
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
