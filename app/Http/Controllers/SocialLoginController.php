<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite; // Import Socialite facade
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SocialLoginController extends Controller
{
    // Redirect to Google for authentication
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle callback from Google
    public function callback()
    {
        // Get user info from Google
        $googleUser = Socialite::driver('google')->user();

        // Find existing user or create new one
        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                // If you don't have password in social login, you can set a random password or null if nullable
                'password' => bcrypt('password'), 
                'role' => 'user'  // Make sure 'role' is fillable in User model
            ]
        );

        // Log the user in
        Auth::login($user);

        // Redirect to home or intended page
        return redirect()->intended('/');
    }
}
