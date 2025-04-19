<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Tentukan apakah input adalah email atau username
        $loginField = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Coba login dengan data yang ada
        $credentials = [
            $loginField => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect ke halaman dashboard jika berhasil login
            return redirect()->intended('dashboard');
        }

        // Jika login gagal, kembalikan ke halaman sebelumnya dengan error
        return back()->withErrors([
            'email' => filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'Invalid email or password' : null,
            'username' => !filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'Invalid username or password' : null
        ])->withInput();
    }
}
