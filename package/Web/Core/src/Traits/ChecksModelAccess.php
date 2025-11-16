<?php

namespace Web\Core\Traits;

use Illuminate\Database\Eloquent\Model;

trait ChecksModelAccess
{


    protected function hasModelAccess($user, Model $model, string $permission, string $relation = 'users')
    {
        return $user->hasPermissionTo($permission)
            && method_exists($model, $relation)
            && $model->{$relation}()->where('user_id', $user->id)->exists();
    }
}
