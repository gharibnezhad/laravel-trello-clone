<?php

namespace Web\User\Providers;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Web\RolePermissions\Models\Permission;
use Web\User\Contracts\EmailChangeRepositoryInterface;
use Web\User\Contracts\UserInterface;
use Web\User\Database\Seeder\UserSeeder;
use Web\User\Http\Middleware\EnsureProfilePasswordConfirmed;
use Web\User\Http\Middleware\StoreUserIp;
use Web\User\Models\User;
use Web\User\Policies\UserPolicy;
use Web\User\Repositories\EmailChangeRepository;
use Web\User\Repositories\UserRepository;
use Web\User\Services\PasswordConfirmationService;

class UserServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__.'/../Routes/user-routes.php');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views','User');
        $this->app->bind(UserInterface::class,UserRepository::class);
        $this->app->singleton(PasswordConfirmationService::class);
        $this->app->bind(EmailChangeRepositoryInterface::class,EmailChangeRepository::class);


        DatabaseSeeder::$seeders[] = UserSeeder::class;
        config()->set('auth.providers.users.model',User::class);
        Gate::policy(User::class,UserPolicy::class);

    }

    public function boot(Router $router)
    {
        Factory::guessFactoryNamesUsing(function ($modelName){
            if (str_starts_with($modelName,'Web\\User\\')){
                return 'Web\\User\\Database\\Factories\\'.class_basename($modelName) . 'Factory';
            }
            return  'Database\\Factories\\' .class_basename($modelName) . 'Factory';
        });


        config()->set('sidebar.items.users',[
            "icon"=>"i-users",
            "title"=>"اطلاعات کاربران",
            "url"=>route('users.index'),
            "permission" => Permission::PERMISSION_SUPER_ADMIN
        ]);

        config()->set('sidebar.items.usersInformation',[
            "icon"=> "i-user__inforamtion",
            "title"=> "پروفایل کاربری",
            "url" => url('users/profile')
        ]);

        $this->app['router']->pushMiddlewareToGroup('web',StoreUserIp::class);
        $this->app['router']->aliasMiddleware('auth.password.confirmed.at',EnsureProfilePasswordConfirmed::class);

    }
}
