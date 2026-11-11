<?php

require_once __DIR__ . '/Product.php';

use Product;

try {
    $products = [];
    $products[] = new Product("Keyboard", 2500, 3);
    $products[] = new Product("Mouse", 1200, 5);
    $products[] = new Product("Monitor", 15000, 2);

    $sum = 0;
    foreach ($products as $product) {
        $sum += $product->getTotalPrice();
    }

    echo "Total price of all products: " . $sum . PHP_EOL;
} catch (Throwable $e) {
    echo $e->getMessage() . PHP_EOL;
}
