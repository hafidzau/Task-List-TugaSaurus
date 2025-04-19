<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register', [
            'title' => 'register',
        ]);
    }

    public function register(Request $request)
    {
        // Validasi input dari user
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|min:8|max:255|regex:/^[a-zA-Z0-9_.]+$/|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [ 
                'required', 
                Password::min(8)->mixedCase()->letters()->numbers()->symbols()
            ],
        ], [
            // Error message for name
            'name.required' => 'Name is required.',
        
            // Error message for username
            'username.regex' => 'Username can only contain letters, numbers, periods (.), or underscores (_), and no spaces.',
            'username.required' => 'Username is required.',
            'username.min' => 'Username must be at least 8 characters long.',
            'username.max' => 'Username must not exceed 255 characters.',
            
            // Error message for password
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters long.',
            'password.mixedCase' => 'Password must contain both uppercase and lowercase letters.',
            'password.letters' => 'Password must contain letters.',
            'password.numbers' => 'Password must contain numbers.',
            'password.symbols' => 'Password must contain symbols.',
        
            // Error message for email
            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email format.',
            'email.unique' => 'Email is already registered.',
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // 🟢 Login user langsung setelah registrasi (session-based)
        Auth::login($user);
        return redirect()->intended('login');
    }
}
