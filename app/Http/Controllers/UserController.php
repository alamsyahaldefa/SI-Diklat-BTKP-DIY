<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Ambil diklat yang aktif (status = 1) dengan paginasi
        $diklatAktif = Diklat::where('status', 1)
            ->orderBy('tgl_mulai', 'desc')
            ->paginate(10); // Ambil 10 data per halaman

        // Kirim data ke view
        return view('users.index-u', compact('diklatAktif'));
    }
    public function show($id)
    {
        // Ambil data diklat berdasarkan ID
        $diklat = Diklat::findOrFail($id);

        // Kirimkan data ke view
        return view('users.daftar', compact('diklat'));
    }

}
