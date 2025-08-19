<?php

namespace App\Services;

use App\Repositories\JobCategoryRepository;
use App\Models\JobCategory;
use Illuminate\Support\Str;

class JobCategoryService extends BaseService
{
    /**
     * JobCategoryService constructor.
     *
     * @param JobCategoryRepository $repository
     */
    public function __construct(JobCategoryRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Create a new job category with slug generation.
     *
     * @param array $data
     * @return JobCategory
     */
    public function createJobCategory(array $data): JobCategory
    {
        // Generate slug from name if not provided
        if (!isset($data['slug']) || empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        return $this->repository->create($data);
    }

    /**
     * Update job category with slug regeneration.
     *
     * @param int $categoryId
     * @param array $data
     * @return JobCategory
     */
    public function updateJobCategory(int $categoryId, array $data): JobCategory
    {
        // Regenerate slug if name changed and slug not provided
        if (isset($data['name']) && (!isset($data['slug']) || empty($data['slug']))) {
            $data['slug'] = Str::slug($data['name']);
        }

        return $this->repository->update($categoryId, $data);
    }

    /**
     * Get job category by slug.
     *
     * @param string $slug
     * @return JobCategory|null
     */
    public function getBySlug(string $slug): ?JobCategory
    {
        return $this->repository->getBySlug($slug);
    }

    /**
     * Get all categories with job count.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllWithJobCount()
    {
        return $this->repository->getAllWithJobCount();
    }
    
    /**
     * Get all categories with job count
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllCategories()
    {
        return $this->repository->getModel()
            ->withCount('jobs')
            ->orderBy('name')
            ->get();
    }

    /**
     * Get popular categories.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPopularCategories(int $limit = 8)
    {
        return $this->repository->getPopularCategories($limit);
    }
}