<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\KamarController;
use App\Http\Controllers\Admin\CekBerkasController;

use App\Http\Controllers\admin\PenghuniController;

use App\Http\Controllers\Mahasiswa\KamarController as MahasiswaKamarController;
use App\Http\Controllers\Mahasiswa\MahasiswaController;
use App\Http\Controllers\Mahasiswa\PembayaranController;
use App\Http\Controllers\Mahasiswa\PendaftaranKamarController;
use App\Http\Controllers\Bendahara\PembayaranController as BendaharaPembayaranController;

use App\Http\Controllers\Mahasiswa\PasswordController;


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

    // ubah password
    Route::get('/ubah-password', [PasswordController::class, 'edit'])->name('password.edit');
    Route::post('/ubah-password', [PasswordController::class, 'update'])->name('password.update');


    Route::get('/data-kamar', [MahasiswaKamarController::class, 'index']);

    Route::get('/pembayaran-kamar', [PembayaranController::class, 'create']);
    Route::post('/pembayaran-kamar/payment', [PembayaranController::class, 'paymentWhitMidtrans']);
    Route::post('/pembayaran-kamar/success', [PembayaranController::class, 'PaymentSucces']);

    // ✅ Mahasiswa: Lihat riwayat pembayaran
    Route::get('/riwayat-pembayaran', [\App\Http\Controllers\Mahasiswa\PembayaranController::class, 'riwayat'])->name('mahasiswa.riwayat');
    Route::get('/riwayat/download/{id}', [PembayaranController::class, 'downloadBukti'])->name('riwayat.download');
    Route::delete('/riwayat/delete/{id}', [PembayaranController::class, 'destroy'])->name('riwayat.destroy');

    Route::resource('pendaftaran-kamar', PendaftaranKamarController::class);


    Route::get('/informasi-akun', [MahasiswaController::class, 'showProfile']);
    Route::post('/informasi-akun/store', [MahasiswaController::class, 'store'])->name('informasi-akun.store');
    Route::post('/informasi-akun/delete-photo', [MahasiswaController::class, 'deletePhotoProfile'])->name('delete.photo');
});
// ====================End Route for Mahasiswa=================================


// ======================= ADMIN ============================
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {


    // =================== Data Kamar ========================
    // ✅ Dashboard Kelola Kamar
    Route::get('/kelola-data-kamar', [KamarController::class, 'index'])->name('admin.kamar.dashboard');

    // ✅ Form Tambah Kamar
    Route::get('/kelola-data-kamar/tambah-kamar', [KamarController::class, 'create'])->name('admin.kamar.create');
    Route::post('/kelola-data-kamar/tambah-kamar/store', [KamarController::class, 'store'])->name('admin.kamar.store');

    // ✅ List Kamar per Jenis (Laki-laki / Perempuan)
    Route::get('/kelola-data-kamar/data-kamar/{jenis_kamar}', [KamarController::class, 'indexByJenis'])->name('admin.kamar.jenis');

    // ✅ Detail Kamar
    Route::get('/kelola-data-kamar/data-kamar/{jenis_kamar}/detail/{id}', [KamarController::class, 'show'])->name('admin.kamar.detail');

    // ✅ Edit Kamar
    Route::get('/kelola-data-kamar/data-kamar/{jenis_kamar}/edit/{id}', [KamarController::class, 'edit'])->name('admin.kamar.edit');
    Route::put('/kelola-data-kamar/data-kamar/{jenis_kamar}/update/{id}', [KamarController::class, 'update'])->name('admin.kamar.update');

    // ✅ Hapus Kamar
    Route::delete('/kelola-data-kamar/data-kamar/{jenis_kamar}/delete/{id}', [KamarController::class, 'destroy'])->name('admin.kamar.destroy');

    // ✅ (Opsional) Search Data Kamar
    Route::get('/search-data-kamar', [KamarController::class, 'search'])->name('admin.kamar.search');


    // ===================Data Akun=======================
    Route::get('/search-akun', [AdminController::class, 'search']);
    Route::get('/kelola-data-akun', [AdminController::class, 'kelolaAkun']);
    Route::put('/akun/{id}/approve', [AdminController::class, 'approveAkun']);
    Route::put('/akun/{id}/pending', [AdminController::class, 'pendingAkun']);
    Route::delete('/akun/{id}', [AdminController::class, 'rejectAkun']);

    // ===================Data Berkas=======================
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

    // ========================Data Penghuni========================
    Route::get('/penghuni', [PenghuniController::class, 'index']);
    Route::get('/penghuni/{id}/edit', [PenghuniController::class, 'edit']);
    Route::put('/penghuni/{id}', [PenghuniController::class, 'update']);
    Route::delete('/penghuni/{id}', [PenghuniController::class, 'destroy']);
});


Route::get('/admin/kelola-data-penghuni', function () {
    return view('admin.dataPenghuni.kelolaDataPenghuni');
});

// =======================END  ADMIN ============================

// ======================= BENDAHARA ============================
Route::middleware(['auth', RoleMiddleware::class . ':bendahara'])->group(function () {

    Route::get('/cek-pembayaran', [BendaharaPembayaranController::class, 'index'])->name('pembayaran.index');

    Route::get('/detail-pembayaran', function () {
        return view('bendahara.detailPembayaran');
    });

    Route::get('/edit-pembayaran', function () {
        return view('bendahara.editPembayaran');
    });

    Route::get('/export-pembayaran', function () {
        return view('bendahara.exportData');
    });
    Route::get('/form-pembayaran', function () {
        return view('bendahara.formPembayaran');
    });
});

// ======================= END BENDAHARA ============================
