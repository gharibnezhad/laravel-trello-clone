<?php

namespace Web\TaskList\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Web\RolePermissions\Models\Permission;
class TaskListPolicy
{
    use HandlesAuthorization;

    public function index($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_BOARD);
    }

}
