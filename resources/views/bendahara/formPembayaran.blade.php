@extends('layouts.bendahara.app')

@section('title', 'Tambah Pembayaran - Sistem Asrama Unidayan')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/bendahara/formPembayaran.css') }}">

@section('main-content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h3 mb-0 text-gray-800">Tambah Pembayaran Baru</h2>
                <p class="text-muted mb-0">Input data pembayaran kamar asrama</p>
            </div>
            <a href="{{ url('/cek-pembayaran') }}" class="btn btn-outline-secondary">
                <i class="ti ti-arrow-left me-1"></i>
                Kembali
            </a>
        </div>

        <div class="row">
            <!-- Form Input -->
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Informasi Pembayaran</h6>
                    </div>
                    <div class="card-body">
                        <form id="paymentForm">
                            <!-- Penghuni Selection -->
                            <div class="mb-4">
                                <label class="form-label fw-medium">Pilih Penghuni <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ti ti-user"></i>
                                    </span>
                                    <select class="form-select" name="penghuni_id" required>
                                        <option value="">-- Pilih Penghuni --</option>
                                        <option value="1">Hasan (HSN001) - Kamar A1_L</option>
                                        <option value="2">Ahmad Rizki (ARZ002) - Kamar B2_L</option>
                                        <option value="3">Siti Nurhaliza (SNH003) - Kamar C1_P</option>
                                        <option value="4">Muhammad Ali (MAL004) - Kamar D3_L</option>
                                    </select>
                                </div>
                                <small class="text-muted">Pilih penghuni yang akan melakukan pembayaran</small>
                            </div>

                            <!-- Kamar Info (Auto-filled) -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Nama Kamar</label>
                                    <input type="text" class="form-control" name="nama_kamar" readonly
                                        placeholder="Akan terisi otomatis">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Lokasi Kamar</label>
                                    <input type="text" class="form-control" name="lokasi_kamar" readonly
                                        placeholder="Akan terisi otomatis">
                                </div>
                            </div>

                            <!-- Payment Details -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Periode Pembayaran <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" name="periode" required>
                                        <option value="">-- Pilih Periode --</option>
                                        <option value="2025-01">Januari 2025</option>
                                        <option value="2025-02">Februari 2025</option>
                                        <option value="2025-03">Maret 2025</option>
                                        <option value="2025-04">April 2025</option>
                                        <option value="2025-05">Mei 2025</option>
                                        <option value="2025-06">Juni 2025</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Total Pembayaran <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="total_pembayaran" placeholder="0"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Method -->
                            <div class="mb-4">
                                <label class="form-label fw-medium">Metode Pembayaran <span
                                        class="text-danger">*</span></label>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <div class="card border payment-method" data-method="cash">
                                            <div class="card-body text-center p-3">
                                                <i class="ti ti-cash text-success" style="font-size: 2rem;"></i>
                                                <h6 class="mt-2 mb-0">Tunai</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card border payment-method" data-method="transfer">
                                            <div class="card-body text-center p-3">
                                                <i class="ti ti-credit-card text-primary" style="font-size: 2rem;"></i>
                                                <h6 class="mt-2 mb-0">Transfer Bank</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card border payment-method" data-method="ewallet">
                                            <div class="card-body text-center p-3">
                                                <i class="ti ti-device-mobile text-warning" style="font-size: 2rem;"></i>
                                                <h6 class="mt-2 mb-0">E-Wallet</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Transfer Details (Hidden by default) -->
                            <div id="transferDetails" class="mb-4" style="display: none;">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title">Detail Transfer Bank</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Bank Tujuan</label>
                                                <select class="form-select" name="bank_tujuan">
                                                    <option value="">-- Pilih Bank --</option>
                                                    <option value="BRI">Bank BRI</option>
                                                    <option value="BCA">Bank BCA</option>
                                                    <option value="BNI">Bank BNI</option>
                                                    <option value="Mandiri">Bank Mandiri</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Nomor Rekening</label>
                                                <input type="text" class="form-control" name="no_rekening"
                                                    placeholder="Masukkan nomor rekening">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Upload Bukti Pembayaran -->
                            <div class="mb-4">
                                <label class="form-label fw-medium">Bukti Pembayaran</label>
                                <div class="border-dashed border-2 border-secondary rounded p-4 text-center">
                                    <i class="ti ti-cloud-upload" style="font-size: 3rem; color: #6c757d;"></i>
                                    <p class="mt-2">Drag & drop file atau <a href="#" class="text-primary">pilih
                                            file</a></p>
                                    <input type="file" class="form-control d-none" name="bukti_pembayaran"
                                        accept="image/*,.pdf">
                                    <small class="text-muted">Maksimal 5MB (JPG, PNG, PDF)</small>
                                </div>
                            </div>

                            <!-- Tanggal Pembayaran -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Tanggal Pembayaran <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="tanggal_pembayaran" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Waktu Pembayaran</label>
                                    <input type="time" class="form-control" name="waktu_pembayaran">
                                </div>
                            </div>

                            <!-- Keterangan -->
                            <div class="mb-4">
                                <label class="form-label fw-medium">Keterangan</label>
                                <textarea class="form-control" name="keterangan" rows="3" placeholder="Tambahkan keterangan (opsional)"></textarea>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-device-floppy me-1"></i>
                                    Simpan Pembayaran
                                </button>
                                <button type="button" class="btn btn-success" onclick="submitAndPrint()">
                                    <i class="ti ti-printer me-1"></i>
                                    Simpan & Cetak
                                </button>
                                <button type="reset" class="btn btn-outline-secondary">
                                    <i class="ti ti-refresh me-1"></i>
                                    Reset Form
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Summary & Info -->
            <div class="col-lg-4">
                <!-- Calculator -->
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Kalkulator Pembayaran</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Tarif Dasar Kamar</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="tarifDasar" placeholder="250000">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Biaya Tambahan</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="biayaTambahan" placeholder="0">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Diskon</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="diskon" placeholder="0">
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong>Total:</strong>
                            <strong class="text-primary" id="totalCalculated">Rp 0</strong>
                        </div>
                        <button class="btn btn-sm btn-outline-primary w-100 mt-2" onclick="applyCalculation()">
                            Terapkan ke Form
                        </button>
                    </div>
                </div>

                <!-- Payment Info -->
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Informasi Rekening</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <small class="text-muted">Bank BRI</small>
                            <div class="fw-bold">1234-5678-9012-3456</div>
                            <div>a.n. Bendahara Asrama Unidayan</div>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted">Bank BCA</small>
                            <div class="fw-bold">9876-5432-1098-7654</div>
                            <div>a.n. Bendahara Asrama Unidayan</div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Statistik Hari Ini</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Pembayaran Masuk:</span>
                            <span class="badge bg-success">12</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total Nilai:</span>
                            <span class="fw-bold text-success">Rp 3.200.000</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Rata-rata:</span>
                            <span>Rp 266.667</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('assets/js/bendahara/formPembayaran.js') }}"></script>
    @endpush

@endsection
