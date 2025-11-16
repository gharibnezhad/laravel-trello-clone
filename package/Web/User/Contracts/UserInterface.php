<?php

namespace Web\User\Contracts;

use Web\User\Models\User;

interface UserInterface
{
    public function findById($id);


    public function paginate();


    public function update(User $user,$data);

    public function delete($id);


}
