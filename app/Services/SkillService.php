<?php

namespace App\Services;

use App\Repositories\SkillRepository;
use App\Models\Skill;

class SkillService extends BaseService
{
    /**
     * SkillService constructor.
     *
     * @param SkillRepository $repository
     */
    public function __construct(SkillRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Search skills by name.
     *
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function searchByName(string $name)
    {
        return $this->repository->searchByName($name);
    }

    /**
     * Get skills by job id.
     *
     * @param int $jobId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByJobId(int $jobId)
    {
        return $this->repository->getByJobId($jobId);
    }

    /**
     * Get skills by job seeker id.
     *
     * @param int $jobSeekerId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByJobSeekerId(int $jobSeekerId)
    {
        return $this->repository->getByJobSeekerId($jobSeekerId);
    }
    
    /**
     * Get popular skills based on job usage.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPopularSkills(int $limit = 20)
    {
        // Cek apakah repository memiliki metode getPopularSkills
        if (method_exists($this->repository, 'getPopularSkills')) {
            return $this->repository->getPopularSkills($limit);
        }
        
        // Jika tidak, gunakan query langsung
        return $this->repository->getModel()
            ->withCount('jobs')
            ->orderByDesc('jobs_count')
            ->take($limit)
            ->get();
    }

    /**
     * Create multiple skills at once.
     *
     * @param array $skillNames
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function createMultiple(array $skillNames)
    {
        $skills = collect();
        
        foreach ($skillNames as $name) {
            // Check if skill already exists
            $skill = Skill::where('name', $name)->first();
            
            if (!$skill) {
                $skill = $this->repository->create(['name' => $name]);
            }
            
            $skills->push($skill);
        }
        
        return $skills;
    }
}