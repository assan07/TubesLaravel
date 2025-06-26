@extends('layouts.bendahara.app')

@section('title', 'Informasi Pembayaran Kamar - Sistem Asrama Unidayan')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/bendahara/cekPembayaran.css') }}">


@section('main-content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h3 mb-0 text-gray-800">Informasi Pembayaran Kamar</h2>
                <p class="text-muted mb-0">Kelola dan pantau pembayaran kamar asrama</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ url('/export-pembayaran') }}" class="btn btn-outline-primary btn-sm">
                    <i class="ti ti-download me-1"></i>
                    Export Data
                </a>
                <a href="{{ url('/form-pembayaran') }}" class="btn btn-primary btn-sm">
                    <i class="ti ti-plus me-1"></i>
                    Tambah Pembayaran
                </a>
            </div>
        </div>

        <!-- Filter & Search Section -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-medium">Cari Penghuni/Kamar</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="ti ti-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Masukkan nama penghuni atau kamar..."
                                id="searchInput">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-medium">Filter Lokasi</label>
                        <select class="form-select">
                            <option selected>Semua Lokasi</option>
                            <option value="L1">Lantai 1</option>
                            <option value="L2">Lantai 2</option>
                            <option value="L3">Lantai 3</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-medium">Status Pembayaran</label>
                        <select class="form-select">
                            <option selected>Semua Status</option>
                            <option value="lunas">Lunas</option>
                            <option value="pending">Pending</option>
                            <option value="overdue">Terlambat</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-medium">&nbsp;</label>
                        <div class="d-grid">
                            <button class="btn btn-primary">
                                <i class="ti ti-filter me-1"></i>
                                Filter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row g-3 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card border-left-primary shadow h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Pembayaran Bulan Ini
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp 15.250.000</div>
                            </div>
                            <div class="col-auto">
                                <i class="ti ti-currency-dollar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-left-success shadow h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Pembayaran Lunas
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">45</div>
                            </div>
                            <div class="col-auto">
                                <i class="ti ti-check-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-left-warning shadow h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pembayaran Pending
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">8</div>
                            </div>
                            <div class="col-auto">
                                <i class="ti ti-clock fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-left-danger shadow h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Pembayaran Terlambat
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">3</div>
                            </div>
                            <div class="col-auto">
                                <i class="ti ti-alert-triangle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table Section -->
        <div class="card shadow">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Pembayaran Kamar</h6>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                        data-bs-toggle="dropdown">
                        <i class="ti ti-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="ti ti-refresh me-1"></i>Refresh Data</a></li>
                        <li><a class="dropdown-item" href="#"><i class="ti ti-file-export me-1"></i>Export Excel</a>
                        </li>
                        <li><a class="dropdown-item" href="#"><i class="ti ti-file-type-pdf me-1"></i>Export PDF</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="dataTable">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 60px;">No.</th>
                                <th>Nama Penghuni</th>
                                <th>Nama Kamar</th>
                                <th>Lokasi Kamar</th>
                                <th class="text-end">Total Pembayaran</th>
                                <th class="text-center">Tanggal Pembayaran</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" style="width: 120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2">
                                            H
                                        </div>
                                        <div>
                                            <div class="fw-medium">Hasan</div>
                                            <small class="text-muted">ID: HSN001</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-medium">Kamar-A1_L</div>
                                    <small class="text-muted">Kapasitas: 2 orang</small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">L1-Sayap kiri</span>
                                </td>
                                <td class="text-end fw-bold text-success">Rp 250.000</td>
                                <td class="text-center">
                                    <div>12 Jan 2025</div>
                                    <small class="text-muted">14:30 WIB</small>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">Lunas</span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ url('/detail-pembayaran') }}" class="btn btn-sm btn-outline-primary"
                                            title="Lihat Detail">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        <a href="{{ url('#') }}" class="btn btn-sm btn-outline-success"
                                            title="Print Receipt">
                                            <i class="ti ti-printer"></i>
                                        </a>
                                        <a href="{{ url('/edit-pembayaran') }}" class="btn btn-sm btn-outline-secondary"
                                            title="Edit">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="avatar-sm bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-2">
                                            A
                                        </div>
                                        <div>
                                            <div class="fw-medium">Ahmad Rizki</div>
                                            <small class="text-muted">ID: ARZ002</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-medium">Kamar-B2_L</div>
                                    <small class="text-muted">Kapasitas: 3 orang</small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">L2-Sayap kanan</span>
                                </td>
                                <td class="text-end fw-bold text-warning">Rp 300.000</td>
                                <td class="text-center">
                                    <div>10 Jan 2025</div>
                                    <small class="text-muted">09:15 WIB</small>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-warning">Pending</span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                            title="Lihat Detail">
                                            <i class="ti ti-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-success"
                                            title="Print Receipt">
                                            <i class="ti ti-printer"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" title="Edit">
                                            <i class="ti ti-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="avatar-sm bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-2">
                                            S
                                        </div>
                                        <div>
                                            <div class="fw-medium">Siti Nurhaliza</div>
                                            <small class="text-muted">ID: SNH003</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-medium">Kamar-C1_P</div>
                                    <small class="text-muted">Kapasitas: 2 orang</small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">L1-Sayap tengah</span>
                                </td>
                                <td class="text-end fw-bold text-danger">Rp 275.000</td>
                                <td class="text-center">
                                    <div>05 Jan 2025</div>
                                    <small class="text-muted">16:45 WIB</small>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-danger">Terlambat</span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                            title="Lihat Detail">
                                            <i class="ti ti-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-success"
                                            title="Print Receipt">
                                            <i class="ti ti-printer"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" title="Edit">
                                            <i class="ti ti-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Menampilkan 1-3 dari 56 data pembayaran
                </div>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>


@endsection
