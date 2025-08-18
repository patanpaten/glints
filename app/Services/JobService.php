<?php

namespace App\Services;

use App\Repositories\JobRepository;

class JobService
{
    protected $repository;

    public function __construct(JobRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findById($id)
    {
        return $this->repository->find($id);
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

        return $this->repository->getByFilters($filters);
    }

    public function countByCompanyAndStatus($companyId, $status = null, $filters = [])
    {
        $filters = array_merge([
            'company_id' => $companyId,
            'status' => $status
        ], $filters);

        return $this->repository->countByFilters($filters);
    }

    public function getFeaturedJobs($limit = 8)
    {
        return $this->repository->getFeaturedJobs($limit);
    }

    public function getLatestJobs($limit = 10)
    {
        return $this->repository->getLatestJobs($limit);
    }
}
