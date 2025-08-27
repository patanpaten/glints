<?php

namespace App\Services;

use App\Repositories\ApplicationRepository;
use App\Models\Application;
use Illuminate\Support\Facades\Storage;

class ApplicationService extends BaseService
{
    /**
     * ApplicationService constructor.
     *
     * @param ApplicationRepository $repository
     */
    public function __construct(ApplicationRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Create a new application with resume upload.
     *
     * @param array $data
     * @return Application
     */
    public function createApplication(array $data): Application
    {
        // Handle resume upload if present
        if (isset($data['resume']) && $data['resume']) {
            $data['resume'] = $this->uploadResume($data['resume']);
        }

        // Set default status if not provided
        if (!isset($data['status'])) {
            $data['status'] = 'pending';
        }

        return $this->getRepository()->create($data);
    }

    /**
     * Update application with resume upload.
     *
     * @param int $applicationId
     * @param array $data
     * @return Application
     */
    public function updateApplication(int $applicationId, array $data): Application
    {
        $application = $this->getRepository()->findById($applicationId);

        // Handle resume upload if present
        if (isset($data['resume']) && $data['resume']) {
            // Delete old resume if exists
            if ($application->resume) {
                Storage::disk('public')->delete($application->resume);
            }
            $data['resume'] = $this->uploadResume($data['resume']);
        }

        return $this->getRepository()->update($applicationId, $data);
    }

    /**
     * Upload resume.
     *
     * @param $resume
     * @return string
     */
    protected function uploadResume($resume): string
    {
        $path = $resume->store('applications/resumes', 'public');
        return $path;
    }

    /**
     * Get applications by job id.
     *
     * @param int $jobId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByJobId(int $jobId)
    {
        return $this->getRepository()->getByJobId($jobId);
    }

    /**
     * Get paginated applications by job id.
     *
     * @param int $jobId
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPaginatedByJobId(int $jobId, int $perPage = 15)
    {
        return $this->getRepository()->getPaginatedByJobId($jobId, $perPage);
    }

    /**
     * Get applications by job seeker id.
     *
     * @param int $jobSeekerId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByJobSeekerId(int $jobSeekerId)
    {
        return $this->getRepository()->getByJobSeekerId($jobSeekerId);
    }

    /**
     * Get paginated applications by job seeker id.
     *
     * @param int $jobSeekerId
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPaginatedByJobSeekerId(int $jobSeekerId, int $perPage = 15)
    {
        return $this->getRepository()->getPaginatedByJobSeekerId($jobSeekerId, $perPage);
    }

    /**
     * Get applications by status.
     *
     * @param string $status
     * @param int|null $jobId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByStatus(string $status, int $jobId = null)
    {
        return $this->getRepository()->getByStatus($status, $jobId);
    }

    /**
     * Update application status.
     *
     * @param int $applicationId
     * @param string $status
     * @param string|null $notes
     * @return Application
     */
    public function updateStatus(int $applicationId, string $status, string $notes = null): Application
    {
        return $this->getRepository()->updateStatus($applicationId, $status, $notes);
    }

    /**
     * Check if job seeker has already applied to a job.
     *
     * @param int $jobId
     * @param int $jobSeekerId
     * @return bool
     */
    public function hasApplied(int $jobId, int $jobSeekerId): bool
    {
        return $this->getRepository()->getModel()
            ->where('job_id', $jobId)
            ->where('job_seeker_id', $jobSeekerId)
            ->exists();
    }

    /**
     * Count applications by company id.
     *
     * @param int $companyId
     * @return int
     */
    public function countByCompany(int $companyId): int
    {
        return $this->getRepository()->getModel()
            ->whereHas('job', function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })
            ->count();
    }
}