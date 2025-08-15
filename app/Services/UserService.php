<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserService extends BaseService
{
    /**
     * UserService constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Create a new user.
     *
     * @param array $data
     * @return User
     */
    public function createUser(array $data): User
    {
        // Ensure password is hashed
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $this->repository->create($data);
    }

    /**
     * Update user.
     *
     * @param int $userId
     * @param array $data
     * @return User
     */
    public function updateUser(int $userId, array $data): User
    {
        // Hash password if it's being updated
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $this->repository->update($userId, $data);
    }

    /**
     * Find user by email.
     *
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User
    {
        return $this->repository->findByEmail($email);
    }

    /**
     * Get users by role.
     *
     * @param int $roleId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUsersByRole(int $roleId)
    {
        return $this->repository->getUsersByRole($roleId);
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
        return $this->repository->getPaginatedUsersByRole($roleId, $perPage);
    }

    /**
     * Get total user count.
     *
     * @return int
     */
    public function getUserCount(): int
    {
        return $this->repository->count();
    }

    /**
     * Get user count by role slug.
     *
     * @param string $roleSlug
     * @return int
     */
    public function getUserCountByRole(string $roleSlug): int
    {
        return $this->repository->countByRoleSlug($roleSlug);
    }
}