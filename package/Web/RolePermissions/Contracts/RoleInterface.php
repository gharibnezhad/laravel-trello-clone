<?php
namespace Web\RolePermissions\Contracts;


interface RoleInterface
{
    public function getRole();

    public function findById($id);

    public function create(array $data);

    public function update(array $data,$id);

    public function delete($id);

}
