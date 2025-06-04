<?php

namespace Web\Notification\Repositories;

use Web\Notification\Interfaces\NotificationRepositoryInterface;

class EmailNotificationRepository implements NotificationRepositoryInterface
{

    public function send($notifiable, $notification)
    {
        return $notifiable->notify($notification);
    }
}
