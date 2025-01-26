<?php 

use App\app\core\Router;

$router = new Router();

// API routes
$router->addRoute('GET', '/api/tasks', 'ApiController@index');
$router->addRoute('GET', '/api/tasks/{id}', 'ApiController@show');
$router->addRoute('POST', '/api/tasks', 'ApiController@store');
$router->addRoute('PUT', '/api/tasks/{id}', 'ApiController@update');
$router->addRoute('DELETE', '/api/tasks/{id}', 'ApiController@destroy');

// Dispatch the request
$router->dispatch();