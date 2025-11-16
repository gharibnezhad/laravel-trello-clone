<?php

namespace Web\Project\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Web\Core\Traits\ChecksModelAccess;
use Web\Project\Models\Project;
use Web\RolePermissions\Models\Permission;

class ProjectPolicy
{
    use HandlesAuthorization,ChecksModelAccess;


    public function index($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_PROJECT);
    }

    public function show($user,$project)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_PROJECT)
            || $project->users()->where('user_id',$user->id)->exists();
    }

    public function create($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_PROJECT);
    }

    public function store($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_PROJECT);
    }

    public function edit($user,$project)
    {
        return $this->hasModelAccess($user,$project,Permission::PERMISSION_MANAGE_OWN_PROJECT);
    }

    public function update($user,$project)
    {
        return $this->hasModelAccess($user,$project,Permission::PERMISSION_MANAGE_OWN_PROJECT);
    }

    public function delete($user,$project)
    {
        return $this->hasModelAccess($user,$project,Permission::PERMISSION_MANAGE_OWN_PROJECT);
    }

    public function members($user,$project)
    {
        return $this->hasModelAccess($user,$project,Permission::PERMISSION_MANAGE_OWN_PROJECT);
    }


}
