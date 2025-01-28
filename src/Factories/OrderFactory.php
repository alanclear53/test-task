<?php
namespace Factories;

use Models\Order;
use Models\Customer;
use Models\Delivery;
use Models\Product;

class OrderFactory {
    public static function createOrder($request): Order
    {
        $customer = new Customer($request['customer']['dateOfBirth'], $request['customer']['gender']);
        $delivery = new Delivery($request['delivery']['deliveryDateTime']);

        $products = array_map(function($item) {
            return new Product($item['basePrice'], $item['quantity']);
        }, $request['products']);

        return new Order($customer, $delivery, $products);
    }
}
