<?php

namespace App\Services;

use App\Repositories\JobRepository;
use Illuminate\Support\Facades\Log;

class JobService
{
    protected $repository;

    public function __construct(JobRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get repository instance
     *
     * @return JobRepository
     */
    public function getRepository()
    {
        return $this->repository;
    }

    public function findById($id)
    {
        return $this->repository->find($id);
    }
    
    /**
     * Find job by slug
     *
     * @param string $slug
     * @return \App\Models\Job|null
     */
    public function findBySlug(string $slug)
    {
        return $this->repository->findBySlug($slug);
    }

    public function getByCompanyId($companyId)
    {
        return $this->repository->getByCompanyId($companyId);
    }

    public function getByCompanyAndStatus($companyId, $status = null, $filters = [])
    {
        $filters = array_merge([
            'company_id' => $companyId,
            'status' => $status
        ], $filters);

        $result = $this->repository->getByFilters($filters);
        

        
        return $result;
    }

    public function countByCompanyAndStatus($companyId, $status = null, $filters = [])
    {
        $filters = array_merge([
            'company_id' => $companyId,
            'status' => $status
        ], $filters);

        $count = $this->repository->countByFilters($filters);
        

        
        return $count;
    }

    public function countByCompany($companyId)
    {
        $count = $this->repository->countByFilters(['company_id' => $companyId]);
        

        
        return $count;
    }

    public function countActiveByCompany($companyId)
    {
        $count = $this->repository->countByFilters([
            'company_id' => $companyId,
            'is_active' => true
        ]);
        

        
        return $count;
    }

    public function getFeaturedJobs($limit = 8)
    {
        return $this->repository->getFeaturedJobs($limit);
    }

    public function getLatestJobs($limit = 10)
    {
        return $this->repository->getLatestJobs($limit);
    }
    
    /**
     * Get related jobs based on category and skills
     *
     * @param \App\Models\Job $job
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRelatedJobs($job, $limit = 4)
    {
        return $this->repository->getModel()
            ->where('job_category_id', $job->job_category_id)
            ->where('id', '!=', $job->id)
            ->where('is_active', true)
            ->with('company')
            ->limit($limit)
            ->get();
    }
    
    /**
     * Get jobs with filters for public job listing page.
     *
     * @param array $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getJobs(array $filters = [])
    {
        // Transform filters for repository
        $repositoryFilters = [];
        
        // Keyword search
        if (!empty($filters['keyword'])) {
            $repositoryFilters['search'] = $filters['keyword'];
        }
        
        // Location filter
        if (!empty($filters['location'])) {
            $repositoryFilters['location'] = $filters['location'];
        }
        
        // Category filter
        if (!empty($filters['category_id'])) {
            $repositoryFilters['category_id'] = $filters['category_id'];
        }
        
        // Employment type filter
        if (!empty($filters['employment_type'])) {
            $repositoryFilters['employment_type'] = $filters['employment_type'];
        }
        
        // Experience level filter
        if (!empty($filters['experience_level'])) {
            $repositoryFilters['experience_level'] = $filters['experience_level'];
        }
        
        // Salary range filter
        if (!empty($filters['salary_range'])) {
            $repositoryFilters['salary_range'] = $filters['salary_range'];
        }
        
        // Sort options
        if (!empty($filters['sort'])) {
            $repositoryFilters['sort'] = $filters['sort'];
        }
        
        // Only get active jobs for public listing
        $repositoryFilters['is_active'] = true;
        
        // Get paginated jobs
        return $this->repository->getByFilters($repositoryFilters);
    }
}
