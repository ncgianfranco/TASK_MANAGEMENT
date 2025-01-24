<?php

namespace App\app\core;

class Request {
    // Get the rquest method (e.g, GET. POST)
    public function method(){
        return $_SERVER['REQUEST_METHOD'];
    }
    // Get the request path (e.g., /tasks/123/edit)
    public function path(){
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        return str_contains($path, '?') ? explode('?', $path)[0] : $path;
    }
    // Get query parameters (e.g , ?name=John)
    public function query(){
        return $_GET;
    }
    // Get POST data
    public function post(){
        return $_POST;
    }

    // Get a specific query parameter
    public function get(string $key, $default = null){
        return $_GET[$key] ?? $default;
    }

    // Get a specific POST parameter
    public function input(string $key, $default = null){
        return $_POST[$key] ?? $default;
    }

    public function all(){
        return array_merge($this->query(), $this->post());
    }
}