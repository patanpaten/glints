<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Get the job seekers for the skill.
     */
    public function jobSeekers(): BelongsToMany
    {
        return $this->belongsToMany(JobSeeker::class, 'job_seeker_skill')
            ->withPivot('level')
            ->withTimestamps();
    }

    /**
     * Get the jobs for the skill.
     */
    public function jobs(): BelongsToMany
    {
        return $this->belongsToMany(Job::class, 'job_skill')
            ->withTimestamps();
    }
}