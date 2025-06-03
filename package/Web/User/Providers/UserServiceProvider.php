<?php

namespace Web\User\Providers;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Web\User\Database\Seeder\UserSeeder;
use Web\User\Http\Middleware\StoreUserIp;
use Web\User\Models\User;

class UserServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__.'/../Routes/user-routes.php');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views','User');
        Factory::guessFactoryNamesUsing(function ($modelName){
            return 'Web\\User\\Database\\Factories'.class_basename($modelName) . 'Factory';
        });

        DatabaseSeeder::$seeders[] = UserSeeder::class;
        config()->set('auth.providers.users.model',User::class);


    }

    public function boot(Router $router)
    {

        $this->app['router']->pushMiddlewareToGroup('web',StoreUserIp::class);
    }
}
