<?php

namespace App\Repositories\Api;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\Repositories\Api\OrderRepositoryContract;

class OrderRepository implements OrderRepositoryContract
{
    public function __construct(private Order $model)
    {
    }

    public function createNewOrder(array $data): Model
    {
        return $this->model->create($data);
    }

    public function findOrderByNumber(string $orderNumber): Model
    {
        return $this->model->newQuery()->where('order_number', $orderNumber)->first();
    }

    public function update(Model $model, $data): bool
    {
        return $model->update($data);
    }
}
