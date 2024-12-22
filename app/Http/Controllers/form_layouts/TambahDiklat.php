<?php

namespace App\Http\Controllers\form_layouts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TambahDiklat extends Controller
{
  public function index()
  {
    return view('content.form-layout.tambah-diklat');
  }
}
