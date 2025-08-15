<?php

namespace App\Repositories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Collection;

class JobRepository extends BaseRepository
{
    /**
     * JobRepository constructor.
     *
     * @param Job $model
     */
    public function __construct(Job $model)
    {
        parent::__construct($model);
    }

    /**
     * Get jobs by company id.
     *
     * @param int $companyId
     * @return Collection
     */
    public function getByCompanyId(int $companyId): Collection
    {
        return $this->model->where('company_id', $companyId)->get();
    }

    /**
     * Get paginated jobs by company id.
     *
     * @param int $companyId
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPaginatedByCompanyId(int $companyId, int $perPage = 15)
    {
        return $this->model->where('company_id', $companyId)->paginate($perPage);
    }

    /**
     * Get jobs by category id.
     *
     * @param int $categoryId
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getByCategory(int $categoryId, int $perPage = 15)
    {
        return $this->model->where('job_category_id', $categoryId)->paginate($perPage);
    }

    /**
     * Search jobs by title or description.
     *
     * @param string $keyword
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function search(string $keyword, int $perPage = 15)
    {
        return $this->model->where('title', 'like', "%{$keyword}%")
            ->orWhere('description', 'like', "%{$keyword}%")
            ->orWhere('location', 'like', "%{$keyword}%")
            ->paginate($perPage);
    }

    /**
     * Get featured jobs.
     *
     * @param int $limit
     * @return Collection
     */
    public function getFeaturedJobs(int $limit = 8): Collection
    {
        return $this->model->where('is_featured', true)
            ->where('is_active', true)
            ->with('company')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get latest jobs.
     *
     * @param int $limit
     * @return Collection
     */
    public function getLatestJobs(int $limit = 10): Collection
    {
        return $this->model->where('is_active', true)
            ->with('company', 'jobCategory')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get jobs by multiple filters.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getByFilters(array $filters, int $perPage = 15)
    {
        $query = $this->model->where('is_active', true);

        if (isset($filters['keyword']) && !empty($filters['keyword'])) {
            $keyword = $filters['keyword'];
            $query->where(function($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%");
            });
        }

        if (isset($filters['location']) && !empty($filters['location'])) {
            $query->where('location', 'like', "%{$filters['location']}%");
        }

        if (isset($filters['category_id']) && !empty($filters['category_id'])) {
            $query->where('job_category_id', $filters['category_id']);
        }

        if (isset($filters['employment_type']) && !empty($filters['employment_type'])) {
            $query->where('employment_type', $filters['employment_type']);
        }

        if (isset($filters['experience_level']) && !empty($filters['experience_level'])) {
            $query->where('experience_level', $filters['experience_level']);
        }

        if (isset($filters['skill_ids']) && !empty($filters['skill_ids'])) {
            $query->whereHas('skills', function($q) use ($filters) {
                $q->whereIn('skills.id', $filters['skill_ids']);
            });
        }

        return $query->with('company', 'jobCategory')->paginate($perPage);
    }

    /**
     * Count active jobs.
     *
     * @return int
     */
    public function countActive(): int
    {
        return $this->model->where('is_active', true)->count();
    }

    /**
     * Get recent jobs.
     *
     * @param int $limit
     * @return Collection
     */
    public function getRecentJobs(int $limit = 5): Collection
    {
        return $this->model->with('company')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}