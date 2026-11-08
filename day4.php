<?php
    // Считаем общую сумму заказа
    function calculateSubtotal(array $products) : float
    {
        $subtotal = 0.0;
        foreach ($products as $product) {
            $subtotal += $product['price'] * $product['quantity'];
        }

        return $subtotal;
    }

    // Считаем скидку в денежном выражении
    function calculateDiscount(float $price, float $discount = 0.0) : float 
    {
        if ($discount > 100 || $discount < 0) {
            throw new Exception('Invalid discount');
        }
        
        return $price / 100 * $discount;
    }

    // Считаем общую сумму заказа с учётом скидки и доставки (возвращаем массив для вывода в консоль результата)
    function calculateOrderTotal(array $products, float $discount = 0.0, float $shipping = 0.0) : array 
    {
        $calculatedSubtotal = calculateSubtotal($products);
        $calculatedDiscount = calculateDiscount($calculatedSubtotal, $discount);
        return [
            'subtotal' => $calculatedSubtotal,
            'discount' => $calculatedDiscount,
            'shipping' => $shipping,
            'total' => $calculatedSubtotal - $calculatedDiscount + $shipping
        ];
    }

    $products = [
        ['name' => 'Keyboard', 'price' => 2500, 'quantity' => 1],
        ['name' => 'Mouse', 'price' => 1200, 'quantity' => 2],
        ['name' => 'Monitor', 'price' => 15000, 'quantity' => 1],
    ];

    echo json_encode(calculateOrderTotal(
        products: [],
        discount: 10.0,
        shipping: 500
    ));