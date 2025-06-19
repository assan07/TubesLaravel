<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MahasiswaAuthController;

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

    // Route for the Mahasiswa regstration room page
    Route::get('/registrasi-kamar', function () {
        return view('mahasiswa.pendaftaranKamar');
    });

    // Route for Account Information page
    Route::get('/informasi-akun', [MahasiswaController::class, 'showProfile']);
    Route::post('/informasi-akun/store', [MahasiswaController::class, 'store']) ->name('store.informasi-akun');
    Route::post('/informasi-akun/delete-photo', [MahasiswaController::class, 'deletePhotoProfile'])->name('delete.photo');


    Route::get('/logout', [MahasiswaAuthController::class, 'logout']);
});


// ==========================
// End Route for Mahasiswa
// ==========================

// ===========================================================================================
// Route for Admin
// ==========================
Route::get('/admin/login', function () {
    return view('admin.auth.loginAdmin');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboardAdmin');
});

Route::get('/admin/kelola-data-kamar', function () {
    return view('admin.dataKamar.kelolaDataKamar');
});

Route::get('admin/kelola-data-kamar/tambah-kamar', function(){
    return view('admin.dataKamar.tambahKamar');
});

Route::get('admin/kelola-data-kamar/data-kamar/laki-laki', function(){
    return view('admin.dataKamar.dataKamarLakilaki');
});

Route::get('admin/kelola-data-kamar/data-kamar/perempuan', function(){
    return view('admin.dataKamar.dataKamarPerempuan');
});

Route::get('admin/kelola-data-kamar/data-kamar/laki-laki/detail', function(){
    return view('admin.dataKamar.detailDataKamarPerempuan');
});

Route::get('admin/kelola-data-kamar/data-kamar/perempuan/detail', function(){
    return view('admin.dataKamar.detailDataKamarPerempuan');
});

Route::get('admin/kelola-data-kamar/data-kamar/perempuan/edit', function(){
    return view('admin.dataKamar.editDataKamarPerempuan');
});

Route::get('admin/kelola-data-kamar/data-kamar/laki-laki/edit', function(){
    return view('admin.dataKamar.editDataKamarLakilaki');
});

Route::get('/admin/kelola-data-penghuni', function () {
    return view('admin.dataPenghuni.kelolaDataPenghuni');
});

Route::get('/admin/kelola-data-akun', function () {
    return view('admin.dataAkun.kelolaDataAkun');
});

Route::get('/admin/kelola-berkas-pendaftran', function () {
    return view('admin.dataBerkas.kelolaDataBerkas');
});

Route::get('/admin/kelola-berkas-pendaftran/laki-laki', function () {
    return view('admin.dataBerkas.kelolaDataBerkasLakilaki');
});

Route::get('/admin/kelola-berkas-pendaftran/laki-laki/detail', function () {
    return view('admin.dataBerkas.detailBerkasPendaftaranLakilaki');
});

Route::get('/admin/kelola-berkas-pendaftran/perempuan', function () {
    return view('admin.dataBerkas.kelolaDataBerkasPerempuan');
});

Route::get('/admin/kelola-berkas-pendaftran/perempuan/detail', function () {
    return view('admin.dataBerkas.detailBerkasPendaftaranPerempuan');
});


// ==========================
// End Route for Admin
// ==========================

// ====================================================================
// Route for Bendahara
// ==========================

// ==========================
// End Route for Bendahara
// ==========================
