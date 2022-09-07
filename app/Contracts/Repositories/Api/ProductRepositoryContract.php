<?php

namespace App\Contracts\Repositories\Api;

use App\Contracts\Repositories\BaseModelContract;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryContract
{
    public function getAll(): Collection;

    public function findByIds(array $ids): Collection;
}
