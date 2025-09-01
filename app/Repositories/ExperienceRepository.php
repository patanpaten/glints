<?php

namespace App\Repositories;

use App\Models\Experience;
use Illuminate\Database\Eloquent\Collection;

class ExperienceRepository extends BaseRepository
{
    /**
     * ExperienceRepository constructor.
     *
     * @param Experience $model
     */
    public function __construct(Experience $model)
    {
        parent::__construct($model);
    }

    /**
     * Get experiences by job seeker id.
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
     * Create multiple experiences for a job seeker.
     *
     * @param int $jobSeekerId
     * @param array $experiences
     * @return Collection
     */
    public function createMultiple(int $jobSeekerId, array $experiences): Collection
    {
        $createdExperiences = collect();
        
        foreach ($experiences as $experience) {
            $experience['job_seeker_id'] = $jobSeekerId;
            $createdExperiences->push($this->create($experience));
        }
        
        return $createdExperiences;
    }

    /**
     * Update multiple experiences for a job seeker.
     *
     * @param int $jobSeekerId
     * @param array $experiences
     * @return Collection
     */
    public function updateMultiple(int $jobSeekerId, array $experiences): Collection
    {
        // Delete existing experiences
        $this->model->where('job_seeker_id', $jobSeekerId)->delete();
        
        // Create new experiences
        return $this->createMultiple($jobSeekerId, $experiences);
    }
}