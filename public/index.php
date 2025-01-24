<?php

require_once __DIR__.'/../vendor/autoload.php';

use App\app\core\Router;

// Create new router
$router = new Router();

// Define routes
$router->addRoute('GET', '/', 'HomeController@index');
$router->addRoute('GET', '/about', 'HomeController@about');
$router->addRoute('GET', '/tasks', 'TaskController@index');
$router->addRoute('GET', '/tasks/create', 'TaskController@create');
$router->addRoute('POST', '/tasks', 'TaskController@store');
$router->addRoute('GET', '/tasks/{id}/edit', 'TaskController@edit');
$router->addRoute('POST', '/tasks/{id}', 'TaskController@update');
$router->addRoute('POST', '/tasks/{id}/delete', 'TaskController@delete');

// Dispatch the request

$router->dispatch();