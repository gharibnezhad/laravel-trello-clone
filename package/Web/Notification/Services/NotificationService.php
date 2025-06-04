<?php

namespace Web\Notification\Services;


use Web\Notification\Interfaces\NotificationRepositoryInterface;

class NotificationService
{

    public function __construct(protected NotificationRepositoryInterface $repository)
    {

    }

    public function send($notifiable,$notification)
    {
        $this->repository->send($notifiable,$notification);
    }
}
