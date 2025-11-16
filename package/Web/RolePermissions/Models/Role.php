<?php

namespace Web\RolePermissions\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Web\RolePermissions\Database\Factories\RoleFactory;

class Role extends Model
{
    use HasFactory;
    protected $guarded = [];

    const OWNER  = 1;
    const MEMBER = 2;
    const VIEWER = 3;

    const ROLE_SUPER_ADMIN = "super admin";

    static $roles = [
        self::ROLE_SUPER_ADMIN =>[
            Permission::PERMISSION_SUPER_ADMIN
        ],
        self::OWNER =>[
            Permission::PERMISSION_MANAGE_OWN_PROJECT
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

    protected static function newFactory()
    {
        return RoleFactory::new();
    }

}
