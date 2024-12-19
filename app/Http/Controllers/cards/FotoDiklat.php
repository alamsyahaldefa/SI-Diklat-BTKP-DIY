<?php

namespace App\Http\Controllers\cards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FotoDiklat extends Controller
{
  public function index()
  {
    return view('content.cards.foto-diklat');
  }
}
