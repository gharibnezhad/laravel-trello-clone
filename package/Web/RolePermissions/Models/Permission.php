<?php

namespace Web\RolePermissions\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    const PERMISSION_MANAGE_ROLE_PERMISSION = 'manage role_permissions';
    const PERMISSION_MANAGE_USERS = 'manage users';
    const PERMISSION_SUPER_ADMIN = 'super admin';

    static $permissions = [
        self::PERMISSION_SUPER_ADMIN,
        self::PERMISSION_MANAGE_USERS,
        self::PERMISSION_MANAGE_ROLE_PERMISSION
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}
