<?php

declare(strict_types=1);

class OrderNotification
{
    public function format(Order $order): string
    {
        return "Order {$order->getId()} with the total of {$order->getTotal()} RUB succesfully processed!";
    }
}

class Order
{
    public function __construct(
        private int $id,
        private float $total
    ) {
        if ($this->id <= 0) {
            throw new InvalidArgumentException("Id must be greater than zero!");
        }
        if ($this->total < 0) {
            throw new InvalidArgumentException('Total cannot be negative!');
        }
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getTotal(): float
    {
        return $this->total;
    }
}

class OrderNotifier
{
    public function __construct(private OrderNotification $notification)
    {
    }

    public function notify(Order $order): void
    {
        echo $this->notification->format($order) . PHP_EOL;
    }
}

class OrderService
{
    public function __construct(private OrderNotifier $notifier)
    {
    }

    public function createOrder(int $id, float $total): Order
    {
        $order = new Order($id, $total);
        $this->notifier->notify($order);

        return $order;
    }
}
