<?php

namespace App\Contracts\Repositories\Api;

use Illuminate\Database\Eloquent\Model;

interface UserRepositoryContract
{
    public function getById(string $id): Model;

    public function update(Model $model, array $data): bool;
}
