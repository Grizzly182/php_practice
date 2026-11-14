<?php

declare(strict_types=1);

require_once __DIR__ . '/PaymentMethod.php';

class CreditCardPayment implements PaymentMethod
{
    public function __construct(private string $cardNumber)
    {
        $this->cardNumber = trim($this->cardNumber);

        if ($this->cardNumber === '') {
            throw new InvalidArgumentException('Card number is empty');
        }
    }
    public function pay(float $amount): bool
    {
        return $amount > 0;
    }

    public function getName(): string
    {
        return 'Credit Card';
    }
}
