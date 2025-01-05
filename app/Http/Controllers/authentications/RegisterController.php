<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // Validasi hanya untuk username dan password, tidak perlu email
        $request->validate([
            'username' => 'required|string|max:255|unique:tb_admin,user',
            'password' => 'required|string|min:8|max:255',
            'terms' => 'accepted',
        ]);

        // Simpan data admin, hanya user dan pass yang diperlukan
        Admin::create([
            'user' => $request->username,
            'pass' => Hash::make($request->password),
            'status' => 1, // Status Default set Administrator
        ]);

        return redirect()->route('auth-login')->with('success', 'Account created successfully. Please login.');
    }
}
