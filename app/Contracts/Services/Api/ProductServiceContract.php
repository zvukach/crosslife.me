<?php

namespace App\Contracts\Services\Api;

use Illuminate\Database\Eloquent\Collection;

interface ProductServiceContract
{
    public function getCatalog(): Collection;
}
