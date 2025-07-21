<?php

namespace Web\Logging\Services;

use Web\Logging\Contracts\LoggerInterface;

class CustomLogger implements LoggerInterface
{

    protected string $logFile;

    public function __construct()
    {
        $this->logFile  = config('custom_logger.path');
    }

    public function log(string $message)
    {
        $date = date('Y-m-d H:i:s');
        file_put_contents($this->logFile,"[$date,$message]".PHP_EOL,FILE_APPEND);
    }
}
