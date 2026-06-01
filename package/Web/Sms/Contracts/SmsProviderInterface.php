<?php

namespace Web\Sms\Contracts;

interface SmsProviderInterface
{

    public function send(string $mobile ,string $message) : bool;
}
