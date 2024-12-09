<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FotoDiklat extends Controller
{
  public function index()
  {
    // Jika perlu, Anda bisa mengambil data dari database dan mengirimnya ke view
    return view('cards.foto-diklat'); // Pastikan view foto-diklat.blade.php sudah ada di folder resources/views/cards
  }
}
