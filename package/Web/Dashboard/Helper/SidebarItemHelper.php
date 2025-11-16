<?php

namespace Web\Dashboard\Helper;

use Web\RolePermissions\Models\Permission;

class SidebarItemHelper
{

    public static function  canView($user , array $item)
    {
        if (!array_key_exists('permission',$item)){
            return true;
        }

        if (!$user){
            return false;
        }

        if ($user->hasPermissionTo(Permission::PERMISSION_SUPER_ADMIN)){
            return  true;
        }
        $userPermission = $user->getAllPermissions()->pluck('name')->toArray();
        return collect($item['permission'])->contains(fn($p) => in_array($p,$userPermission));
    }
}
