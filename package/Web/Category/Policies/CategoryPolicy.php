<?php

namespace Web\Category\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Web\Core\Traits\ChecksModelAccess;
use Web\RolePermissions\Models\Role;

class CategoryPolicy
{
    use HandlesAuthorization,ChecksModelAccess;

    public function index($user)
    {
        return $user->hasRole(Role::ROLE_SUPER_ADMIN);
    }

}
