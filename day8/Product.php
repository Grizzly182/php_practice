<?php

declare(strict_types = 1);

class Product
{
    public const CURRENCY = 'RUB';

    private readonly int $id;
    private static int $nextId = 1;
    
    public function __construct(
        private string $name,
        private int|float $price,
        private int $quantity)
    {
        $this->name = trim($this->name);
        
        if ($quantity < 0) {
            throw new InvalidArgumentException('Quantity cannot be negative!');
        }
        if ($price < 0) {
            throw new InvalidArgumentException('Price cannot be negative!');
        }
        if ($name === '') {
            throw new InvalidArgumentException('Name must be not empty!');
        }
        
        $this->id = self::$nextId;

        self::$nextId++;
    }
    
    public function getName(): string
    {
        return $this->name;
    }
    
    public function getPrice(): int|float
    {
        return $this->price;
    }
    
    public function getQuantity(): int
    {
        return $this->quantity;
    }
    
    public function increaseQuantity(int $amount): void
    {
        if ($amount < 0) {
            throw new InvalidArgumentException("Amount must be greater than 0");
        }
        
        $this->quantity += $amount;
    }
    
    public function decreaseQuantity(int $amount): void
    {
        if ($amount < 0) {
            throw new InvalidArgumentException('Amount must be greater than 0!');
        }
        if ($this->quantity - $amount < 0) {
            throw new InvalidArgumentException('Quantity cannot be negative!');
        }
        
        $this->quantity -= $amount;
    }
    
    public function getTotalPrice(): int|float
    {
        return $this->price * $this->quantity;
    }
    
    public function getInfo(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'total_price' => $this->getTotalPrice(),
            'currency' => self::CURRENCY
        ];
    }


    public static function getCreatedCount(): int
    {
        return self::$nextId - 1;
    }
}
