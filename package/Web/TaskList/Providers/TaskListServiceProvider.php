<?php

namespace Web\TaskList\Providers;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Web\RolePermissions\Models\Permission;
use Web\TaskList\Contracts\TaskListInterface;
use Web\TaskList\Models\TaskList;
use Web\TaskList\Policies\TaskListPolicy;
use Web\TaskList\Repositories\TaskListRepository;

class TaskListServiceProvider extends ServiceProvider
{


    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__.'/../Routes/taskList-routes.php');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views','TaskList');
        $this->app->bind(TaskListInterface::class,TaskListRepository::class);
        Gate::policy(TaskList::class,TaskListPolicy::class);


    }

    public function boot()
    {
        Factory::guessFactoryNamesUsing(function ($modelName) {
            if (str_starts_with($modelName, 'Web\\Project\\')) {
                return 'Web\\TaskList\\Database\\Factories\\' . class_basename($modelName) . 'Factory';
            }

            return 'Database\\Factories\\' . class_basename($modelName) . 'Factory';
        });

        config()->set('sidebar.items.taskLists',[
            "icon"=>"i-user__inforamtion",
            "title"=>"تسک لیست ها",
            "url"=>route('taskLists.index'),
            "permission"=>[
                Permission::PERMISSION_SUPER_ADMIN,
                Permission::PERMISSION_MANAGE_OWN_BOARD
            ]
        ]);

    }
}
