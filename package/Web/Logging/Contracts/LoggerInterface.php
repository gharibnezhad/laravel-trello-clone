<?php

namespace Web\Logging\Contracts;

interface LoggerInterface
{
    public function log(string $message);
}
