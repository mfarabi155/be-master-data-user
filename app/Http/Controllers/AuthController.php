<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Login Pengguna dan mengembalikan token
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        // Cek kredensial pengguna
        if (Auth::attempt(['user_email' => $request->user_email, 'password' => $request->password])) {
            $user = Auth::user();

            // Mengupdate status pengguna menjadi 'login'
            $user->update(['user_status' => true]);

            // Menghasilkan JWT token
            $token = JWTAuth::fromUser($user);

            return response()->json([
                'message' => 'Login successful',
                'token' => $token
            ]);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

    /**
     * Logout Pengguna dan mengubah status menjadi 'logout'
     */
    public function logout(Request $request)
    {
        $token = JWTAuth::getToken();
    
        try {
            $user = JWTAuth::toUser($token);
    
            $user->update(['user_status' => false]);
    
            JWTAuth::invalidate($token);
    
            return response()->json(['message' => 'Successfully logged out', 'user' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Token is invalid or expired'], 400);
        }
    }

    /**
     * Mendapatkan Data Pengguna yang sedang login
     */
    public function user()
    {
        return response()->json(Auth::user());
    }
}
