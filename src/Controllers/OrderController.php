<?php
namespace Controllers;

use Exceptions\ApiException;
use Factories\OrderFactory;
use Interfaces\OrderServiceInterface;
use Services\OrderService;

class OrderController {
    private $orderService;
    public function __construct(OrderService $orderService) {
        $this->setOrderService($orderService);
    }

    public function setOrderService(OrderService $orderService) {
        $this->orderService = $orderService;
    }

    public function createOrder($request) {
        $data = $request->getBody();

        if (!$this->validate($data)) {
            throw new ApiException("Invalid data", 400);
        }

        $order = OrderFactory::createOrder($data);
        $finalPrice = $this->orderService->calculateTotal($order);
        return json_encode(['finalPrice' => round($finalPrice)]);
    }

    private function validate($data): bool
    {
        return isset($data['customer'], $data['delivery'], $data['products']);
    }

}
