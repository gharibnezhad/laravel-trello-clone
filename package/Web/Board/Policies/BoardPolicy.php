<?php

namespace Web\Board\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Web\Core\Traits\ChecksModelAccess;
use Web\RolePermissions\Models\Permission;
use Web\RolePermissions\Models\Role;

class BoardPolicy
{
    use HandlesAuthorization,ChecksModelAccess;


    public function index($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_BOARD);
    }

    public function create($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_BOARD);
    }

    public function view($user,$board)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_BOARD)
            || $board->users()->where('user_id',$user->id)->exists();
    }

    public function store($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_BOARD);
    }

    public function edit($user,$board)
    {
      return $this->hasModelAccess($user,$board,Permission::PERMISSION_MANAGE_OWN_BOARD);
    }

    public function update($user,$board)
    {
        return $this->hasModelAccess($user,$board,Permission::PERMISSION_MANAGE_OWN_BOARD);
    }

    public function delete($user,$board)
    {
        return $this->hasModelAccess($user,$board,Permission::PERMISSION_MANAGE_OWN_BOARD);
    }

    public function members($user,$board)
    {
        return $this->hasModelAccess($user,$board,Permission::PERMISSION_MANAGE_OWN_BOARD);
    }

    public function createMemberToBoard($user,$board)
    {
        return $this->hasModelAccess($user,$board,Permission::PERMISSION_MANAGE_OWN_BOARD);
    }

    public function addMemberToBoard($user,$board)
    {
        return $this->hasModelAccess($user,$board,Permission::PERMISSION_MANAGE_OWN_BOARD);
    }

    public function removeMemberToBoard($user,$board)
    {
        return $this->hasModelAccess($user,$board,Permission::PERMISSION_MANAGE_OWN_BOARD);
    }
}
