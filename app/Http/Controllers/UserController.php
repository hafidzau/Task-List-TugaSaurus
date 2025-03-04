<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'usernamename' => $request->username, // Perbaiki field yang diambil
            'email' => $request->email,
            'password' => Hash::make($request->password), // Gunakan Hash
        ]);

        return response()->json(['message' => 'User registered successfully!', 'user' => $user], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Login successful!', 'user' => $user]);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }
}

