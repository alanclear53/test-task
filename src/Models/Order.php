<?php
namespace Models;

class Order {
    public $customer;
    public $delivery;
    public $products;

    const DISCOUNT_SENIOR = 0.05;
    const DISCOUNT_PREORDER = 0.04;
    const DISCOUNT_BULK = 0.03;
    const QUANTITY_FOR_BULK = 10;

    public function __construct($customer, $delivery, $products) {
        $this->setCustomer($customer);
        $this->setDelivery($delivery);
        $this->setProducts($products);
    }

    public function setCustomer(Customer $customer) {
        $this->customer = $customer;
    }
    public function setDelivery(Delivery $delivery) {
        $this->delivery = $delivery;
    }

    public function setProducts(array $products) {
        foreach ($products as $product) {
            if (!$product instanceof Product) {
                throw new \InvalidArgumentException("Все элементы массива должны быть экземплярами класса Product.");
            }
        }
        $this->products = $products;
    }

    public function getCustomer(): Customer {
        return $this->customer;
    }

    public function getDelivery(): Delivery {
        return $this->delivery;
    }

    public function isBulkOrder(): bool {
        $totalQuantity = 0;
        foreach ($this->products as $product) {
            if (!isset($product->quantity)) {
                throw new \Exception('У товара не указано количество.');
            }
            $totalQuantity += $product->quantity;
        }
        return $totalQuantity >= self::QUANTITY_FOR_BULK;
    }
}
