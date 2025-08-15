<?php

namespace App\Repositories;

use App\Models\JobSeeker;
use Illuminate\Database\Eloquent\Collection;

class JobSeekerRepository extends BaseRepository
{
    /**
     * JobSeekerRepository constructor.
     *
     * @param JobSeeker $model
     */
    public function __construct(JobSeeker $model)
    {
        parent::__construct($model);
    }

    /**
     * Get job seeker by user id.
     *
     * @param int $userId
     * @return JobSeeker|null
     */
    public function getByUserId(int $userId): ?JobSeeker
    {
        return $this->model->where('user_id', $userId)->first();
    }

    /**
     * Search job seekers by name.
     *
     * @param string $name
     * @return Collection
     */
    public function searchByName(string $name): Collection
    {
        return $this->model->where(function($query) use ($name) {
            $query->where('first_name', 'like', "%{$name}%")
                  ->orWhere('last_name', 'like', "%{$name}%");
        })->get();
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
        return $this->model->whereHas('skills', function($query) use ($skillId) {
            $query->where('skills.id', $skillId);
        })->paginate($perPage);
    }

    /**
     * Get job seekers by expected salary range.
     *
     * @param int $minSalary
     * @param int $maxSalary
     * @return Collection
     */
    public function getBySalaryRange(int $minSalary, int $maxSalary): Collection
    {
        return $this->model->whereBetween('expected_salary', [$minSalary, $maxSalary])->get();
    }
}