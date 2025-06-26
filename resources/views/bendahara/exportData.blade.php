@extends('layouts.bendahara.app')

@section('title', 'Export Data Pembayaran - Sistem Asrama Unidayan')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/bendahara/exportData.css') }}">


@section('main-content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h3 mb-0 text-gray-800">Export Data Pembayaran</h2>
                <p class="text-muted mb-0">Unduh laporan pembayaran kamar dalam berbagai format</p>
            </div>
            <a href="#" class="btn btn-outline-secondary">
                <i class="ti ti-arrow-left me-1"></i>
                Kembali
            </a>
        </div>

        <div class="row">
            <!-- Export Options -->
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Pilihan Export</h6>
                    </div>
                    <div class="card-body">
                        <form id="exportForm">
                            <!-- Export Format -->
                            <div class="mb-4">
                                <label class="form-label fw-medium">Format File</label>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <div class="card border export-option" data-format="excel">
                                            <div class="card-body text-center p-3">
                                                <i class="ti ti-file-spreadsheet text-success" style="font-size: 2rem;"></i>
                                                <h6 class="mt-2 mb-1">Excel (.xlsx)</h6>
                                                <small class="text-muted">Format tabel dengan formula</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card border export-option" data-format="pdf">
                                            <div class="card-body text-center p-3">
                                                <i class="ti ti-file-type-pdf text-danger" style="font-size: 2rem;"></i>
                                                <h6 class="mt-2 mb-1">PDF (.pdf)</h6>
                                                <small class="text-muted">Format laporan siap cetak</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card border export-option" data-format="csv">
                                            <div class="card-body text-center p-3">
                                                <i class="ti ti-file-text text-info" style="font-size: 2rem;"></i>
                                                <h6 class="mt-2 mb-1">CSV (.csv)</h6>
                                                <small class="text-muted">Format data mentah</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Date Range -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Tanggal Mulai</label>
                                    <input type="date" class="form-control" name="date_start" value="2025-01-01">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Tanggal Akhir</label>
                                    <input type="date" class="form-control" name="date_end" value="2025-01-31">
                                </div>
                            </div>

                            <!-- Filter Options -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Status Pembayaran</label>
                                    <select class="form-select" name="status">
                                        <option value="all">Semua Status</option>
                                        <option value="lunas">Lunas</option>
                                        <option value="pending">Pending</option>
                                        <option value="overdue">Terlambat</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Lokasi Kamar</label>
                                    <select class="form-select" name="location">
                                        <option value="all">Semua Lokasi</option>
                                        <option value="L1">Lantai 1</option>
                                        <option value="L2">Lantai 2</option>
                                        <option value="L3">Lantai 3</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Column Selection -->
                            <div class="mb-4">
                                <label class="form-label fw-medium">Kolom yang Akan Diekspor</label>
                                <div class="row g-2">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="columns[]"
                                                value="nama_penghuni" checked>
                                            <label class="form-check-label">Nama Penghuni</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="columns[]"
                                                value="nama_kamar" checked>
                                            <label class="form-check-label">Nama Kamar</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="columns[]"
                                                value="lokasi_kamar" checked>
                                            <label class="form-check-label">Lokasi Kamar</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="columns[]"
                                                value="total_pembayaran" checked>
                                            <label class="form-check-label">Total Pembayaran</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="columns[]"
                                                value="tanggal_pembayaran" checked>
                                            <label class="form-check-label">Tanggal Pembayaran</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="columns[]"
                                                value="status" checked>
                                            <label class="form-check-label">Status</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Export Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="ti ti-download me-2"></i>
                                    Export Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Preview & Statistics -->
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Ringkasan Data</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <h3 class="text-primary">156</h3>
                            <p class="text-muted mb-0">Total Data yang Akan Diekspor</p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Lunas:</span>
                            <span class="badge bg-success">120</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Pending:</span>
                            <span class="badge bg-warning">25</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Terlambat:</span>
                            <span class="badge bg-danger">11</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong>Total Nilai:</strong>
                            <strong class="text-success">Rp 39.000.000</strong>
                        </div>
                    </div>
                </div>

                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Riwayat Export</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-medium">Data_Pembayaran_Jan2025.xlsx</div>
                                    <small class="text-muted">25 Jan 2025, 14:30</small>
                                </div>
                                <a href="#" class="btn btn-sm btn-outline-primary">
                                    <i class="ti ti-download"></i>
                                </a>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-medium">Laporan_Pembayaran_Des2024.pdf</div>
                                    <small class="text-muted">31 Des 2024, 16:45</small>
                                </div>
                                <a href="#" class="btn btn-sm btn-outline-primary">
                                    <i class="ti ti-download"></i>
                                </a>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-medium">Export_Data_Nov2024.csv</div>
                                    <small class="text-muted">30 Nov 2024, 09:15</small>
                                </div>
                                <a href="#" class="btn btn-sm btn-outline-primary">
                                    <i class="ti ti-download"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@push('scripts')
    <script src="{{ asset('assets/js/bendahara/exportData.js') }}"></script>
@endpush

@endsection
