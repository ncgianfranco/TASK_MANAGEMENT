<?php
// public/index.php
require __DIR__ . '/../vendor/autoload.php';

use App\app\core\Router;

$router = new Router();

// Authentication routes
$router->addRoute('GET', '/register', 'AuthController@registerForm');
$router->addRoute('POST', '/register', 'AuthController@register');
$router->addRoute('GET', '/login', 'AuthController@loginForm');
$router->addRoute('POST', '/login', 'AuthController@login');
$router->addRoute('GET', '/logout', 'AuthController@logout');

// Task routes (protected)
$router->addRoute('GET', '/tasks', 'TaskController@index');
$router->addRoute('GET', '/tasks/create', 'TaskController@create');
$router->addRoute('POST', '/tasks', 'TaskController@store');
$router->addRoute('GET', '/tasks/{id}/edit', 'TaskController@edit');
$router->addRoute('POST', '/tasks/{id}', 'TaskController@update');
$router->addRoute('POST', '/tasks/{id}/delete', 'TaskController@delete');

// Dispatch the request
$router->dispatch();