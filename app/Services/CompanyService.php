<?php

namespace App\Services;

use App\Repositories\CompanyRepository;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class CompanyService extends BaseService
{
    /**
     * CompanyService constructor.
     *
     * @param CompanyRepository $repository
     */
    public function __construct(CompanyRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Get company by user id.
     *
     * @param int $userId
     * @return Company|null
     */
    public function getByUserId(int $userId): ?Company
    {
        return $this->repository->getByUserId($userId);
    }

    /**
     * Create a new company with logo upload.
     *
     * @param array $data
     * @return Company
     */
    public function createCompany(array $data): Company
    {
        // Handle logo upload if present
        if (isset($data['logo']) && $data['logo']) {
            $data['logo'] = $this->uploadLogo($data['logo']);
        }

        return $this->repository->create($data);
    }

    /**
     * Update company with logo upload.
     *
     * @param int $companyId
     * @param array $data
     * @return Company
     */
    public function updateCompany(int $companyId, array $data): Company
    {
        $company = $this->repository->findById($companyId);

        // Handle logo upload if present
        if (isset($data['logo']) && $data['logo']) {
            // Delete old logo if exists
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }
            $data['logo'] = $this->uploadLogo($data['logo']);
        }

        return $this->repository->update($companyId, $data);
    }

    /**
     * Upload company logo.
     *
     * @param $logo
     * @return string
     */
    protected function uploadLogo($logo): string
    {
        $path = $logo->store('logos', 'public');
        return $path;
    }

    /**
     * Search companies by name.
     *
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function searchByName(string $name)
    {
        return $this->repository->searchByName($name);
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
        return $this->repository->getByIndustry($industry, $perPage);
    }

    /**
     * Get featured companies.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFeaturedCompanies(int $limit = 8)
    {
        return $this->repository->getFeaturedCompanies($limit);
    }

    /**
     * Get total company count.
     *
     * @return int
     */
    public function getCompanyCount(): int
    {
        return $this->repository->count();
    }

    /**
     * Get recent companies.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRecentCompanies(int $limit = 5)
    {
        return $this->repository->getRecentCompanies($limit);
    }

    /**
     * Get all companies with filters.
     *
     * @param array $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAll(array $filters = [])
    {
        return $this->repository->getAll($filters);
    }

    /**
     * Get company by slug.
     *
     * @param string $slug
     * @return Company|null
     */
    public function getBySlug(string $slug): ?Company
    {
        return $this->repository->getBySlug($slug);
    }
}