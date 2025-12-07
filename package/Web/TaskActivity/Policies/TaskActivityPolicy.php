<?php

namespace Web\TaskActivity\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Web\RolePermissions\Models\Permission;
class TaskActivityPolicy
{
    use HandlesAuthorization;

    public function index($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_BOARD);
    }

}
