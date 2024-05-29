<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthComments extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba untuk mengautentikasi pengguna
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Jika pengguna berhasil diautentikasi, kembalikan user_id
            return response()->json(['user_id' => Auth::id()], 200);
        } else {
            // Jika autentikasi gagal, kembalikan pesan kesalahan
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }
}
