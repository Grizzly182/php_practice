<?php

declare(strict_types=1);

require_once __DIR__ . '/Notification.php';

class EmailNotification extends Notification
{
    public function __construct(
        private string $subject,
        string $recipient,
        string $message
    ) {
        $this->subject = trim($this->subject);
        parent::__construct($recipient, $message);

        if ($this->subject === '') {
            throw new InvalidArgumentException('Subject cannot be empty!');
        }

        if (filter_var($recipient, FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidArgumentException('Invalid Email!');
        }
    }

    public function format(): string
    {
        return "Email: {$this->recipient} | Тема: {$this->subject} | Текст: {$this->message}";
    }
}
