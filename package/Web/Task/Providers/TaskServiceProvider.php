<?php

namespace Web\Task\Providers;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;
use Web\Task\Contracts\TaskInterface;
use Web\Task\Database\Seeder\TaskSeeder;
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
            "url"=>route('tasks.index')
        ]);
    }
}
