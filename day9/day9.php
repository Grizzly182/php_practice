<?php

require_once __DIR__ . '/EmailNotification.php';
require_once __DIR__ . '/SmsNotification.php';

// Изучаем абстрактные классы и полиморфизм
try {
    $notifications = [
        new EmailNotification('     ', 'VZo5F@example.com', 'Hello!'),
        new SmsNotification('    +380501234567  ', 'Hello!'),
        new SmsNotification('  ds  ', 'выфв')];
    
    foreach ($notifications as $notification) {
        echo $notification->format() . PHP_EOL;
    }
} catch (Throwable $e) {
    echo $e->getMessage();
}
