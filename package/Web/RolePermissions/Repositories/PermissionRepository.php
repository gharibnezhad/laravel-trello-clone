<?php

namespace Web\RolePermissions\Repositories;

use Web\RolePermissions\Contracts\PermissionInterface;
use Web\RolePermissions\Models\Permission;

class PermissionRepository implements PermissionInterface
{

    public function getPermission()
    {
        return Permission::all();
    }
}
