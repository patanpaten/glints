<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobAnalytics extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'views',
        'unique_views',
        'applications',
        'saves',
        'shares',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Get the job that owns the analytics.
     */
    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    /**
     * Get the conversion rate (applications / views).
     */
    public function getConversionRateAttribute(): float
    {
        if ($this->views === 0) {
            return 0;
        }
        
        return round(($this->applications / $this->views) * 100, 2);
    }

    /**
     * Scope to get analytics for a specific date range.
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('date', [$startDate, $endDate]);
    }

    /**
     * Scope to get analytics for the last N days.
     */
    public function scopeLastDays($query, $days)
    {
        return $query->where('date', '>=', now()->subDays($days));
    }
}
