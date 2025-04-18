<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:8|max:255',
            'email' => 'required|email:dns|unique:users,email',
            'password' => 'required|string|min:8|letters|mixedCase|numbers|symbols|confirmed',
        ]);

        $user = User::create([
            'username' => $request->username, // ✅ perbaiki nama field
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // ✅ redirect ke login page setelah berhasil register
        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            // ✅ redirect ke dashboard setelah login
            return redirect()->route('dashboard')->with('success', 'Login successful!');
        }

        return back()->with('error', 'Invalid credentials.');
    }
}
