<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use App\Models\Experience;

class ExperienceService extends BaseService
{
    /**
     * ExperienceService constructor.
     *
     * @param BaseRepository $repository
     */
    public function __construct(BaseRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Get experiences by job seeker id.
     *
     * @param int $jobSeekerId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByJobSeekerId(int $jobSeekerId)
    {
        return Experience::where('job_seeker_id', $jobSeekerId)
            ->orderBy('is_current', 'desc')
            ->orderBy('end_date', 'desc')
            ->orderBy('start_date', 'desc')
            ->get();
    }

    /**
     * Create multiple experiences for a job seeker.
     *
     * @param int $jobSeekerId
     * @param array $experiencesData
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function createMultiple(int $jobSeekerId, array $experiencesData)
    {
        $experiences = collect();
        
        foreach ($experiencesData as $experienceData) {
            $experienceData['job_seeker_id'] = $jobSeekerId;
            $experience = $this->repository->create($experienceData);
            $experiences->push($experience);
        }
        
        return $experiences;
    }

    /**
     * Update multiple experiences for a job seeker.
     * This will delete existing experiences not in the provided data.
     *
     * @param int $jobSeekerId
     * @param array $experiencesData
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function updateMultiple(int $jobSeekerId, array $experiencesData)
    {
        // Get existing experience IDs
        $existingIds = Experience::where('job_seeker_id', $jobSeekerId)
            ->pluck('id')
            ->toArray();
        
        $updatedIds = [];
        $experiences = collect();
        
        foreach ($experiencesData as $experienceData) {
            $experienceData['job_seeker_id'] = $jobSeekerId;
            
            if (isset($experienceData['id']) && $experienceData['id']) {
                // Update existing experience
                $experience = $this->repository->update($experienceData['id'], $experienceData);
                $updatedIds[] = $experience->id;
            } else {
                // Create new experience
                $experience = $this->repository->create($experienceData);
                $updatedIds[] = $experience->id;
            }
            
            $experiences->push($experience);
        }
        
        // Delete experiences not in the updated list
        $idsToDelete = array_diff($existingIds, $updatedIds);
        if (!empty($idsToDelete)) {
            Experience::whereIn('id', $idsToDelete)->delete();
        }
        
        return $experiences;
    }
}