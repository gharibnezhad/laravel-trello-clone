<?php

namespace  Web\TaskActivity\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Web\Task\Events\TaskCreated;
use Web\Task\Events\TaskMoved;
use Web\Task\Events\TaskUpdated;
use Web\TaskActivity\Contracts\TaskActivityInterface;
use Web\TaskActivity\Listeners\LogTaskActivity;
use Web\TaskActivity\Repositories\TaskActivityRepository;

class TaskActivityServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__.'/../Routes/taskActivity-routes.php');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views','TaskActivities');

        $this->app->bind(TaskActivityInterface::class,TaskActivityRepository::class);
    }

    public function boot()
    {
        config()->set('sidebar.items.taskActivity',[
            "icon"=>"i-courses",
            "title"=>"لاگ تسک ها",
            "url"=>route('taskActivities.index')
        ]);

        Event::listen(TaskCreated::class,LogTaskActivity::class);
        Event::listen(TaskUpdated::class,LogTaskActivity::class);
        Event::listen(TaskMoved::class,LogTaskActivity::class);
    }

}
