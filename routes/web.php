<?php

use App\Http\Controllers\authentications\LoginController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\dashboard\Dashboard;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RekapData;
use App\Http\Controllers\EditDiklat;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\authentications\RegisterController;
use App\Http\Controllers\cards\FotoDiklat;
use App\Http\Controllers\icons\Boxicons;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\TambahDiklat;
use App\Http\Controllers\tables\DataDiklat;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DiklatController;
use App\Http\Controllers\DokumentasiController;
use App\Http\Controllers\PesertaController;


// Routes untuk autentikasi
Route::get('/', [LoginController::class, 'index'])->name('auth-login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');

Route::prefix('auth')->group(function () {
    Route::get('/forgot-password-administrator', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-admin');
    Route::get('/register-administrator', function () {
        return view('content.authentications.auth-register-basic');
    })->name('auth-register-administrator');
    Route::post('/register-administrator', [RegisterController::class, 'store'])->name('auth.register-admin');

    Route::post('/auth/logout', function () {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('auth-login');
    })->name('logout');
});

// Routes untuk layout (tidak membutuhkan autentikasi)
Route::prefix('layouts')->group(function () {
    Route::get('/without-menu', [WithoutMenu::class, 'index'])->name('layouts-without-menu');
    Route::get('/without-navbar', [WithoutNavbar::class, 'index'])->name('layouts-without-navbar');
    Route::get('/fluid', [Fluid::class, 'index'])->name('layouts-fluid');
    Route::get('/container', [Container::class, 'index'])->name('layouts-container');
    Route::get('/blank', [Blank::class, 'index'])->name('layouts-blank');
});


// Routes untuk cards dan icons (tidak membutuhkan autentikasi)
Route::get('/foto-diklat', [FotoDiklat::class, 'index'])->name('foto-diklat');
Route::get('/icons/boxicons', [Boxicons::class, 'index'])->name('icons-boxicons');

// Routes untuk user (tidak membutuhkan autentikasi)
Route::prefix('users')->group(function () {
    Route::get('/daftar', function () {
        return view('users.daftar');
    })->name('users.daftar');


    Route::get('/form-daftar', [DaftarController::class, 'formDaftar'])->name('users.form-daftar');

    Route::get('/daftar/{id}', [DaftarController::class, 'index'])->name('users.daftar');
    Route::get('/form-daftar', [DaftarController::class, 'formDaftar'])->name('users.form-daftar');
    Route::post('/form-daftar', [DaftarController::class, 'store'])->name('form.daftar');
    Route::post('/submit-daftar', [DaftarController::class, 'store'])->name('form.daftar');
    Route::get('/cek-nik/{nik}', [DaftarController::class, 'cekNik'])->name('cek.nik');

    Route::post('/submit-pendaftaran', [DaftarController::class, 'store'])->name('form.daftar');
    Route::post('/diklat/{id_diklat}/peserta/{id_peserta}/approve', [DiklatController::class, 'updatePesertaStatus'])
        ->name('diklat.peserta.approve');

    // Ubah dari closure ke controller method
    Route::get('/index', [UserController::class, 'index'])->name('users.index-u');

    Route::get('/daftar-diklat', [DaftarController::class, 'index'])->name('daftar.diklat');

    Route::get('/users/daftar-diklat/{id}', [UserController::class, 'show'])->name('users.daftar-diklat');

});

// Routes yang dilindungi middleware "auth"
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');
});

// Routes khusus untuk admin dengan middleware "admin"
Route::middleware(['admin'])->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');
    Route::get('/dokumentasi-foto', [DiklatController::class, 'fotoDiklat'])->name('dokumentasi.foto');
    Route::post('/dokumentasi', [DokumentasiController::class, 'store'])->name('dokumentasi.store');
    Route::put('/dokumentasi/{id}', [DokumentasiController::class, 'update'])->name('dokumentasi.update');

    Route::get('/data-diklat', [DataDiklat::class, 'index'])->name('data-diklat');
    Route::get('/foto-diklat', [DiklatController::class, 'fotoDiklat'])->name('dokumentasi.foto');
    Route::get('/edit-diklat', [EditDiklat::class, 'edit'])->name('edit-diklat');
    Route::get('/tambah-diklat', [TambahDiklat::class, 'index'])->name('tambah-diklat');
    Route::get('/form/layouts-vertical', [VerticalForm::class, 'index'])->name('form-layouts-vertical');

    // Diklat Management Routes
    Route::prefix('diklat')->group(function () {
        Route::get('/create', [DiklatController::class, 'create'])->name('diklat.create');
        Route::post('/store', [DiklatController::class, 'store'])->name('diklat.store');
        Route::get('/{id}/edit', [DiklatController::class, 'edit'])->name('diklat.edit');
        Route::put('/{id}/update', [DiklatController::class, 'update'])->name('diklat.update');
        Route::delete('/{id}/delete', [DiklatController::class, 'destroy'])->name('diklat.destroy');

        Route::post('/{id}/toggle-pengumuman', [DiklatController::class, 'togglePengumuman'])->name('diklat.togglePengumuman');

        Route::get('/foto-diklat', [DiklatController::class, 'fotoDiklat'])->name('dokumentasi.foto');
        Route::post('/{id}/update-foto', [DiklatController::class, 'updateFoto'])->name('diklat.update-foto');

        Route::post('/peserta/{id}/toggle-status', [DiklatController::class, 'togglePesertaStatus'])
            ->name('peserta.toggle-status');

        // Routes untuk status, pengumuman, dan kuis toggle
        Route::get('/{id}/status/{status}', [DiklatController::class, 'updateStatus'])->name('diklat.updateStatus');
        Route::post('/{id}/pengumuman', [DiklatController::class, 'togglePengumuman'])->name('diklat.pengumuman');
        Route::post('/{id}/quiz', [DiklatController::class, 'toggleQuiz'])->name('diklat.quiz');

        // Route untuk rekap data
        Route::get('/{id}/rekap', [DiklatController::class, 'rekapData'])->name('diklat.rekap');
        Route::get('/rekap/{id_diklat}', [RekapData::class, 'index'])->name('rekap-data');
        Route::post('/peserta/{id}/status', [PesertaController::class, 'updateStatus'])->name('peserta.update-status');
        Route::post('/peserta/{id_peserta}/sertifikat', [RekapData::class, 'updateSertifikat'])->name('peserta.update-sertifikat');

        // Routing untuk peserta
        Route::get('/{id}/peserta', [PesertaController::class, 'getPesertaByDiklat'])->name('diklat.peserta');
        Route::post('/peserta/{id}/status', [PesertaController::class, 'updateStatus'])->name('peserta.updateStatus');
        Route::delete('/peserta/{id}', [PesertaController::class, 'destroy'])->name('peserta.destroy');
        Route::post('/peserta/{id}/status', [PesertaController::class, 'updateStatus'])->name('peserta.update-status');
        Route::post('/peserta/{id_peserta}/update-status', [DiklatController::class, 'updateStatusPeserta']);
        Route::post('/peserta/{id}/sertifikat', [PesertaController::class, 'updateSertifikat'])->name('peserta.update-sertifikat');

        Route::get('/{id}/peserta-lolos', [DiklatController::class, 'pesertaLolos'])->name('peserta.lolos');
        Route::get('/{id}/peserta-mendaftar', [DiklatController::class, 'pesertaMendaftar'])->name('peserta.mendaftar');


        // Route untuk generate sertifikat
        Route::post('/{id}/generate-certificates', [DiklatController::class, 'generateCertificates'])->name('diklat.generateCertificates');
    });


});
