<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    // 🟢 Logout dengan Session-Based Authentication
    public function logout(Request $request)
    {
        Auth::logout(); // Hapus session

        // Hapus semua session untuk keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logout successful']);
    }
}
