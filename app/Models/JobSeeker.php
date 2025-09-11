<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobSeeker extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'birth_date',
        'phone',
        'address',
        'city',
        'province',
        'postal_code',
        'profile_picture',
        'summary',
        'current_position',
        'expected_salary',
        'resume',
        'is_profile_complete',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    /**
     * Get the user that owns the job seeker.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the educations for the job seeker.
     */
    public function educations(): HasMany
    {
        return $this->hasMany(Education::class);
    }

    /**
     * Get the experiences for the job seeker.
     */
    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class);
    }

    /**
     * Get the skills for the job seeker.
     */
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'job_seeker_skill')
            ->withPivot('level')
            ->withTimestamps();
    }

    /**
     * Get the applications for the job seeker.
     */
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    /**
     * Get the saved jobs for the job seeker.
     */
    public function savedJobs(): BelongsToMany
    {
        return $this->belongsToMany(Job::class, 'saved_jobs', 'job_seeker_id', 'job_id')
            ->withTimestamps();
    }

    /**
     * Get the full name of the job seeker.
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}