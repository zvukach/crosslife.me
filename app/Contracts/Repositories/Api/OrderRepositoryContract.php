<?php

namespace App\Contracts\Repositories\Api;

use Illuminate\Database\Eloquent\Model;

interface OrderRepositoryContract
{
    public function createNewOrder(array $data): Model;

    public function findOrderByNumber(string $orderNumber): Model;

    public function update(Model $model, $data): bool;
}
