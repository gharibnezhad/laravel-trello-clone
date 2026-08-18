<?php

namespace Web\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Web\Core\Console\Support\ModuleMigrationPathResolver;


class ModuleMigrateRollbackCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:migrate-rollback
                        {module? : The module name}
                        {--pretend : Dump the SQL queries without running them}
                        {--force : Force the operation to run in production}
                        {--step= : The number of migration batches to rollback}';

    protected $description = 'Rollback migrations for one or all modules';


    public function __construct(
        private ModuleMigrationPathResolver $pathResolver
    ) {
        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() : int
    {
        $module = $this->argument('module');

        $paths = $module
            ? [$this->pathResolver->resolve($module)]
            : $this->pathResolver->resolveAll();

        if (empty($paths)){
            $this->warn('No module migration paths found.');
            return self::SUCCESS;
        }
        $parameters = [
            '--path' => $paths
        ];
        if ($this->option('pretend')) {
            $parameters['--pretend'] = true;
        }

        if ($this->option('force')) {
            $parameters['--force'] = true;
        }

        if ($this->option('step') !== null) {
            $parameters['--step'] = $this->option('step');
        }

        return Artisan::call(
            'migrate:rollback',
            $parameters,
            $this->output
        );
    }


}
