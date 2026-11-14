<?php

declare(strict_types=1);

require_once __DIR__ . '/Notification.php';

class SmsNotification extends Notification
{
    public function format(): string
    {
        return "SMS: {$this->recipient} | Текст: {$this->message}";
    }
}
