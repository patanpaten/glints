<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScreeningQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['job_listing_id', 'type', 'question'];

    public function job()
    {
        return $this->belongsTo(JobListing::class, 'job_listing_id');
    }
}
