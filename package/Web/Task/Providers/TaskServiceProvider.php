<?php

namespace Web\Task\Providers;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Web\RolePermissions\Models\Permission;
use Web\Task\Contracts\TaskInterface;
use Web\Task\Database\Seeder\TaskSeeder;
use Web\Task\Models\Task;
use Web\Task\Observers\TaskObserver;
use Web\Task\Policies\TaskPolicy;
use Web\Task\Repositories\TaskRepository;
use Web\TaskList\Contracts\TaskListInterface;


class TaskServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__.'/../Routes/task-routes.php');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views','Tasks');
        $this->app->bind(TaskInterface::class,TaskRepository::class);
        Gate::policy(Task::class,TaskPolicy::class);

        DatabaseSeeder::$seeders[] = TaskSeeder::class;
    }

    public function boot()
    {
        Factory::guessFactoryNamesUsing(function ($modelName) {
            if (str_starts_with($modelName, 'Web\\Project\\')) {
                return 'Web\\Task\\Database\\Factories\\' . class_basename($modelName) . 'Factory';
            }

            return 'Database\\Factories\\' . class_basename($modelName) . 'Factory';
        });

        config()->set('sidebar.items.tasks',[
            "icon"=>"i-courses",
            "title"=>"تسک ها",
            "url"=>route('tasks.index'),
            "permission"=>[
                Permission::PERMISSION_SUPER_ADMIN,
                Permission::PERMISSION_MANAGE_OWN_BOARD
            ]
        ]);

        Task::observe(TaskObserver::class);
    }
}
