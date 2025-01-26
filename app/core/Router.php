<?php

namespace App\app\core;

use Exception;
use App\app\core\Request;
use App\app\core\Response;

class Router {
    private array $routes = [];
    private array $middleware = [];

    // Add a route to the router
    public function addRoute(string $method, string $path, $handler, $middleware = []){
        $this->routes[$method][$path] = $handler;
        $this->middleware[$method][$path] = $middleware;
    }

    // Get routes
    public function getRoutes(): array{
        return $this->routes;
    }

    // Dispatch the request to the appropriate handler
    public function dispatch() {

        $request = new Request();
        $response = new Response();

        foreach ($this->routes[$request->method()] as $route => $handler) {
            // Convert route to regex to handle dynamic segments
            $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>\w+)', $route);
            $pattern = "@^$pattern$@";

            if (preg_match($pattern, $request->path(), $matches)) {
                // Extract dynamic segments
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                // Apply middleware
                if (!empty($this->middleware[$request->method()][$route])) {
                    foreach ($this->middleware[$request->method()][$route] as $middleware) {
                        $middlewareClass = $middleware;
                        if (class_exists($middlewareClass)) {
                            (new $middlewareClass)->handle();
                        } else {
                            throw new Exception("Middleware $middlewareClass not found");
                        }
                    }
                }

                if (is_callable($handler)) {
                    call_user_func($handler, ...array_values($params));
                } else if (is_string($handler)) {
                    [$controllerName, $methodName] = explode('@', $handler);
                    $controller = $this->resolveController($controllerName, $request, $response);
                    $controller->$methodName(...array_values($params));
                }
                return;
            }
        }

        // Handle 404 Not Found
        http_response_code(404);
        echo '404 Not Found';
    }

    // Resolve the controller class
    public function resolveController($controllerName, $request , $response){
        $controllerClass = "App\\app\\controllers\\$controllerName";
        if(class_exists($controllerClass)){
            return new $controllerClass($request, $response);
        }else{
            throw new Exception("Controller $controllerClass not found");
        }
    }
}