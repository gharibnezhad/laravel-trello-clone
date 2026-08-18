<?php

namespace Web\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;


class ModuleMakeMigrationCommand extends Command
{


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-migration
    {name : The migration name}
    {module : The migration module}
    {--create= : The table to be created}
    {--table= : The table to be modified}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a migration inside module';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $module = $this->argument('module');
        $name = $this->argument('name');

        $moduleConfig = config("modules.$module");

        if (!$moduleConfig){
            throw  new \InvalidArgumentException(
                "Module [$module] not found"
            );
        }

        $migrationPath = $moduleConfig['base_path']
            .DIRECTORY_SEPARATOR.
            'Database'.
            DIRECTORY_SEPARATOR.
            'Migrations';
        File::ensureDirectoryExists($migrationPath);

        $relativePath = str_replace(
            base_path(). DIRECTORY_SEPARATOR,
            '',
            $migrationPath
        );

        $parameters = [
            'name' => $name,
            '--path' => $relativePath
        ];

        if ($this->option('create') !== null){
            $parameters['--create'] = $this->option('create');
        }
        if ($this->option('table') !== null) {
            $parameters['--table'] = $this->option('table');
        }

        return  Artisan::call(
            'make:migration',
            $parameters,
            $this->output
        );
    }
}
