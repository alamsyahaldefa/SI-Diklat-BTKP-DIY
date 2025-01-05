<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function index()
    {
        return view('content.authentications.auth-login');
    }

    // Proses autentikasi
    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'user' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
            if ($admin->status === 'admin' || $admin->status == 1) {
                return redirect()->route('dashboard');
            }
            return redirect()->route('home');
        }

        // Kirim pesan error jika gagal login
        return redirect()->route('auth-login')
            ->withInput($request->only('username'))
            ->withErrors(['login_error' => 'Username atau password salah.']);
    }
}
