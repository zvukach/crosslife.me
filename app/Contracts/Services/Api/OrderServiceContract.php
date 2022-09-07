<?php

namespace App\Contracts\Services\Api;

interface OrderServiceContract
{
    public function addOrder(string $userId, array $data);

    public function approveOrder(string $orderNumber);
}
