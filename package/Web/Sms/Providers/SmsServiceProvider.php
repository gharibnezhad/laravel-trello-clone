<?php

namespace Web\Sms\Providers;


use Illuminate\Support\ServiceProvider;
use Web\Sms\Contracts\SmsProviderInterface;
use Web\Sms\Services\LogSmsProvider;

class SmsServiceProvider extends ServiceProvider
{

    public function register()
    {

        $this->app->bind(SmsProviderInterface::class,function (){
            $provider = config('sms.default');
            $class = config("sms.providers.$provider.class");

            return new $class;
        });
    }

    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../Config/sms.php','sms');
    }
}
