<?php

namespace Web\RolePermissions\Providers;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Web\RolePermissions\Contracts\PermissionInterface;
use Web\RolePermissions\Contracts\RoleInterface;
use Web\RolePermissions\Database\Seeder\RolePermissionSeeder;
use Web\RolePermissions\Models\Permission;
use Web\RolePermissions\Models\Role;
use Web\RolePermissions\Policies\RolePermissionPolicy;
use Web\RolePermissions\Repositories\PermissionRepository;
use Web\RolePermissions\Repositories\RoleRepository;

class RolePermissionServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/role_permission_routes.php');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views','RolePermissions');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        DatabaseSeeder::$seeders[] = RolePermissionSeeder::class;
        Gate::policy(Role::class,RolePermissionPolicy::class);

        Gate::before(function ($user){
           return $user->hasPermissionTo(Permission::PERMISSION_SUPER_ADMIN) ? true : null;
        });


        $this->app->bind(RoleInterface::class,RoleRepository::class);
        $this->app->bind(PermissionInterface::class,PermissionRepository::class);
    }

    public function boot()
    {

        config()->set('sidebar.items.role_permissions',[
            "icon" => "i-courses",
            "title" => "نقش های کاربری",
            "url" => route('role-permissions.index'),
            "permission" => Permission::PERMISSION_SUPER_ADMIN
        ]);

    }
}
