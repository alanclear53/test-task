<?php
namespace Models;

class Delivery {
    private $deliveryDateTime;
    const EARLY_DATE_INTERVAL = 7;

    public function __construct(string $deliveryDateTime) {
        $this->setDeliveryDateTime($deliveryDateTime);
    }

    public function setDeliveryDateTime(string $deliveryDateTime)
    {
        $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $deliveryDateTime);
        if ($dateTime === false) {
            throw new \InvalidArgumentException("Неверный формат даты и времени доставки. Ожидается 'Y-m-d H:i:s'.");
        }
        $this->deliveryDateTime = $deliveryDateTime;
    }

    public function isEarlyOrder(): bool
    {
        $orderDate = new \DateTime('now');
        $deliveryDate = new \DateTime($this->deliveryDateTime);
        $interval = $orderDate->diff($deliveryDate);

        return $interval->days <= self::EARLY_DATE_INTERVAL;
    }
}
