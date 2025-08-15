<?php

namespace App\Services;

use App\Repositories\JobRepository;
use App\Models\Job;
use Illuminate\Support\Str;

class JobService extends BaseService
{
    /**
     * JobService constructor.
     *
     * @param JobRepository $repository
     */
    public function __construct(JobRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Create a new job with slug generation.
     *
     * @param array $data
     * @return Job
     */
    public function createJob(array $data): Job
    {
        // Generate slug from title if not provided
        if (!isset($data['slug']) || empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $job = $this->repository->create($data);

        // Attach skills if provided
        if (isset($data['skills']) && is_array($data['skills'])) {
            $job->skills()->attach($data['skills']);
        }

        return $job->fresh(['skills']);
    }

    /**
     * Update job with slug regeneration.
     *
     * @param int $jobId
     * @param array $data
     * @return Job
     */
    public function updateJob(int $jobId, array $data): Job
    {
        // Regenerate slug if title changed and slug not provided
        if (isset($data['title']) && (!isset($data['slug']) || empty($data['slug']))) {
            $data['slug'] = Str::slug($data['title']);
        }

        $job = $this->repository->update($jobId, $data);

        // Sync skills if provided
        if (isset($data['skills']) && is_array($data['skills'])) {
            $job->skills()->sync($data['skills']);
        }

        return $job->fresh(['skills']);
    }

    /**
     * Get jobs by company id.
     *
     * @param int $companyId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByCompanyId(int $companyId)
    {
        return $this->repository->getByCompanyId($companyId);
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
        return $this->repository->getPaginatedByCompanyId($companyId, $perPage);
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
        return $this->repository->getByCategory($categoryId, $perPage);
    }

    /**
     * Search jobs by keyword.
     *
     * @param string $keyword
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function search(string $keyword, int $perPage = 15)
    {
        return $this->repository->search($keyword, $perPage);
    }

    /**
     * Get featured jobs.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFeaturedJobs(int $limit = 8)
    {
        return $this->repository->getFeaturedJobs($limit);
    }

    /**
     * Get latest jobs.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getLatestJobs(int $limit = 10)
    {
        return $this->repository->getLatestJobs($limit);
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
        return $this->repository->getByFilters($filters, $perPage);
    }

    /**
     * Toggle job active status.
     *
     * @param int $jobId
     * @return Job
     */
    public function toggleActive(int $jobId): Job
    {
        $job = $this->repository->findById($jobId);
        return $this->repository->update($jobId, ['is_active' => !$job->is_active]);
    }

    /**
     * Toggle job featured status.
     *
     * @param int $jobId
     * @return Job
     */
    public function toggleFeatured(int $jobId): Job
    {
        $job = $this->repository->findById($jobId);
        return $this->repository->update($jobId, ['is_featured' => !$job->is_featured]);
    }

    /**
     * Get active job count.
     *
     * @return int
     */
    public function getActiveJobCount(): int
    {
        return $this->repository->countActive();
    }

    /**
     * Get recent jobs.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRecentJobs(int $limit = 5)
    {
        return $this->repository->getRecentJobs($limit);
    }
}