<?php

namespace Web\Core\Console\Commands;

use Illuminate\Console\Command;
use Web\User\Services\EmailChangeService;

class EmailChangeConcurrencyWorker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:email-change-worker {token}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs email change confirmation for concurrency testing';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(EmailChangeService $service): int
    {
        try {
            $emailChange = $service->confirm(
                $this->argument('token'));

            $this->line(json_encode([
                'status' => 'success',
                'email_change_id' => $emailChange->id,
            ]));

            return self::SUCCESS;
        }catch (\Throwable $e) {
            $this->line(json_encode([
                'status' => 'failed',
                'exception' => $e::class,
                'message' => $e->getMessage(),
            ]));

            return self::FAILURE;
        }

    }
}
