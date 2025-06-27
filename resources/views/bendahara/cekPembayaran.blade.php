@extends('layouts.bendahara.app')

@section('title', 'Informasi Pembayaran Kamar - Sistem Asrama Unidayan')

@php
    use Carbon\Carbon;

    Carbon::setLocale('id');
    $now = Carbon::now();
    $bulanOptions = [];

    for ($i = 0; $i < 4; $i++) {
        $date = Carbon::now()->subMonths($i);
        $bulanOptions[] = [
            'bulan' => strtolower($date->translatedFormat('F')), // "juni"
            'tahun' => $date->year,
            'label' => $date->translatedFormat('F Y'), // "Juni 2025"
        ];
    }

    $selectedFilter = request('filter_bulan') ?? strtolower($now->translatedFormat('F')) . '|' . $now->year;
@endphp
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
        </div>

        <!-- Filter & Search Section -->
        <form method="GET" action="{{ route('pembayaran.index') }}" id="filterForm">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-medium">Cari Penghuni/Kamar</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="ti ti-search text-muted"></i>
                                </span>
                                <input type="text" class="form-control" name="search" id="searchInput"
                                    placeholder="Masukkan nama penghuni atau kamar..." value="{{ request('search') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-medium">Filter Bulan</label>
                            <select id="filterSelect" name="filter_bulan" class="form-select">
                                @foreach ($bulanOptions as $option)
                                    @php
                                        $isSelected =
                                            request('filter_bulan') == $option['bulan'] . '|' . $option['tahun'];
                                    @endphp
                                    <option value="{{ $option['bulan'] }}|{{ $option['tahun'] }}"
                                        {{ $isSelected ? 'selected' : '' }}>
                                        {{ ucfirst($option['bulan']) }} {{ $option['tahun'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-medium">Status Pembayaran</label>
                            <select name="status_pembayaran" id="statusSelect" class="form-select">
                                @php $selectedStatus = request('status_pembayaran'); @endphp
                                <option value="" {{ $selectedStatus === null ? 'selected' : '' }}>Semua Status
                                </option>
                                <option value="lunas" {{ $selectedStatus === 'lunas' ? 'selected' : '' }}>Lunas</option>
                                <option value="pending" {{ $selectedStatus === 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="terlambat" {{ $selectedStatus === 'terlambat' ? 'selected' : '' }}>Terlambat
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>


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
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    Rp {{ number_format($statistik['total_pembayaran'], 0, ',', '.') }}
                                </div>
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
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $statistik['lunas'] }}
                                </div>
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
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $statistik['pending'] }}
                                </div>
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
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $statistik['terlambat'] }}
                                </div>
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
                        <li>
                            <a class="dropdown-item" href="{{ route('pembayaran.index') }}">
                                <i class="ti ti-refresh me-1"></i>Refresh
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('bendahara.export.excel', request()->query()) }}">
                                <i class="ti ti-file-text me-1"></i>Export Excel
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item"
                                href="{{ route('bendahara.export.pdf') }}?filter_bulan={{ request('filter_bulan') }}&search={{ request('search') }}">
                                <i class="ti ti-file-export me-1"></i>Export PDF
                            </a>
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
                            @foreach ($penghuni as $index => $row)
                                <tr>
                                    <td class="text-center">{{ $penghuni->firstItem() + $index }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2">
                                                {{ strtoupper(substr($row->nama, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="fw-medium">{{ $row->nama }}</div>
                                                <small class="text-muted">NIM : {{ $row->nim }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-medium">{{ $row->nama_kamar ?? '-' }}</div>
                                        <small class="text-muted">No: {{ $row->no_kamar ?? '-' }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            {{ $row->lokasi_kamar ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="text-end fw-bold">
                                        @if ($row->harga)
                                            Rp {{ number_format($row->harga, 0, ',', '.') }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($row->tanggal_bayar)
                                            @php
                                                $tanggal = \Carbon\Carbon::parse($row->tanggal_bayar);
                                                $jam = $row->pembayaran_created_at
                                                    ? \Carbon\Carbon::parse($row->pembayaran_created_at)
                                                    : null;
                                            @endphp
                                            <div>{{ $tanggal->translatedFormat('d M Y') }}</div>
                                            <small class="text-muted">
                                                {{ $jam ? $jam->format('H:i') . ' WITA' : '-' }}
                                            </small>
                                        @else
                                            <span class="text-muted">Belum Bayar</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $status = $row->status_final;
                                            $badgeClass = match ($status) {
                                                'lunas' => 'success',
                                                'pending' => 'warning',
                                                'terlambat' => 'danger',
                                                default => 'secondary',
                                            };
                                        @endphp
                                        <span class="badge bg-{{ $badgeClass }}">
                                            {{ ucfirst($status) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="#" class="btn btn-sm btn-outline-primary"
                                                title="Lihat Detail">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-outline-secondary" title="Edit">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Menampilkan {{ $penghuni->firstItem() }} - {{ $penghuni->lastItem() }} dari total
                    {{ $penghuni->total() }} data pembayaran
                </div>
                {{ $penghuni->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const form = document.getElementById('filterForm');
                const filterSelect = document.getElementById('filterSelect');
                const statusSelect = document.getElementById('statusSelect');
                const searchInput = document.getElementById('searchInput');

                // Submit otomatis saat bulan/status berubah
                filterSelect.addEventListener('change', () => form.submit());
                statusSelect.addEventListener('change', () => form.submit());

                // Delay pencarian agar tidak submit tiap huruf diketik
                let typingTimer;
                searchInput.addEventListener('input', () => {
                    clearTimeout(typingTimer);
                    typingTimer = setTimeout(() => {
                        form.submit();
                    }, 600); // jeda 600ms setelah selesai mengetik
                });
            });
        </script>
    @endpush

@endsection
