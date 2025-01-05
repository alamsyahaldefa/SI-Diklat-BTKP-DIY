<?php

namespace App\Http\Controllers\tables;

use App\Http\Controllers\Controller;
use App\Models\Diklat;

class DataDiklat extends Controller
{
    public function index()
    {
        // Ambil data diklat dengan pagination
        $diklats = Diklat::paginate(10);

        // Kirim data ke view
        return view('content.tables.data-diklat', compact('diklats'));
    }
}


