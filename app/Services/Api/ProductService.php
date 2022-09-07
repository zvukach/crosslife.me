<?php

namespace App\Services\Api;

use Illuminate\Database\Eloquent\Collection;
use App\Contracts\Repositories\Api\ProductRepositoryContract;
use App\Contracts\Services\Api\ProductServiceContract as ProductServiceContract;

class ProductService implements ProductServiceContract
{
    public function __construct(private ProductRepositoryContract $productRepository)
    {
    }

    public function getCatalog(): Collection
    {
        return $this->productRepository->getAll();
    }
}
