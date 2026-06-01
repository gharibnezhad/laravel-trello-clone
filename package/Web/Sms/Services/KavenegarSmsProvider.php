<?php

namespace Web\Sms\Services;

use Kavenegar\KavenegarApi;
use Web\Sms\Contracts\SmsProviderInterface;
use Exception;
class KavenegarSmsProvider implements SmsProviderInterface
{
    protected KavenegarApi $client;
    protected string $sender;

    public function __construct()
    {
        $this->client = new KavenegarApi(config('sms.providers.kavenegar.api_key'));
        $this->sender = config('sms.providers.kavenegar.sender');
    }


    public function send(string $mobile, string $message): bool
    {

        try {
            $this->client->Send(
                $this->sender,
                $mobile,
                $message
            );

            return true;
        }catch (Exception $e){

            logger()->error('kavenegar SMS failed',[
                'mobile' => $mobile,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }
}
