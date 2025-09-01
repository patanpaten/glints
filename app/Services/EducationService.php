<?php

namespace App\Services;

use App\Repositories\EducationRepository;
use App\Models\Education;

class EducationService extends BaseService
{
    /**
     * EducationService constructor.
     *
     * @param EducationRepository $repository
     */
    public function __construct(EducationRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Get educations by job seeker id.
     *
     * @param int $jobSeekerId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByJobSeekerId(int $jobSeekerId)
    {
        return $this->repository->getByJobSeekerId($jobSeekerId);
    }

    /**
     * Create multiple educations for a job seeker.
     *
     * @param int $jobSeekerId
     * @param array $educationsData
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function createMultiple(int $jobSeekerId, array $educationsData)
    {
        $educations = collect();
        
        foreach ($educationsData as $educationData) {
            $educationData['job_seeker_id'] = $jobSeekerId;
            $education = $this->repository->create($educationData);
            $educations->push($education);
        }
        
        return $educations;
    }

    /**
     * Update multiple educations for a job seeker.
     * This will delete existing educations not in the provided data.
     *
     * @param int $jobSeekerId
     * @param array $educationsData
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function updateMultiple(int $jobSeekerId, array $educationsData)
    {
        // Get existing education IDs
        $existingIds = Education::where('job_seeker_id', $jobSeekerId)
            ->pluck('id')
            ->toArray();
        
        $updatedIds = [];
        $educations = collect();
        
        foreach ($educationsData as $educationData) {
            $educationData['job_seeker_id'] = $jobSeekerId;
            
            if (isset($educationData['id']) && $educationData['id']) {
                // Update existing education
                $education = $this->repository->update($educationData['id'], $educationData);
                $updatedIds[] = $education->id;
            } else {
                // Create new education
                $education = $this->repository->create($educationData);
                $updatedIds[] = $education->id;
            }
            
            $educations->push($education);
        }
        
        // Delete educations not in the updated list
        $idsToDelete = array_diff($existingIds, $updatedIds);
        if (!empty($idsToDelete)) {
            Education::whereIn('id', $idsToDelete)->delete();
        }
        
        return $educations;
    }
}