<?php

namespace Web\Core\Console\Commands;

use Illuminate\Console\Command;
use Web\Core\Console\Generator\ModuleGenerator;

class ModuleMakeCommand extends Command
{
    public function __construct(
        private ModuleGenerator $generator
    )
    {
        parent::__construct();
    }


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make {name} {module} {--type=service}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create class inside module';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->generator->generate(
            $this->option('type'),
            $this->argument('module'),
            $this->argument('name')
        );
        $this->info('Generated successfully');
        return self::SUCCESS;
    }
}
