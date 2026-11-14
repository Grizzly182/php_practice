<?php

declare(strict_types=1);

abstract class Notification
{
    public function __construct(
        protected string $recipient,
        protected string $message
    ) {
        $this->recipient = trim($this->recipient);
        $this->message = trim($this->message);

        if ($this->recipient === '' || $this->message === '') {
            throw new InvalidArgumentException('Recipient or message cannot be empty!');
        }
    }

    abstract public function format(): string;
}
