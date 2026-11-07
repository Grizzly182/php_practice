<?php
    function getAffordableProducts(array $products, int|float $maxPrice) : array
    {
        // Фильтруем сначала товары по цене, если их нет в наличии - отбрасываем сразу же
        $result = array_filter($products, function ($product) use ($maxPrice) {
            if($product['in_stock']) {
                return $product['price'] <= $maxPrice;
            }
            return false;
        });

        // Сортируем по цене и если цены РАВНЫ, то по алфавиту
        usort($result, function ($a, $b) {
            if (($a['price'] <=> $b['price']) === 0) {
                return $a['name'] <=> $b['name'];
            }
            return $a['price'] <=> $b['price'];
        });
        
        // Возвращаем массив товаров, сохраняя только id, name и price
        return array_map(function ($product) {
            return [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price']
            ];
        }, $result);
    }

    $products = [
        ['id' => 1, 'name' => 'Mouse', 'price' => 2000, 'in_stock' => true],
        ['id' => 2, 'name' => 'Keyboard', 'price' => 2000, 'in_stock' => true],
        ['id' => 3, 'name' => 'Monitor', 'price' => 2000, 'in_stock' => true],
    ];

    echo json_encode(getAffordableProducts($products, 2000));