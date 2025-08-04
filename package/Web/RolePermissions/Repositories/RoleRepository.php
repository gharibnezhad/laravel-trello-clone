<?php

namespace Web\RolePermissions\Repositories;

use Web\RolePermissions\Contracts\RoleInterface;
use Web\RolePermissions\Models\Role;

class RoleRepository implements RoleInterface
{

    public function getRole()
    {
        return Role::all();
    }


    public function findById($id)
    {
        return Role::findOrFail($id);
    }

    public function create(array $data)
    {
       return Role::create($data);
    }

    public function update(array $data, $id)
    {
        $role = Role::findOrFail($id);
       $role->update($data);
       return $role;
    }

    public function delete($id)
    {
        $role= Role::findOrFail($id);
        $role->delete();
        return $role;
    }
}
