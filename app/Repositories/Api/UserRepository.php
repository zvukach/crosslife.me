<?php

namespace App\Repositories\Api;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\Repositories\Api\UserRepositoryContract;

class UserRepository implements UserRepositoryContract
{
    public function __construct(private User $model)
    {
    }

    public function getById(string $id): Model
    {
        return $this->model->find($id);
    }

    public function update(Model $model, array $data): bool
    {
        return $model->update($data);
    }
}
