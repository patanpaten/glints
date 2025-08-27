<?php

namespace App\Auth;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;

class CompanyUserProvider extends EloquentUserProvider
{
    /**
     * Retrieve a user by their unique identifier.
     */
    public function retrieveById($identifier)
    {
        return Company::find($identifier);
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     */
    public function retrieveByToken($identifier, $token)
    {
        $company = Company::find($identifier);
        
        if ($company && $company->user && $company->user->remember_token === $token) {
            return $company;
        }
        
        return null;
    }

    /**
     * Update the "remember me" token for the given user in storage.
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        if ($user instanceof Company && $user->user) {
            $user->user->remember_token = $token;
            $user->user->save();
        }
    }

    /**
     * Retrieve a user by the given credentials.
     */
    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials) || !isset($credentials['email'])) {
            return null;
        }

        // Find user by email
        $user = User::where('email', $credentials['email'])
                   ->whereHas('role', function($query) {
                       $query->where('slug', 'company');
                   })
                   ->first();

        if (!$user) {
            return null;
        }

        // Find company by user_id
        return Company::where('user_id', $user->id)->first();
    }

    /**
     * Validate a user against the given credentials.
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        if (!$user instanceof Company || !$user->user) {
            return false;
        }

        return Hash::check($credentials['password'], $user->user->password);
    }
}