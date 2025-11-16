<?php
namespace Web\Media\Providers;

use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->mergeConfigFrom(__DIR__.'/../Config/mediaFile.php','mediaFile');
    }

    public function boot()
    {

    }


}
