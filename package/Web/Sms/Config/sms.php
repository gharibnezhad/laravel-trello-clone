<?php
return [
    'default' => env('SMS_PROVIDER','log'),

    'providers' => [
        'log' => [
            'class' => \Web\Sms\Services\LogSmsProvider::class
        ],

        'kavenegar' => [
            'class' => \Web\Sms\Services\KavenegarSmsProvider::class,
            'api_key' => env('KAVENEGAR_API_KEY'),
            'sender' => env('KAVENEGAR_SENDER'),
        ],
    ],
];
