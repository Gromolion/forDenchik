<?php

return [
    '/api/v1/auth' => [
        'method' => ['POST'], // Обработка только POST-запросов
        'action' => 'AuthController@auth', // Какой метод контроллера будет запускаться
    ],
    '/api/v1/logout' => [
        'method' => ['GET'],
        'action' => 'AuthController@logout',
        'middlewares' => ['Auth']
    ],
    '/api/v1/profile' => [
        'method' => ['GET'],
        'action' => 'ProfileController@index',
        'middlewares' => ['Auth']
    ],
    '/api/v1/register' => [
        'method' => ['POST'],
        'action' => 'RegController@register'
    ]
];
