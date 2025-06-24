<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\Mahasiswa\DashboardController;
use App\Http\Controllers\Mahasiswa\PendaftaranKamarController;

// ==========================
// Route for Mahasiswa
// ==========================
// ====== Rute utama: redirect sesuai login status ======
Route::get('/', function () {
    if (Auth::check()) {
        return match (Auth::user()->role) {
            'admin' => redirect('/kelola-data-kamar'),
            'bendahara' => redirect('/cek-pembayaran'),
            default => redirect('/data-kamar'),
        };
    }

    return redirect('/login');
});

Route::middleware('guest')->group(function () {

    // Halaman login gabungan (untuk semua role)
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

    // Submit login form
    Route::post('/login', [AuthController::class, 'login']);

    // Form registrasi (jika dibutuhkan)
    Route::get('/register', [AuthController::class, 'showRegisterForm']);
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ======================= MAHASISWA ============================
Route::middleware(['auth', RoleMiddleware::class . ':mahasiswa'])->group(function () {

    Route::get('/data-kamar', function () {
        return view('mahasiswa.informasiDataKamar');
    });

    Route::get('/registrasi-kamar', function () {
        return view('mahasiswa.pendaftaranKamar');
    });


    Route::resource('pendaftaran-kamar', PendaftaranKamarController::class);


    Route::get('/informasi-akun', [MahasiswaController::class, 'showProfile']);
    Route::post('/informasi-akun/store', [MahasiswaController::class, 'store'])->name('informasi-akun.store');
    Route::post('/informasi-akun/delete-photo', [MahasiswaController::class, 'deletePhotoProfile'])->name('delete.photo');
});

// ======================= ADMIN ============================
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/kelola-data-kamar', function () {
        return view('admin.dataKamar.kelolaDataKamar');
    });

    Route::get('/kelola-data-akun', [AdminController::class, 'kelolaAkun']);
    Route::put('/akun/{id}/approve', [AdminController::class, 'approveAkun']);
    Route::put('/akun/{id}/pending', [AdminController::class, 'pendingAkun']);
    Route::delete('/akun/{id}', [AdminController::class, 'rejectAkun']);
});

// ======================= BENDAHARA ============================
Route::middleware(['auth', RoleMiddleware::class . ':bendahara'])->group(function () {

    Route::get('/cek-pembayaran', function () {
        return view('bendahara.cekPembayaran');
    });
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

Route::get('admin/kelola-data-kamar/tambah-kamar', function () {
    return view('admin.dataKamar.tambahKamar');
});

Route::get('admin/kelola-data-kamar/data-kamar/laki-laki', function () {
    return view('admin.dataKamar.dataKamarLakilaki');
});

Route::get('admin/kelola-data-kamar/data-kamar/perempuan', function () {
    return view('admin.dataKamar.dataKamarPerempuan');
});

Route::get('admin/kelola-data-kamar/data-kamar/laki-laki/detail', function () {
    return view('admin.dataKamar.detailDataKamarPerempuan');
});

Route::get('admin/kelola-data-kamar/data-kamar/perempuan/detail', function () {
    return view('admin.dataKamar.detailDataKamarPerempuan');
});

Route::get('admin/kelola-data-kamar/data-kamar/perempuan/edit', function () {
    return view('admin.dataKamar.editDataKamarPerempuan');
});

Route::get('admin/kelola-data-kamar/data-kamar/laki-laki/edit', function () {
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
