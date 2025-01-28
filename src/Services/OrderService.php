<?php
namespace Services;

use Interfaces\OrderServiceInterface;
use Models\Order;

class OrderService
{
    public function calculateTotal(Order $order) {	
        $total = $this->calculateBaseTotal($order);
        $total = $this->applyDiscounts($total, $order);
        return $total;
    }

    private function calculateBaseTotal(Order $order) {
        $total = 0;

        foreach ($order->products as $product) {
            if (!isset($product->basePrice) || !isset($product->quantity))
            {
                throw new \Exception('У продукта нет основной цены или не указано количество.');
            }
            $total += $product->basePrice * $product->quantity;
        }
        return $total;
    }

    private function applyDiscounts($total, Order $order) {
        $discounts = [];

        if ($order->getCustomer()->isSenior()) {
            $discounts[] = Order::DISCOUNT_SENIOR;
        }

        if ($order->getDelivery()->isEarlyOrder()) {
            $discounts[] = Order::DISCOUNT_EARLY_ORDER;
        }

        if ($order->isBulkOrder()) {
            $discounts[] = Order::DISCOUNT_BULK;
        }

        foreach ($discounts as $discount) {
            if (!is_numeric($discount)) {
                throw new \Exception('Скидка не является допустимым числом.');
            }
            $total -= $total * $discount;
        }
        return $total;
    }
}
