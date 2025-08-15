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
        'requirements',
        'responsibilities',
        'location',
        'employment_type',
        'experience_level',
        'education_level',
        'salary_range',
        'vacancies',
        'deadline',
        'is_active',
        'is_featured',
    ];

    protected $casts = [
        'deadline' => 'date',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
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
}