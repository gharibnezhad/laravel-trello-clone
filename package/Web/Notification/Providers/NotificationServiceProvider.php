<?php

namespace Web\Notification\Providers;

use Illuminate\Support\ServiceProvider;
use Web\Notification\Interfaces\NotificationRepositoryInterface;
use Web\Notification\Repositories\EmailNotificationRepository;

class NotificationServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(NotificationRepositoryInterface::class,
            EmailNotificationRepository::class);
    }

    public function boot()
    {

    }
}
