<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Ambil diklat yang aktif (status = 1)
        $diklat = Diklat::where('status', 1)
                        ->orderBy('tgl_mulai', 'asc')
                        ->first();

        return view('users.index-u', compact('diklat'));
    }
}