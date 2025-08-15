<?php

namespace App\Repositories;

use App\Models\Application;
use Illuminate\Database\Eloquent\Collection;

class ApplicationRepository extends BaseRepository
{
    /**
     * ApplicationRepository constructor.
     *
     * @param Application $model
     */
    public function __construct(Application $model)
    {
        parent::__construct($model);
    }

    /**
     * Get applications by job id.
     *
     * @param int $jobId
     * @return Collection
     */
    public function getByJobId(int $jobId): Collection
    {
        return $this->model->where('job_id', $jobId)->with('jobSeeker')->get();
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
        return $this->model->where('job_id', $jobId)
            ->with('jobSeeker')
            ->paginate($perPage);
    }

    /**
     * Get applications by job seeker id.
     *
     * @param int $jobSeekerId
     * @return Collection
     */
    public function getByJobSeekerId(int $jobSeekerId): Collection
    {
        return $this->model->where('job_seeker_id', $jobSeekerId)
            ->with('job', 'job.company')
            ->get();
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
        return $this->model->where('job_seeker_id', $jobSeekerId)
            ->with('job', 'job.company')
            ->paginate($perPage);
    }

    /**
     * Get applications by status.
     *
     * @param string $status
     * @param int $jobId
     * @return Collection
     */
    public function getByStatus(string $status, int $jobId = null): Collection
    {
        $query = $this->model->where('status', $status);
        
        if ($jobId) {
            $query->where('job_id', $jobId);
        }
        
        return $query->with('jobSeeker', 'job')->get();
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
        $application = $this->findById($applicationId);
        
        $data = ['status' => $status];
        if ($notes) {
            $data['notes'] = $notes;
        }
        
        $application->update($data);
        
        return $application->fresh();
    }
}