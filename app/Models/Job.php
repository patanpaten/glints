<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job_listings';

    protected $fillable = [
        'company_id',
        'job_category_id',
        'title',
        'slug',
        'description',
        'location',
        'employment_type',
        'work_system',
        'country',
        'office_address',
        'experience_level',
        'education_level',
        'salary_min',
        'salary_max',
        'bonus',
        'hide_salary',
        'gender',
        'age_min',
        'age_max',
        'no_age_limit',
        'skills',
        'require_photo',
        'require_cv',
        'vip_location',
        'vip_education',
        'vacancies',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'bonus' => 'boolean',
        'hide_salary' => 'boolean',
        'no_age_limit' => 'boolean',
        'require_photo' => 'boolean',
        'require_cv' => 'boolean',
        'vip_location' => 'boolean',
        'vip_education' => 'boolean',
    ];

    /**
     * Get the company that owns the job.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the job category that owns the job.
     */
    public function jobCategory(): BelongsTo
    {
        return $this->belongsTo(JobCategory::class);
    }

    /**
     * Get the skills for the job.
     */
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'job_skill')
            ->withTimestamps();
    }

    /**
     * Get the applications for the job.
     */
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
    public function screeningQuestions()
    {
        return $this->hasMany(ScreeningQuestion::class, 'job_listing_id');
    }

}
