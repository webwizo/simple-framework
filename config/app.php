<?php

return [
    'name' => env('APP_NAME', 'A Simple PHP Framework'),
    'url' => env('APP_URL', 'http://localhost'),
    'database' => [
        'driver' => 'mysql',
        'name' => env('DB_NAME', null),
        'username' => env('DB_USER', null),
        'password' => env('DB_PASS', null),
        'connection' => 'mysql:host=' . env('DB_HOST', null),
        'prefix' => env('DB_PREFIX', null),
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ],
];
