<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function index (){
        return view('auth.login',[
            'title'=>'login'
        ]);
    }
    public function login(Request $request)
    {
        $validated = $request->validate([
            'identifier' => 'required|string', // Bisa email atau username
            'password' => 'required|string',
        ]);

        // Tentukan apakah user login pakai email atau username
        $fieldType = filter_var($validated['identifier'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Coba login
        if (Auth::attempt([$fieldType => $validated['identifier'], 'password' => $validated['password']])) {
            $request->session()->regenerate(); // Regenerate session ID untuk keamanan

            return response()->json([
                'message' => 'Login successful',
                'user' => Auth::user(),
            ]);
        }

        throw ValidationException::withMessages([
            'identifier' => ['The provided credentials are incorrect.'],
        ]);
    }
}