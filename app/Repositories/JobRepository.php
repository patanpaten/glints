<?php

namespace App\Repositories;

use App\Models\Job;
use Carbon\Carbon;

class JobRepository
{
    protected $model;

    public function __construct(Job $job)
    {
        $this->model = $job;
    }

    /**
     * Get the model instance
     *
     * @return \App\Models\Job
     */
    public function getModel()
    {
        return $this->model;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }
    
    /**
     * Find job by slug
     *
     * @param string $slug
     * @return \App\Models\Job|null
     */
    public function findBySlug(string $slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function getByCompanyId($companyId)
    {
        return $this->model->where('company_id', $companyId)->get();
    }

    /**
     * Ambil job dengan filter dinamis
     *
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getByFilters(array $filters = [])
    {
        $query = $this->model->newQuery();

        // Filter company
        if (!empty($filters['company_id'])) {
            $query->where('company_id', $filters['company_id']);
        }

        // Filter status (active/inactive)
        if (isset($filters['is_active'])) {
            $query->where('is_active', $filters['is_active']);
        }
        
        // Filter status (for admin/company dashboard)
        if (!empty($filters['status']) && $filters['status'] !== 'all') {
            $query->where('status', $filters['status']);
        }

        // Filter search (judul / deskripsi)
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }
        
        // Filter location
        if (!empty($filters['location'])) {
            $location = $filters['location'];
            $query->where('location', 'LIKE', "%{$location}%");
        }
        
        // Filter category
        if (!empty($filters['category_id'])) {
            $query->where('job_category_id', $filters['category_id']);
        }
        
        // Filter employment type
        if (!empty($filters['employment_type'])) {
            if (is_array($filters['employment_type'])) {
                $query->whereIn('employment_type', $filters['employment_type']);
            } else {
                $query->where('employment_type', $filters['employment_type']);
            }
        }
        
        // Filter experience level
        if (!empty($filters['experience_level'])) {
            if (is_array($filters['experience_level'])) {
                $query->whereIn('experience_level', $filters['experience_level']);
            } else {
                $query->where('experience_level', $filters['experience_level']);
            }
        }
        
        // Filter salary range
        if (!empty($filters['salary_range'])) {
            if (is_array($filters['salary_range'])) {
                $query->where(function($q) use ($filters) {
                    foreach ($filters['salary_range'] as $range) {
                        list($min, $max) = array_pad(explode('-', $range), 2, null);
                        
                        if ($min && $max) {
                            // Range like 5000000-10000000
                            $q->orWhereBetween('salary_min', [$min, $max])
                              ->orWhereBetween('salary_max', [$min, $max]);
                        } elseif ($min) {
                            // Range like 20000000-
                            $q->orWhere('salary_min', '>=', $min);
                        } elseif ($max) {
                            // Range like -5000000
                            $q->orWhere('salary_max', '<=', $max);
                        }
                    }
                });
            }
        }

        // Filter tanggal posting
        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $start = Carbon::parse($filters['start_date'])->startOfDay();
            $end   = Carbon::parse($filters['end_date'])->endOfDay();
            $query->whereBetween('created_at', [$start, $end]);
        }
        
        // Sorting
        if (!empty($filters['sort'])) {
            switch ($filters['sort']) {
                case 'oldest':
                    $query->oldest();
                    break;
                case 'salary_high':
                    $query->orderByDesc('salary_max')->orderByDesc('salary_min');
                    break;
                case 'salary_low':
                    $query->orderBy('salary_min')->orderBy('salary_max');
                    break;
                case 'newest':
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }

        return $query->with('company', 'jobCategory', 'skills')->paginate(15);
    }

    public function countByFilters(array $filters = [])
    {
        return $this->getByFilters($filters)->total();
    }

    public function getFeaturedJobs($limit = 8)
    {
        return $this->model
            ->where('is_featured', true)
            ->latest()
            ->take($limit)
            ->get();
    }

    public function getLatestJobs($limit = 10)
    {
        return $this->model
            ->latest()
            ->take($limit)
            ->get();
    }
}
