<?php

namespace Web\User\Traits;

use Illuminate\Support\Collection;
use Web\RolePermissions\Models\Permission;
use Web\RolePermissions\Models\Role;

trait HasRolesAndPermissions
{

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

    public function getPermissionsRole()
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

    public function getAllPermissions()
    {
        return $this->permissions
            ->merge($this->getPermissionsRole())
            ->unique('id');
    }

    public function hasPermissionTo($permission)
    {
        if (is_string($permission)){
            $permission = Permission::where('name',$permission)->first();
            if (! $permission) return false;
        }elseif (is_numeric($permission)){
            $permission = Permission::find($permission);
            if (! $permission) return false;
        }

        if (!$permission instanceof Permission){
            return  false;
        }

        $this->loadMissing('permissions','roles.permissions');

        return $this->getAllPermissions()->contains('id',$permission->id);
    }

    public function assignRole($role)
    {
        if (is_array($role)) {
            foreach ($role as $r) {
                $this->assignRole($r);
            }
            return $this;
        }

        if (is_numeric($role)){
            $role = Role::findOrFail($role);
        }elseif (is_string($role)){
            $role = Role::where('name',$role)->firstOrFail();
        }

        if (! $this->roles->contains('id',$role->id)){
            $this->roles()->attach($role);
        }

        return $this;
    }

    public function givePermissionTo($permission)
    {
        if (is_array($permission) || $permission instanceof Collection){
            foreach ($permission as $p){
                $this->givePermissionTo($p);
            }
            return $this;
        }

        if (is_string($permission)){
            $permission = Permission::where('name',$permission)->firstOrFail();
        }elseif (is_numeric($permission)){
            $permission = Permission::findOrFail($permission);
        }elseif (! $permission instanceof Permission){
            throw new \InvalidArgumentException('Permission must be id, name or Permission model.');
        }

        if (! $this->permissions->contains('id',$permission->id)){
            $this->permissions()->attach($permission);
        }
        return $this;
    }

    public function hasAnyPermission(...$permissions)
    {
        if (count($permissions) === 1 && is_array($permissions[0]) ){
            $permissions = $permissions[0];
        }

        foreach ($permissions as $permission){
            if ($this->hasPermissionTo($permission)){
                return true;
            }
        }
        return false;

    }
}
