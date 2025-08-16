<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CvSearchResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'cv_search_id',
        'job_seeker_id',
        'match_score',
        'matched_criteria',
    ];

    protected $casts = [
        'match_score' => 'decimal:2',
        'matched_criteria' => 'array',
    ];

    /**
     * Get the CV search that owns this result.
     */
    public function cvSearch(): BelongsTo
    {
        return $this->belongsTo(CvSearch::class);
    }

    /**
     * Get the job seeker for this result.
     */
    public function jobSeeker(): BelongsTo
    {
        return $this->belongsTo(JobSeeker::class);
    }

    /**
     * Get the match score as a percentage.
     */
    public function getMatchScorePercentageAttribute(): string
    {
        return $this->match_score . '%';
    }

    /**
     * Get the matched criteria as a readable string.
     */
    public function getMatchedCriteriaStringAttribute(): string
    {
        if (empty($this->matched_criteria)) {
            return 'No specific criteria matched';
        }

        $criteriaStrings = [];
        
        foreach ($this->matched_criteria as $type => $value) {
            if (is_array($value)) {
                $criteriaStrings[] = ucfirst($type) . ': ' . implode(', ', $value);
            } else {
                $criteriaStrings[] = ucfirst($type) . ': ' . $value;
            }
        }

        return implode(' | ', $criteriaStrings);
    }

    /**
     * Scope to get results with high match scores.
     */
    public function scopeHighMatch($query, $threshold = 80)
    {
        return $query->where('match_score', '>=', $threshold);
    }

    /**
     * Scope to get results with medium match scores.
     */
    public function scopeMediumMatch($query, $minThreshold = 60, $maxThreshold = 79)
    {
        return $query->whereBetween('match_score', [$minThreshold, $maxThreshold]);
    }
}
