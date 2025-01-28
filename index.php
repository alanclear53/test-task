<?php
require_once __DIR__ . '/vendor/autoload.php';

use Controllers\OrderController;
use Services\OrderService;
use Routes\Router;

$orderService = new OrderService();
$orderController = new OrderController($orderService);
$router = new Router();

$router->post('/test-task/order', function ($request) use ($orderController) {
    try {
        return $orderController->createOrder($request);
    } catch (Exception $e) {
        http_response_code(400);
        return json_encode(['error' => $e->getMessage()]);
    }
});
$router->run();