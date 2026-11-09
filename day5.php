<?php

function validateUserData(array $data): array
{
    // Все поля обязательные! Если какого-то нет, то кидаем ошибку
    if (!isset($data['name']) || !isset($data['email']) || !isset($data['age'])) {
        throw new InvalidArgumentException('Array doesn\'t have required data!');
    }

    $name = trim($data['name']);
    $email = trim($data['email']);
    $age = $data['age'];

    if (mb_strlen($name) < 2) {
        throw new InvalidArgumentException('Invalid name!');
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new InvalidArgumentException('Invalid email!');
    }
    if (!filter_var($age, FILTER_VALIDATE_INT) || $age < 18 || $age > 120) {
        throw new InvalidArgumentException('Invalid age!');
    }

    return [
        'name' => $name,
        'email' => $email,
        'age' => (int)$age
    ];
}

$users = [
    ['name' => 'John', 'email' => 'john@i.ua', 'age' => 15],
    ['name' => 'Mikhail', 'email' => 'belousovmihalres@gmail.com', 'age' => 22],
    ['name' => 'Silvanna', 'email' => 'sadasd@i.ua', 'age' => 20],
    ['name' => 'I', 'email' => 'Revy@ia.ua', 'age' => 20],
    ['name' => 'Roger', 'email' => 'Rogeria.ua', 'age' => 29],
];

foreach ($users as $user) {
    try {
        $validatedUser = validateUserData($user);
        echo json_encode($validatedUser) . PHP_EOL;
    } catch (Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    }
}
