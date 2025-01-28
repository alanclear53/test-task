<?php
namespace Routes;

class Router {
    private $routes = [];
    public function post($path, $callback) {
        $this->routes['POST'][$path] = $callback;

    }
    public function run() {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestUri = strtok($requestUri, '?');

        if (isset($this->routes[$requestMethod][$requestUri])) {
            $callback = $this->routes[$requestMethod][$requestUri];
            $request = new Request();
            echo call_user_func($callback, $request);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Route not found']);
        }
    }
}

