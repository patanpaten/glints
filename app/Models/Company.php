<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Company extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'name',
        'logo',
        'description',
        'address',
        'city',
        'province',
        'postal_code',
        'phone',
        'website',
        'industry',
        'company_size',
        'credits',
        'country',
    ];

    /**
     * Get the user that owns the company.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the jobs for the company.
     */
    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }

    /**
     * Get the company subscriptions.
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(CompanySubscription::class);
    }

    /**
     * Check if company has active VIP status.
     */
    public function isVip(): bool
    {
        return $this->subscriptions()
            ->where('status', 'active')
            ->where('end_date', '>=', now())
            ->exists();
    }

    /**
     * Get company initials for avatar.
     */
    public function getInitialsAttribute(): string
    {
        $words = explode(' ', $this->name);
        $initials = '';
        
        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper(substr($word, 0, 1));
                if (strlen($initials) >= 2) break;
            }
        }
        
        return $initials ?: 'C';
    }

    /**
     * Get the identifier for authentication.
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    /**
     * Get the unique identifier for the user.
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the email from the related user.
     */
    public function getEmailAttribute()
    {
        return $this->user->email ?? null;
    }

    /**
     * Get the password from the related user.
     */
    public function getAuthPassword()
    {
        return $this->user->password ?? null;
    }

    /**
     * Get the remember token from the related user.
     */
    public function getRememberToken()
    {
        return $this->user->remember_token ?? null;
    }

    /**
     * Set the remember token on the related user.
     */
    public function setRememberToken($value)
    {
        if ($this->user) {
            $this->user->remember_token = $value;
            $this->user->save();
        }
    }

    /**
     * Get the remember token name.
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}