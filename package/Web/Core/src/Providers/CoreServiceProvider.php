<?php
namespace Web\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Web\Core\Console\Commands\ModuleMakeCommand;
use Web\Core\Console\Commands\ModuleMakeMigrationCommand;
use Web\Core\Console\Commands\ModuleMigrateCommand;
use Web\Core\Console\Commands\ModuleMigrateRefreshCommand;
use Web\Core\Console\Commands\ModuleMigrateResetCommand;
use Web\Core\Console\Commands\ModuleMigrateRollbackCommand;
use Web\Core\Console\Commands\ModuleMigrateStatusCommand;
use Web\Core\Console\Generator\ModuleGenerator;
use Web\Core\Console\Support\ModuleMigrationPathResolver;


class CoreServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/modules.php', 'modules');
        $this->mergeConfigFrom(__DIR__.'/../../config/generator.php', 'generator');

        $this->app->singleton(ModuleGenerator::class,ModuleGenerator::class);
        $this->app->singleton(ModuleMigrationPathResolver::class,ModuleMigrationPathResolver::class);
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->commands([

                ModuleMakeCommand::class,
                ModuleMakeMigrationCommand::class,
                ModuleMigrateCommand::class,
                ModuleMigrateRollbackCommand::class,
                ModuleMigrateRefreshCommand::class,
                ModuleMigrateResetCommand::class,
                ModuleMigrateStatusCommand::class

            ]);

        }
    }
}
