<?php

use Maxitsa\Controller\HomeController;
use Maxitsa\Controller\UserController;




return [
    'GET' => [
        '/' => [UserController::class, 'login'],
        '/signup' => [UserController::class, 'signup'],
        '/login' => [UserController::class, 'login'],
        '/accueil' => [HomeController::class, 'index'],
    ],
    'POST' => [
        '/signin' => [UserController::class, 'signin'],
        '/signup' => [UserController::class, 'signup'],
    ]
];

