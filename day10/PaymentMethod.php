<?php

declare(strict_types=1);

interface PaymentMethod
{
    public function pay(float $amount): bool;

    public function getName(): string;
}

// Обрабатывает платёж и возвращает результат
function processPayment(PaymentMethod $paymentMethod, float $amount): void
{
    if ($paymentMethod->pay($amount)) {
        echo 'Payment successful' . PHP_EOL;
    }
    else {
        echo 'Payment failed' . PHP_EOL;
    }
}
