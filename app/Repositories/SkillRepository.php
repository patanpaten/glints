<?php

namespace App\Repositories;

use App\Models\Skill;
use Illuminate\Database\Eloquent\Collection;

class SkillRepository extends BaseRepository
{
    /**
     * SkillRepository constructor.
     *
     * @param Skill $model
     */
    public function __construct(Skill $model)
    {
        parent::__construct($model);
    }

    /**
     * Search skills by name.
     *
     * @param string $name
     * @return Collection
     */
    public function searchByName(string $name): Collection
    {
        return $this->model->where('name', 'like', "%{$name}%")->get();
    }

    /**
     * Get skills by job id.
     *
     * @param int $jobId
     * @return Collection
     */
    public function getByJobId(int $jobId): Collection
    {
        return $this->model->whereHas('jobs', function($query) use ($jobId) {
            $query->where('jobs.id', $jobId);
        })->get();
    }

    /**
     * Get skills by job seeker id.
     *
     * @param int $jobSeekerId
     * @return Collection
     */
    public function getByJobSeekerId(int $jobSeekerId): Collection
    {
        return $this->model->whereHas('jobSeekers', function($query) use ($jobSeekerId) {
            $query->where('job_seekers.id', $jobSeekerId);
        })->get();
    }

    /**
     * Get popular skills.
     *
     * @param int $limit
     * @return Collection
     */
    public function getPopularSkills(int $limit = 10): Collection
    {
        return $this->model->withCount('jobs')
            ->orderBy('jobs_count', 'desc')
            ->limit($limit)
            ->get();
    }
}