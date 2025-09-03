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

    /**
     * Get all companies with filters.
     *
     * @param array $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAll(array $filters = [])
    {
        $query = $this->model->query();

        // Apply search filter
        if (!empty($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        // Apply location filter
        if (!empty($filters['location'])) {
            $query->where(function($q) use ($filters) {
                $q->where('city', 'like', '%' . $filters['location'] . '%')
                  ->orWhere('province', 'like', '%' . $filters['location'] . '%');
            });
        }

        // Apply industry filter
        if (!empty($filters['industry'])) {
            $query->where('industry', $filters['industry']);
        }

        // Apply size filter
        if (!empty($filters['size'])) {
            switch ($filters['size']) {
                case 'startup':
                    $query->where('employee_count', '<=', 50);
                    break;
                case 'medium':
                    $query->whereBetween('employee_count', [51, 200]);
                    break;
                case 'large':
                    $query->where('employee_count', '>', 200);
                    break;
            }
        }

        return $query->withCount('jobs')
                    ->orderBy('name')
                    ->paginate(12);
    }

    /**
     * Get company by slug.
     *
     * @param string $slug
     * @return Company|null
     */
    public function getBySlug(string $slug): ?Company
    {
        return $this->model->where('slug', $slug)->first();
    }
}