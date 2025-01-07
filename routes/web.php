<?php

use App\Http\Controllers\authentications\LoginController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\dashboard\Dashboard;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RekapData;
use App\Http\Controllers\EditDiklat;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\authentications\Login;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\authentications\RegisterController;
use App\Http\Controllers\cards\FotoDiklat;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\icons\Boxicons;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\TambahDiklat;
use App\Http\Controllers\tables\DataDiklat;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DiklatController;
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

    Route::get('/daftar/{id}', [DaftarController::class, 'index'])->name('users.daftar');
    Route::get('/form-daftar', [DaftarController::class, 'formDaftar'])->name('users.form-daftar');
    Route::post('/form-daftar', [DaftarController::class, 'store'])->name('form.daftar');
    Route::post('/submit-daftar', [DaftarController::class, 'store'])->name('form.daftar');
    Route::get('/cek-nik/{nik}', [DaftarController::class, 'cekNik'])->name('cek.nik');

    // Ubah dari closure ke controller method
    Route::get('/index', [UserController::class, 'index'])->name('users.index-u');

    Route::get('/daftar-diklat', [DaftarController::class, 'index'])->name('daftar.diklat');
    Route::post('/submit-pendaftaran', [DaftarController::class, 'store'])->name('form.daftar');

    Route::post('/diklat/{id_diklat}/peserta/{id_peserta}/approve', [DiklatController::class, 'updatePesertaStatus'])
    ->name('diklat.peserta.approve');

    Route::get('/users/daftar-diklat/{id}', [UserController::class, 'show'])->name('users.daftar-diklat');
});

// Routes yang dilindungi middleware "auth"
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');
});

// Routes khusus untuk admin dengan middleware "admin"
Route::middleware(['admin'])->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');

    // Diklat Management Routes
    Route::prefix('diklat')->group(function () {
        Route::get('/create', [DiklatController::class, 'create'])->name('diklat.create');
        Route::post('/store', [DiklatController::class, 'store'])->name('diklat.store');
        Route::get('/{id}/edit', [DiklatController::class, 'edit'])->name('diklat.edit');
        Route::put('/{id}/update', [DiklatController::class, 'update'])->name('diklat.update');
        Route::delete('/{id}/delete', [DiklatController::class, 'destroy'])->name('diklat.destroy');

        // Routes untuk status, pengumuman, dan kuis toggle
        Route::get('/diklat/{id}/status/{status}', [DiklatController::class, 'updateStatus'])->name('diklat.updateStatus');
        Route::post('/{id}/pengumuman', [DiklatController::class, 'togglePengumuman'])->name('diklat.pengumuman');
        Route::post('/{id}/quiz', [DiklatController::class, 'toggleQuiz'])->name('diklat.quiz');

        // Route untuk rekap data
        Route::get('/{id}/rekap', [DiklatController::class, 'rekapData'])->name('diklat.rekap');
        Route::get('/rekap/{id_diklat}', [RekapData::class, 'index'])->name('rekap-data');
        Route::post('/diklat/peserta/{id}/status', [PesertaController::class, 'updateStatus'])->name('peserta.update-status');
        Route::post('/peserta/{id_peserta}/sertifikat', [RekapData::class, 'updateSertifikat'])->name('peserta.update-sertifikat');

        // Routing untuk peserta
        Route::get('/{id}/peserta', [PesertaController::class, 'getPesertaByDiklat'])->name('diklat.peserta');
        Route::delete('/peserta/{id}', [PesertaController::class, 'destroy'])->name('peserta.destroy');
        Route::post('/peserta/{id}/status', [PesertaController::class, 'updateStatus'])->name('peserta.update-status');
        Route::post('/peserta/{id}/sertifikat', [PesertaController::class, 'updateSertifikat'])->name('peserta.update-sertifikat');

        // Route untuk generate sertifikat
        Route::post('/{id}/generate-certificates', [DiklatController::class, 'generateCertificates'])->name('diklat.generateCertificates');
    });

    Route::get('/data-diklat', [DataDiklat::class, 'index'])->name('data-diklat');
    Route::get('/edit-diklat', [EditDiklat::class, 'edit'])->name('edit-diklat');
    Route::get('/tambah-diklat', [TambahDiklat::class, 'index'])->name('tambah-diklat');
    Route::get('/form/layouts-vertical', [VerticalForm::class, 'index'])->name('form-layouts-vertical');


});


// pages
// Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');
// Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name('pages-account-settings-notifications');
// Route::get('/pages/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name('pages-account-settings-connections');
// Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
// Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name('pages-misc-under-maintenance');

// User Interface
// Route::get('/ui/accordion', [Accordion::class, 'index'])->name('ui-accordion');
// Route::get('/ui/alerts', [Alerts::class, 'index'])->name('ui-alerts');
// Route::get('/ui/badges', [Badges::class, 'index'])->name('ui-badges');
// Route::get('/ui/buttons', [Buttons::class, 'index'])->name('ui-buttons');
// Route::get('/ui/carousel', [Carousel::class, 'index'])->name('ui-carousel');
// Route::get('/ui/collapse', [Collapse::class, 'index'])->name('ui-collapse');
// Route::get('/ui/dropdowns', [Dropdowns::class, 'index'])->name('ui-dropdowns');
// Route::get('/ui/footer', [Footer::class, 'index'])->name('ui-footer');
// Route::get('/ui/list-groups', [ListGroups::class, 'index'])->name('ui-list-groups');
// Route::get('/ui/modals', [Modals::class, 'index'])->name('ui-modals');
// Route::get('/ui/navbar', [Navbar::class, 'index'])->name('ui-navbar');
// Route::get('/ui/offcanvas', [Offcanvas::class, 'index'])->name('ui-offcanvas');
// Route::get('/ui/pagination-breadcrumbs', [PaginationBreadcrumbs::class, 'index'])->name('ui-pagination-breadcrumbs');
// Route::get('/ui/progress', [Progress::class, 'index'])->name('ui-progress');
// Route::get('/ui/spinners', [Spinners::class, 'index'])->name('ui-spinners');
// Route::get('/ui/tabs-pills', [TabsPills::class, 'index'])->name('ui-tabs-pills');
// Route::get('/ui/toasts', [Toasts::class, 'index'])->name('ui-toasts');
// Route::get('/ui/tooltips-popovers', [TooltipsPopovers::class, 'index'])->name('ui-tooltips-popovers');
// Route::get('/ui/typography', [Typography::class, 'index'])->name('ui-typography');

// extended ui
// Route::get('/extended/ui-perfect-scrollbar', [PerfectScrollbar::class, 'index'])->name('extended-ui-perfect-scrollbar');
// Route::get('/extended/ui-text-divider', [TextDivider::class, 'index'])->name('extended-ui-text-divider');

// form elements
// Route::get('/forms/basic-inputs', [BasicInput::class, 'index'])->name('forms-basic-inputs');
// Route::get('/forms/input-groups', [InputGroups::class, 'index'])->name('forms-input-groups');