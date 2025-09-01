<?php

namespace App\Services;

use App\Repositories\JobSeekerRepository;
use App\Models\JobSeeker;
use Illuminate\Support\Facades\Storage;

class JobSeekerService extends BaseService
{
    /**
     * JobSeekerService constructor.
     *
     * @param JobSeekerRepository $repository
     */
    public function __construct(JobSeekerRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Get job seeker by user id.
     *
     * @param int $userId
     * @return JobSeeker|null
     */
    public function getByUserId(int $userId): ?JobSeeker
    {
        return $this->repository->getByUserId($userId);
    }

    /**
     * Create a new job seeker with profile picture upload.
     *
     * @param array $data
     * @return JobSeeker
     */
    public function createJobSeeker(array $data): JobSeeker
    {
        // Handle profile picture upload if present
        if (isset($data['profile_picture']) && $data['profile_picture']) {
            $data['profile_picture'] = $this->uploadProfilePicture($data['profile_picture']);
        }

        return $this->repository->create($data);
    }

    /**
     * Update job seeker with profile picture upload.
     *
     * @param int $jobSeekerId
     * @param array $data
     * @return JobSeeker
     */
    public function updateJobSeeker(int $jobSeekerId, array $data): JobSeeker
    {
        $jobSeeker = $this->repository->findById($jobSeekerId);
        // Handle profile picture upload if present
        if (isset($data['profile_picture']) && $data['profile_picture']) {
            // Delete old profile picture if exists
            if ($jobSeeker->profile_picture) {
                Storage::disk('public')->delete($jobSeeker->profile_picture);
            }
            $data['profile_picture'] = $this->uploadProfilePicture($data['profile_picture']);
        }

        return $this->repository->update($jobSeekerId, $data);
    }

    /**
     * Upload profile picture.
     *
     * @param $profilePicture
     * @return string
     */
    private function uploadProfilePicture($profilePicture): string
    {
        return $profilePicture->store('profile_pictures', 'public');
    }

    /**
     * Search job seekers by name.
     *
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function searchByName(string $name)
    {
        return $this->repository->searchByName($name);
    }

    /**
     * Get job seekers by skill.
     *
     * @param int $skillId
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getBySkill(int $skillId, int $perPage = 15)
    {
        return $this->repository->getBySkill($skillId, $perPage);
    }

    /**
     * Get job seekers by salary range.
     *
     * @param int $minSalary
     * @param int $maxSalary
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getBySalaryRange(int $minSalary, int $maxSalary)
    {
        return $this->repository->getBySalaryRange($minSalary, $maxSalary);
    }

    /**
     * Add or update skills for a job seeker.
     *
     * @param int $jobSeekerId
     * @param array $skills Array of skill IDs with level as value
     * @return JobSeeker
     */
    public function updateSkills(int $jobSeekerId, array $skills): JobSeeker
    {
        $jobSeeker = $this->repository->findById($jobSeekerId);
        
        // Sync skills with pivot data
        $syncData = [];
        foreach ($skills as $skillId => $level) {
            $syncData[$skillId] = ['level' => $level];
        }
        
        $jobSeeker->skills()->sync($syncData);
        
        return $jobSeeker->fresh(['skills']);
    }
}