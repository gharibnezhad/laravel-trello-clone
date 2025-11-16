<?php

namespace Web\Report\Providers;

use Illuminate\Support\ServiceProvider;
use Web\Report\Contracts\ReportInterface;
use Web\Report\Repositories\ReportRepository;
use Web\RolePermissions\Models\Permission;

class ReportServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadViewsFrom(__DIR__.'/../Resources/Views','Report');
        $this->loadRoutesFrom(__DIR__.'/../Routes/report-routes.php');

        $this->app->bind(ReportInterface::class,ReportRepository::class);
    }

    public function boot()
    {
        config()->set('sidebar.items.reports',[
            "icon"=>"i-user__inforamtion",
            "title"=>"گزارشات",
            "url"=>route('reports.index'),
            "permission"=>Permission::PERMISSION_SUPER_ADMIN
        ]);
    }

}
