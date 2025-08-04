<?php

namespace Web\RolePermissions\Services;

use Web\RolePermissions\Contracts\PermissionInterface;
use Web\RolePermissions\Contracts\RoleInterface;

class RolePermissionService
{

    protected $roleRepo;
    protected $permissionRepo;

    public function __construct(RoleInterface $roleRepo,PermissionInterface $permissionRepo)
    {
        $this->roleRepo = $roleRepo;
        $this->permissionRepo = $permissionRepo;
    }

    public function getRole()
    {
        return $this->roleRepo->getRole();
    }

    public function getPermission()
    {
        return $this->permissionRepo->getPermission();
    }

    public function findRole($id)
    {
        return $this->roleRepo->findById($id);
    }

    public function store($request)
    {
        $role = $this->roleRepo->create([
            "name"=>$request->name
        ]);

        $role->permissions()->attach($request->permissions);

        return $role;
    }

    public function update($request, $id)
    {

      $role = $this->roleRepo->update([
           "name" => $request->name,
       ],$id);

        $role->permissions()->sync($request->permissions);

        return $role;
    }

    public function delete($id)
    {
        $role = $this->roleRepo->findById($id);
        $role->permissions()->detach();
        $this->roleRepo->delete($id);

        return $role;
    }
}
