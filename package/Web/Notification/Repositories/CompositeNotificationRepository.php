<?php

namespace Web\Notification\Repositories;

use Web\Notification\Interfaces\NotificationRepositoryInterface;

class CompositeNotificationRepository implements NotificationRepositoryInterface
{

    protected array $channels;
    public function __construct(array $channels)
    {
        $this->channels = $channels;
    }

    public function send($notifiable, $notification)
    {
        foreach ($this->channels as $channel){
            $channel->send($notifiable,$notification);
        }
    }
}
