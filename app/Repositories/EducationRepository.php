<?php

namespace App\Repositories;

use App\Models\Education;
use Illuminate\Database\Eloquent\Collection;

class EducationRepository extends BaseRepository
{
    /**
     * EducationRepository constructor.
     *
     * @param Education $model
     */
    public function __construct(Education $model)
    {
        parent::__construct($model);
    }

    /**
     * Get educations by job seeker id.
     *
     * @param int $jobSeekerId
     * @return Collection
     */
    public function getByJobSeekerId(int $jobSeekerId): Collection
    {
        return $this->model->where('job_seeker_id', $jobSeekerId)
            ->orderBy('is_current', 'desc')
            ->orderBy('end_date', 'desc')
            ->orderBy('start_date', 'desc')
            ->get();
    }

    /**
     * Create multiple educations for a job seeker.
     *
     * @param int $jobSeekerId
     * @param array $educations
     * @return Collection
     */
    public function createMultiple(int $jobSeekerId, array $educations): Collection
    {
        $createdEducations = collect();
        
        foreach ($educations as $education) {
            $education['job_seeker_id'] = $jobSeekerId;
            $createdEducations->push($this->create($education));
        }
        
        return $createdEducations;
    }

    /**
     * Update multiple educations for a job seeker.
     *
     * @param int $jobSeekerId
     * @param array $educations
     * @return Collection
     */
    public function updateMultiple(int $jobSeekerId, array $educations): Collection
    {
        // Delete existing educations
        $this->model->where('job_seeker_id', $jobSeekerId)->delete();
        
        // Create new educations
        return $this->createMultiple($jobSeekerId, $educations);
    }
}