<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditDiklat extends Controller
{
    public function edit()
    {
        // Mengarahkan ke view 'views/content/form-layout/edit-diklat.blade.php'
        return view('content.form-layout.edit-diklat');
    }
}
