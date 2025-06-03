<?php

namespace Web\Dashboard\Providers;

use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{


    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/dashboard-routes.php');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views','Dashboard');
        $this->mergeConfigFrom(__DIR__ . '/../Config/sidebar.php','sidebar');

    }
}
