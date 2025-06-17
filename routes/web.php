<?php

use App\Http\Controllers\MahasiswaAuthController;
use Illuminate\Support\Facades\Route;

// ==========================
// Route for Mahasiswa
// ==========================

Route::get('/', [MahasiswaAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login/user', [MahasiswaAuthController::class, 'login']);

Route::get('/register', [MahasiswaAuthController::class, 'showRegisterForm']);
Route::post('/register/user', [MahasiswaAuthController::class, 'register']);

Route::middleware('auth')->group(function () {
    Route::get('/data-kamar', function () {
        return view('mahasiswa.informasiDataKamar'); // contoh dashboard
    });

    Route::get('/logout', [MahasiswaAuthController::class, 'logout']);
});

// Route for the Mahasiswa regstration room page
Route::get('/registrasi-kamar', function () {
    return view('mahasiswa.pendaftaranKamar');
});

// Route for Account Information page
Route::get('/informasi-akun', function () {
    return view('mahasiswa.informasiAkunMahasiswa');
});

// ==========================
// End Route for Mahasiswa
// ==========================

// ==========================
// Route for Admin
// ==========================
Route::get('/admin/login', function () {
    return view('admin.loginAdmin');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboardAdmin');
});

Route::get('/admin/kelola-data-kamar', function () {
    return view('admin.kelolaDataKamar');
});

Route::get('/admin/kelola-data-penghuni', function () {
    return view('admin.kelolaDataPenghuni');
});

Route::get('/admin/kelola-data-akun', function () {
    return view('admin.kelolaDataAkun');
});

Route::get('/admin/kelola-data-akun/edit-data-akun', function(){
    return view('admin.editDataAkun');
});

Route::get('/admin/kelola-berkas-pendaftran', function () {
    return view('admin.kelolaDataBerkas');
});
// ==========================
// End Route for Admin
// ==========================

// ==========================
// Route for Bendahara
// ==========================

// ==========================
// End Route for Bendahara
// ==========================