<?php

namespace App\Repositories;

use App\Models\JobCategory;
use Illuminate\Database\Eloquent\Collection;

class JobCategoryRepository extends BaseRepository
{
    /**
     * JobCategoryRepository constructor.
     *
     * @param JobCategory $model
     */
    public function __construct(JobCategory $model)
    {
        parent::__construct($model);
    }

    /**
     * Get job category by slug.
     *
     * @param string $slug
     * @return JobCategory|null
     */
    public function getBySlug(string $slug): ?JobCategory
    {
        return $this->model->where('slug', $slug)->first();
    }

    /**
     * Get all categories with job count.
     *
     * @return Collection
     */
    public function getAllWithJobCount(): Collection
    {
        return $this->model->withCount('jobs')->get();
    }

    /**
     * Get popular categories.
     *
     * @param int $limit
     * @return Collection
     */
    public function getPopularCategories(int $limit = 8): Collection
    {
        return $this->model->withCount('jobs')
            ->orderBy('jobs_count', 'desc')
            ->limit($limit)
            ->get();
    }
}