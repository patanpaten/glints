<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'job_seeker_id',
        'cover_letter',
        'resume',
        'status',
        'notes',
    ];

    /**
     * Get the job that owns the application.
     */
    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    /**
     * Get the job seeker that owns the application.
     */
    public function jobSeeker(): BelongsTo
    {
        return $this->belongsTo(JobSeeker::class);
    }
}