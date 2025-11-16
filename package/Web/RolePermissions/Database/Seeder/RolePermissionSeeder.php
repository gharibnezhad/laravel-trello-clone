<?php

namespace Web\RolePermissions\Database\Seeder;

use Illuminate\Database\Seeder;
use Web\RolePermissions\Models\Permission;
use Web\RolePermissions\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Permission::$permissions as $permission){
           Permission::query()->firstOrCreate(['name'=>$permission]);
        }

        Role::query()->updateOrCreate(['id'=>Role::OWNER],['name'=>'Owner']);
        Role::query()->updateOrCreate(['id'=>Role::MEMBER],['name'=>'Member']);
        Role::query()->updateOrCreate(['id'=>Role::VIEWER],['name'=>'Viewer']);

        foreach (Role::$roles as $roleName => $permissionNames){
          $role =  Role::query()->firstOrCreate(['name'=>$roleName]);
          $permissionIds = Permission::whereIn('name',$permissionNames)->pluck('id');
          $role->permissions()->sync($permissionIds);
        }
    }
}
