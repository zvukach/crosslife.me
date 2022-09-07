<?php

namespace App\Repositories\Api;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use App\Contracts\Repositories\Api\ProductRepositoryContract as ProductRepositoryContract;

class ProductRepository implements ProductRepositoryContract
{
    public function __construct(private Product $model)
    {
    }

    public function getAll(): Collection
    {
        return $this->model->get();
    }

    public function findByIds(array $ids): Collection
    {
        return $this->model->find($ids, ['id', 'price', 'title']);
    }
}
