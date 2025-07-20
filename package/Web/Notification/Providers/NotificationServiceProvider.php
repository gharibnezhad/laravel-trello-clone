<?php

namespace Web\Notification\Providers;

use Illuminate\Support\ServiceProvider;
use Web\Notification\Interfaces\NotificationRepositoryInterface;
use Web\Notification\Repositories\CompositeNotificationRepository;
use Web\Notification\Repositories\EmailNotificationRepository;

class NotificationServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(NotificationRepositoryInterface::class,function ($app){
            return new CompositeNotificationRepository([
                $app->make(EmailNotificationRepository::class)
            ]);
        });
    }

    public function boot()
    {

    }
}
