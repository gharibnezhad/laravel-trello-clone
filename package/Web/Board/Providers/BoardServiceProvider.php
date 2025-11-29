<?php

namespace Web\Board\Providers;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Web\Board\Database\Seeder\BoardSeeder;
use Web\Board\Contracts\BoardInterface;
use Web\Board\Models\Board;
use Web\Board\Policies\BoardPolicy;
use Web\Board\Repositories\BoardRepository;
use Web\RolePermissions\Models\Permission;

class BoardServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/board-routes.php');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views','Board');
        $this->loadJsonTranslationsFrom(__DIR__.'/../Resources/lang');
        DatabaseSeeder::$seeders[] = BoardSeeder::class;
        $this->app->bind(BoardInterface::class,BoardRepository::class);
        Gate::policy(Board::class,BoardPolicy::class);
    }

    public function boot()
    {
        Factory::guessFactoryNamesUsing(function ($modelName) {
            if (str_starts_with($modelName, 'Web\\Board\\')) {
                return 'Web\\Board\\Database\\Factories\\' . class_basename($modelName) . 'Factory';
            }

            return 'Database\\Factories\\' . class_basename($modelName) . 'Factory';
        });

        config()->set('sidebar.items.Boards',[
            'icon' => 'i-articles',
            'title' => 'بردها',
            'url' => route('boards.index'),
            "permission"=>[
                Permission::PERMISSION_SUPER_ADMIN,
                Permission::PERMISSION_MANAGE_OWN_BOARD,
            ]
        ]);


    }
}
