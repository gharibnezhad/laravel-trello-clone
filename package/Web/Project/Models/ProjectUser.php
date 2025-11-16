<?php

namespace Web\Project\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Web\RolePermissions\Models\Role;

class ProjectUser extends Pivot
{
    protected $table = 'project_user';

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
