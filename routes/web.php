<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\KamarController;
use App\Http\Controllers\Admin\CekBerkasController;
use App\Http\Controllers\Mahasiswa\KamarController as MahasiswaKamarController;
use App\Http\Controllers\Mahasiswa\MahasiswaController;
use App\Http\Controllers\Mahasiswa\PembayaranController;
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

    Route::get('/data-kamar', [MahasiswaKamarController::class, 'index']);

    Route::get('/pembayaran-kamar', [PembayaranController::class, 'create']);
    Route::post('/pembayaran-kamar/payment', [PembayaranController::class, 'PaymentWhitMidtrans']);
    Route::post('/pembayaran-kamar/success', [PembayaranController::class, 'PaymentSucces']);

    Route::resource('pendaftaran-kamar', PendaftaranKamarController::class);


    Route::get('/informasi-akun', [MahasiswaController::class, 'showProfile']);
    Route::post('/informasi-akun/store', [MahasiswaController::class, 'store'])->name('informasi-akun.store');
    Route::post('/informasi-akun/delete-photo', [MahasiswaController::class, 'deletePhotoProfile'])->name('delete.photo');
});

// ======================= ADMIN ============================
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/kelola-data-kamar', [KamarController::class, 'index']);
    Route::get('/search-data-kamar', [KamarController::class, 'search']);
    Route::get('/kelola-data-kamar/tambah-kamar', [KamarController::class, 'create']);
    Route::post('/kelola-data-kamar/tambah-kamar/store', [KamarController::class, 'store']);
    Route::get('/kelola-data-kamar/data-kamar/{jenis_kamar}', [KamarController::class, 'indexByJenis']);
    Route::get('/kelola-data-kamar/data-kamar/{jenis_kamar}/detail/{id}', [KamarController::class, 'show']);
    Route::get('/kelola-data-kamar/data-kamar/{jenis_kamar}/edit/{id}', [KamarController::class, 'edit']);
    Route::put('/kelola-data-kamar/data-kamar/{jenis_kamar}/update/{id}', [KamarController::class, 'update']);
    Route::delete('/kelola-data-kamar/data-kamar/{jenis_kamar}/delete/{id}', [KamarController::class, 'destroy']);

    Route::get('/search-akun', [AdminController::class, 'search']);
    Route::get('/kelola-data-akun', [AdminController::class, 'kelolaAkun']);
    Route::put('/akun/{id}/approve', [AdminController::class, 'approveAkun']);
    Route::put('/akun/{id}/pending', [AdminController::class, 'pendingAkun']);
    Route::delete('/akun/{id}', [AdminController::class, 'rejectAkun']);

    // semua data berkas
    Route::get('/admin/kelola-berkas-pendaftaran', [CekBerkasController::class, 'indexAll'])->name('admin.berkas.all');
    // kelola data berkas 
    Route::get('/admin/kelola-berkas-pendaftaran/{gender}', [CekBerkasController::class, 'showByGender'])->name('admin.berkas.byGender');

    // ✅ Route lihat berkas per jenis kelamin (laki-laki/perempuan)
    Route::get('/admin/kelola-berkas-pendaftaran/berkas/{gender}', [CekBerkasController::class, 'showByGender'])->name('admin.berkas.byGender');

    // ✅ Route detail 1 pendaftar
    Route::get('/admin/kelola-berkas-pendaftaran/berkas/detail/{id}', [CekBerkasController::class, 'show'])->name('admin.berkas.detail');

    // ✅ Route update status (approve/pending/reject)
    Route::put('/admin/kelola-berkas-pendaftaran/berkas/update-status/{id}', [CekBerkasController::class, 'updateStatus'])->name('admin.berkas.update-status');

    // ✅ Route download PDF
    Route::get('/admin/kelola-berkas-pendaftaran/berkas/download/{id}', [CekBerkasController::class, 'unduhBukti'])->name('admin.berkas.download');

    // ✅ Route hapus berkas
    Route::delete('/admin/kelola-berkas-pendaftaran/berkas/delete/{id}', [CekBerkasController::class, 'destroy'])->name('admin.berkas.delete');
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
// ==========================g
