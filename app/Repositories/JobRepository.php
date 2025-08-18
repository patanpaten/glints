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

    public function find($id)
    {
        return $this->model->find($id);
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

        // Filter status
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

        // Filter tanggal posting
        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $start = Carbon::parse($filters['start_date'])->startOfDay();
            $end   = Carbon::parse($filters['end_date'])->endOfDay();
            $query->whereBetween('created_at', [$start, $end]);
        }

        return $query->latest()->paginate(10);
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
