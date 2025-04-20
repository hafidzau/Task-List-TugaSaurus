<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GoogleController extends Controller
{
    // Redirect ke Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Callback dari Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            
            // Debug information
            Log::info('Google user data:', [
                'email' => $googleUser->getEmail(),
                'name' => $googleUser->getName(),
                'id' => $googleUser->getId()
            ]);
    
            // Generate a username from the email address
            $username = explode('@', $googleUser->getEmail())[0];
            
            // Cari user berdasarkan email
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'username' => $username, // Add username field
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt('defaultpasswordbeb'),
                ]
            );
    
            Log::info('User authenticated:', ['id' => $user->id, 'email' => $user->email]);
            
            Auth::login($user);
            
            if (Auth::check()) {
                Log::info('User successfully logged in');
                return redirect()->route('dashboard');
            } else {
                Log::error('Auth::login failed to log in the user');
                session()->flash('error', 'Failed to log in after Google authentication');
                return redirect('/login');
            }
        } catch (\Exception $e) {
            // Add more detailed error logging
            Log::error('Google login error: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            // Store error message in session flash data
            session()->flash('error', 'Google login failed: ' . $e->getMessage());
            return redirect('/login');
        }
    }
}
