<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->first();
    }

    public function getUsersByRole(int $roleId)
    {
        return $this->model->where('role_id', $roleId)->get();
    }

    public function getPaginatedUsersByRole(int $roleId, int $perPage = 15)
    {
        return $this->model->where('role_id', $roleId)->paginate($perPage);
    }

    public function countByRoleSlug(string $roleSlug): int
    {
        return $this->model->whereHas('role', function ($q) use ($roleSlug) {
            $q->where('slug', $roleSlug);
        })->count();
    }
}
