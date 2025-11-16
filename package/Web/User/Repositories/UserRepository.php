<?php

namespace Web\User\Repositories;

use Web\User\Contracts\UserInterface;
use Web\User\Models\User;

class UserRepository implements UserInterface
{

    public function findById($id)
    {
        return User::findOrFail($id);
    }

    public function paginate()
    {
        return User::paginate();
    }

    public function update(User $user, $data)
    {
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }
}
