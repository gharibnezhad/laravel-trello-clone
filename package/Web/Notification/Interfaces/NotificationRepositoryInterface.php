<?php

namespace Web\Notification\Interfaces;

interface NotificationRepositoryInterface
{
    public function send($notifiable, $notification);

}
