<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Notification as Notification;
use App\Notifications\RegisterUserNotification;

class ProvideController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();


        // Check if the user with the same email already exists
        $existingUser = User::where('email', $socialUser->email)->first();

        if ($existingUser) {
            // If the user exists, log them in
            Auth::login($existingUser);
            return redirect('/dashboard');
        }


        // If the user doesn't exist, create a new user
        $user = User::Create([
            'name' => $socialUser->name,
            'username' => User::generateUserNameFromName($socialUser->name),
            'email' => $socialUser->email,
            'password' => 'password',
            'provider' => $provider,
            'provider_id' => $socialUser->id,
            'provider_token' => $socialUser->token,
            'email_verified_at' => now(),
        ]);

        Auth::login($user);

        $nUser = User::where('role', 'admin')->get();
        Notification::send($nUser, new RegisterUserNotification($socialUser));

        return redirect('/dashboard');
    }
}
