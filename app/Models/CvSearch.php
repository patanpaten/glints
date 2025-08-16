<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CvSearch extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'search_query',
        'filters',
        'results_count',
    ];

    protected $casts = [
        'filters' => 'array',
    ];

    /**
     * Get the company that performed the search.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the search results.
     */
    public function results(): HasMany
    {
        return $this->hasMany(CvSearchResult::class);
    }

    /**
     * Get the search filters as a readable string.
     */
    public function getFiltersStringAttribute(): string
    {
        if (empty($this->filters)) {
            return 'No filters applied';
        }

        $filterStrings = [];
        
        if (isset($this->filters['skills'])) {
            $filterStrings[] = 'Skills: ' . implode(', ', $this->filters['skills']);
        }
        
        if (isset($this->filters['experience'])) {
            $filterStrings[] = 'Experience: ' . $this->filters['experience'] . ' years';
        }
        
        if (isset($this->filters['education'])) {
            $filterStrings[] = 'Education: ' . $this->filters['education'];
        }
        
        if (isset($this->filters['location'])) {
            $filterStrings[] = 'Location: ' . $this->filters['location'];
        }

        return implode(' | ', $filterStrings);
    }
}
