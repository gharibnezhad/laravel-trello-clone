<?php

namespace Web\Sms\Services;

use Illuminate\Support\Facades\Log;
use Web\Sms\Contracts\SmsProviderInterface;

class LogSmsProvider implements SmsProviderInterface
{

    public function send(string $mobile, string $message): bool
    {
        Log::info('SMS sent',[
            'mobile' => $mobile,
            'message' => $message
        ]);

        return  true;
    }
}
