<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'category',
        'tags',
        'author_id',
        'read_time',
        'views',
        'is_published',
        'published_at'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'tags' => 'array'
    ];

    protected $dates = [
        'published_at'
    ];

    // Relationships
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    // Mutators
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Accessors
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getFormattedPublishedAtAttribute()
    {
        return $this->published_at ? $this->published_at->format('d M Y') : null;
    }

    public function incrementViews()
    {
        $this->increment('views');
    }

    // Helper methods
    public static function getCategories()
    {
        return [
            'Tips Karir' => 'Tips Karir',
            'Pengembangan Diri' => 'Pengembangan Diri',
            'Dunia Kerja' => 'Dunia Kerja',
            'Interview' => 'Interview',
            'CV & Resume' => 'CV & Resume',
            'Skill Development' => 'Skill Development',
            'Company Culture' => 'Company Culture',
            'Salary & Benefits' => 'Salary & Benefits'
        ];
    }
}