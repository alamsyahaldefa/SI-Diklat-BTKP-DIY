<?php

namespace App\Http\Controllers\tables;

use App\Http\Controllers\Controller;
use App\Models\Diklat;

class DataDiklat extends Controller
{
    public function index()
    {
        // Ambil data diklat dengan pagination dan urutkan berdasarkan id terbesar
        $diklats = Diklat::orderBy('id_diklat', 'desc')->paginate(10);

        // Kirim data ke view
        return view('content.tables.data-diklat', compact('diklats'));
    }
}
