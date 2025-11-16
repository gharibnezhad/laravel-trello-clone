<?php

namespace Web\User\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Web\RolePermissions\Models\Permission;
use Web\User\Models\User;

class UserPolicy
{
    use HandlesAuthorization;

    public function index($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)){
            return true;
        }
    }

    public function edit($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)){
            return true;
        }
    }

    public function update($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)){
            return true;
        }
    }

    public function delete($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)){
            return true;
        }
    }

    public function manualVerify($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)){
            return true;
        }
    }

    public function view(User $authUser,User $user)
    {
        return $authUser->id === $user->id;
    }

    public function editProfile(User $authUser,User $user)
    {
        return $authUser->id === $user->id;
    }

    public function updateProfile(User $authUser,User $user)
    {
        return $authUser->id === $user->id;
    }
}
