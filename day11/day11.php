<?php

require_once __DIR__ . '/Order.php';

$notification = new \OrderNotification(new \Order(15, 2500));
$notifier = new \OrderNotifier($notification);
$orderService = new \OrderService($notifier);

$order = $orderService->createOrder(15, 2500);

echo $order->getId() . PHP_EOL;
echo $order->getTotal();
