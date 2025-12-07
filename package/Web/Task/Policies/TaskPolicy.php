<?php

namespace Web\Task\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Web\Core\Traits\ChecksModelAccess;
use Web\RolePermissions\Models\Permission;

class TaskPolicy
{
    use HandlesAuthorization, ChecksModelAccess;


    public function index($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_BOARD);
    }

    public function edit($user, $task)
    {
        return $this->hasModelAccess($user, $task, Permission::PERMISSION_MANAGE_OWN_BOARD);
    }

    public function members($user, $task)
    {
        return $this->hasModelAccess($user, $task, Permission::PERMISSION_MANAGE_OWN_BOARD);
    }

}
