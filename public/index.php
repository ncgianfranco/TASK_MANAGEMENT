<?php
// public/index.php
require __DIR__ . '/../vendor/autoload.php';

use App\app\core\Router;
use App\app\middleware\AuthMiddleware;

$router = new Router();

// Authentication routes
$router->addRoute('GET', '/register', 'AuthController@registerForm');
$router->addRoute('POST', '/register', 'AuthController@register');
$router->addRoute('GET', '/login', 'AuthController@loginForm');
$router->addRoute('POST', '/login', 'AuthController@login');
$router->addRoute('GET', '/logout', 'AuthController@logout');

// Task routes (protected by AuthMiddleware)
$router->addRoute('GET', '/tasks', 'TaskController@index', [AuthMiddleware::class]);
$router->addRoute('GET', '/tasks/create', 'TaskController@create', [AuthMiddleware::class]);
$router->addRoute('POST', '/tasks', 'TaskController@store', [AuthMiddleware::class]);
$router->addRoute('GET', '/tasks/{id}/edit', 'TaskController@edit', [AuthMiddleware::class]);
$router->addRoute('POST', '/tasks/{id}', 'TaskController@update', [AuthMiddleware::class]);
$router->addRoute('POST', '/tasks/{id}/delete', 'TaskController@delete', [AuthMiddleware::class]);
$router->addRoute('POST', '/tasks/{id}/complete', 'TaskController@complete', [AuthMiddleware::class]);

// Dispatch the request
$router->dispatch();