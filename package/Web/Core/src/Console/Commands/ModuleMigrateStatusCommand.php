<?php

namespace Web\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Web\Core\Console\Support\ModuleMigrationPathResolver;


class ModuleMigrateStatusCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature =  'module:migrate-status
                            {module? : The module name}';

    protected $description = 'Show migration status for one or all modules';

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


        return Artisan::call(
            'migrate:status',
            [
                '--path' => $paths,
            ],
            $this->output
        );
    }


}
