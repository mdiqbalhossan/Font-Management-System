<?php

namespace App;

class Router
{
    private $routes = [];

    public function addRoute($method, $path, $callback) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'callback' => $callback
        ];
    }

    public function dispatch($method, $path) {
        $basePath = PROJECT_FOLDER;
        $path = str_replace($basePath, '', $path);
        //if last character is a slash, remove it
        if ($path !== '/' && substr($path, -1) === '/') {
            $path = substr($path, 0, -1);
        }
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $path) {
                call_user_func($route['callback']);
                return;
            }
        }
        http_response_code(404);
        echo "404 Not Found";
    }
}