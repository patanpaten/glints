<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository
{
    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Find user by email.
     *
     * @param string $email
     * @return Model|null
     */
    public function findByEmail(string $email): ?Model
    {
        return $this->model->where('email', $email)->first();
    }

    /**
     * Get users by role.
     *
     * @param int $roleId
     * @return Collection
     */
    public function getUsersByRole(int $roleId): Collection
    {
        return $this->model->where('role_id', $roleId)->get();
    }

    /**
     * Get paginated users by role.
     *
     * @param int $roleId
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPaginatedUsersByRole(int $roleId, int $perPage = 15)
    {
        return $this->model->where('role_id', $roleId)->paginate($perPage);
    }

    /**
     * Count total users.
     *
     * @return int
     */
    public function count(): int
    {
        return $this->model->count();
    }

    /**
     * Count users by role slug.
     *
     * @param string $roleSlug
     * @return int
     */
    public function countByRoleSlug(string $roleSlug): int
    {
        return $this->model->whereHas('role', function($query) use ($roleSlug) {
            $query->where('slug', $roleSlug);
        })->count();
    }
}