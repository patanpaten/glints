<?php

namespace App\Repositories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

class CompanyRepository extends BaseRepository
{
    /**
     * CompanyRepository constructor.
     *
     * @param Company $model
     */
    public function __construct(Company $model)
    {
        parent::__construct($model);
    }

    /**
     * Get company by user id.
     *
     * @param int $userId
     * @return Company|null
     */
    public function getByUserId(int $userId): ?Company
    {
        return $this->model->where('user_id', $userId)->first();
    }

    /**
     * Search companies by name.
     *
     * @param string $name
     * @return Collection
     */
    public function searchByName(string $name): Collection
    {
        return $this->model->where('name', 'like', "%{$name}%")->get();
    }

    /**
     * Get companies by industry.
     *
     * @param string $industry
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getByIndustry(string $industry, int $perPage = 15)
    {
        return $this->model->where('industry', $industry)->paginate($perPage);
    }

    /**
     * Get featured companies.
     *
     * @param int $limit
     * @return Collection
     */
    public function getFeaturedCompanies(int $limit = 8): Collection
    {
        return $this->model->withCount('jobs')
            ->orderBy('jobs_count', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Count total companies.
     *
     * @return int
     */
    public function count(): int
    {
        return $this->model->count();
    }

    /**
     * Get recent companies.
     *
     * @param int $limit
     * @return Collection
     */
    public function getRecentCompanies(int $limit = 5): Collection
    {
        return $this->model->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}