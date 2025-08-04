<?php

namespace Web\User\Traits;

use Web\RolePermissions\Models\Role;

trait HasRolesAndPermissions
{

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->roles()->with('permissions')->get()
            ->pluck('permissions')
            ->flatten()
            ->unique('id');
    }



    public function hasRole($role)
    {
        return $this->roles->contains('name',$role);
    }

    public function hasPermissionTo($permission)
    {
        if (is_string($permission)){
            return $this->permissions()->contains('name',$permission);
        }
        return  $this->permissions()->contains('id',$permission->id);
    }

    public function assignRole($role)
    {
        if (is_string($role)){
            $role = Role::where($role,'name')->findOrFail();
        }

        if (! $this->roles->contains($role->id)){
            $this->roles()->attach($role);
        }

        return $this;
    }
}
