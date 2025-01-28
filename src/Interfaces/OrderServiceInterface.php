<?php

namespace Interfaces;

use Models\Order;

interface OrderServiceInterface {
    public function calculateTotal(Order $order);

}
