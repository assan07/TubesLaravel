<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MahasiswaAuthController;

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
    Route::post('/informasi-akun/store', [MahasiswaController::class, 'store']);

    Route::get('/logout', [MahasiswaAuthController::class, 'logout']);
});
