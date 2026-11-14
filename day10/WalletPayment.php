<?php

declare(strict_types=1);

require_once __DIR__ . '/PaymentMethod.php';


class WalletPayment implements PaymentMethod
{
    public function __construct(private float $balance)
    {
        if ($this->balance < 0) {
            throw new InvalidArgumentException('Balance cannot be negative');
        }
    }  
    public function pay(float $amount): bool
    {
        if ($amount <= 0) {
            return false;
        }

        if ($this->balance >= $amount) {
            $this->balance -= $amount;
            return true;
        }
        return false;
    }

    public function getName(): string
    {
        return 'E-Wallet';
    }

    public function getBalance(): float
    {
        return $this->balance;
    }
}
