<?php

declare(strict_types=1);

require_once __DIR__ . '/PaymentMethod.php';
require_once __DIR__ . '/CreditCardPayment.php';
require_once __DIR__ . '/WalletPayment.php';

try {
    processPayment(new CreditCardPayment('1234 1234 1234 1234'), 1500);
    processPayment(new CreditCardPayment('1234 1234 1234 1234'), -100);
    processPayment(new WalletPayment(2000), 1500);
    processPayment(new WalletPayment(2000), 2500);
    processPayment(new WalletPayment(2000), 0);
} catch (Throwable $e) {
    echo $e->getMessage() . PHP_EOL;
}