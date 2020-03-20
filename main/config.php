<?php

return [
    'name' => 'Мой магазин',
    'defaultController' => 'good',

    'components' => [
        'db' => [
            'class' => \App\services\DB::class,
            'config' => [
                'driver' => 'mysql',
                'host' => 'localhost',
                'dbname' => 'gbphp',
                'charset' => 'UTF8',
                'username' => 'root',
                'password' => '',
            ]
        ],
        'renderer' => [
            'class' => \App\services\TwigRenderer::class
        ],
        'goodRepository' => [
            'class' => \App\repositories\GoodRepository::class
        ],
        'request' => [
            'class' => \App\services\Request::class
        ],
        'CartRepository' => [
            'class' => \App\repositories\CartRepository::class
        ],
        'UserRepository' => [
            'class' => \App\repositories\UserRepository::class
        ],
        'AuthService' => [
            'class' => \App\services\AuthService::class
        ],
        'OrderRepository' => [
            'class' => \App\repositories\OrderRepository::class
        ],
        'UserService' => [
            'class' => \App\services\UserService::class
        ],
        'CartService' => [
            'class' => \App\services\CartService::class
        ],
        'OrderService' => [
            'class' => \App\services\OrderService::class
        ]
    ]
];
