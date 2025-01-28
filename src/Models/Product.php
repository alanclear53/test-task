<?php

namespace Models;
class Product {
    public $basePrice;
    public $quantity;

    public function __construct(float $basePrice, int $quantity) {
        $this->setBasePrice($basePrice);
        $this->setQuantity($quantity);
    }
    public function setBasePrice(float $basePrice) {
        if ($basePrice < 0) {
            throw new \InvalidArgumentException("Базовая цена не может быть отрицательной.");
        }
        $this->basePrice = $basePrice;
    }
    public function setQuantity(int $quantity) {

        if ($quantity < 0) {
            throw new \InvalidArgumentException("Количество не может быть отрицательным.");
        }
        $this->quantity = $quantity;

    }
}
