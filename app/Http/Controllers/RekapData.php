<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekapData extends Controller
{
    // Menampilkan halaman rekap data
    public function index()
    {
        return view('content.tables.rekap-data');
    }
}
