<?php

require_once __DIR__ . '/Product.php';

$product1 = new Product("Keyboard", 2500, 3);
$product2 = new Product("Mouse", 1200, 5);
$product3 = new Product("Monitor", 15000, 2);

echo Product::getCreatedCount();
