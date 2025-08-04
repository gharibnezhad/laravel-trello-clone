<?php

namespace Web\RolePermissions\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    const ROLE_SUPER_ADMIN = "super admin";

    static $roles = [
        self::ROLE_SUPER_ADMIN =>[
            Permission::PERMISSION_SUPER_ADMIN
        ]
    ];


    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

    public function hasPermissionTo($permission)
    {
        if (is_string($permission)){
            return $this->permissions()->where('name',$permission)->exists();
        }
        return  $this->permissions()->where('id',$permission->id)->exists();
    }

}
