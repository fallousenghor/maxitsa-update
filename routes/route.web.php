<?php



use Maxitsa\Controller\ErrorController;
use Maxitsa\Controller\HomeController;
use Maxitsa\Controller\UserController;






return [
    'GET' => [
        '/' => [UserController::class, 'login'],
        '/signup' => [UserController::class, 'signup'],
        '/login' => [UserController::class, 'login'],
        '/accueil' => [HomeController::class, 'index',"middlewares" => ['auth']],
        '/transactions' => [HomeController::class, 'transactions',"middlewares" => ['auth']],
        '/error404' => [ErrorController::class, 'error404'],
    ],
    'POST' => [
        '/signin' => [UserController::class, 'signin'],
        '/signup' => [UserController::class, 'signup'],
    ]
];

