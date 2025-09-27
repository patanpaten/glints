<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
{
    $googleUser = Socialite::driver('google')->stateless()->user();

    // Pecah nama jadi first_name & last_name
    $names = explode(' ', $googleUser->name, 2);
    $firstName = $names[0] ?? '';
    $lastName  = $names[1] ?? null;

    // Cari user
    $user = User::where('google_id', $googleUser->id)->first();

    if (!$user) {
        $user = User::create([
            'name'            => $firstName,
            'last_name'       => $lastName,
            'email'           => $googleUser->email,
            'google_id'       => $googleUser->id,
            'profile_picture' => $googleUser->avatar,
            'password'        => bcrypt(str()->random(12)),
        ]);
    }

    // Cari atau buat company terkait user ini
    $company = \App\Models\Company::firstOrCreate(
        ['user_id' => $user->id],
        ['name' => $firstName . ' ' . $lastName]
    );

    // Login sebagai company
    Auth::guard('company')->login($company);

    return redirect()->route('company.profile.edit');
}


}
