<?php

namespace Web\Project\Contracts;

use Web\User\Models\User;

interface ProjectInterface
{

    public function findProjectWithCategory($id);

    public function getAllProjectForUser(User $user);

    public function update(array $data,$id);

    public function store(array $data);

    public function destroy($id);
}
