<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Mass assignable fields.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * Hidden fields.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // Laravel akan meng-hash setiap kali password di-set.
        'password' => 'hashed',
    ];

    /**
     * Relationships.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }

    public function jobSeeker(): HasOne
    {
        return $this->hasOne(JobSeeker::class);
    }

    /**
     * Role helpers (aman kalau role null).
     */
    public function isAdmin(): bool
    {
        return $this->role?->slug === 'admin';
    }

    public function isCompany(): bool
    {
        return $this->role?->slug === 'company';
    }

    public function isJobSeeker(): bool
    {
        return $this->role?->slug === 'job-seeker';
    }
}
