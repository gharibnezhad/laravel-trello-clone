<?php

namespace Web\Logging\Providers;

use Illuminate\Support\ServiceProvider;
use Web\Logging\Contracts\LoggerInterface;
use Web\Logging\Services\CustomLogger;

class LoggerServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton(LoggerInterface::class,function ($app){
            return new CustomLogger();
        });
    }

    public function boot()
    {

    }
}
