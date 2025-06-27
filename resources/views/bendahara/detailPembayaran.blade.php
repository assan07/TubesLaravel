@extends('layouts.bendahara.app')

@section('title', 'Detail Pembayaran - Sistem Asrama Unidayan')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/js/bendahara/detailPembayaran.js') }}">

@section('main-content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h3 mb-0 text-gray-800">Detail Pembayaran</h2>
                <p class="text-muted mb-0">Informasi lengkap pembayaran kamar asrama</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('pembayaran.index') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-arrow-left me-1"></i>
                    Kembali
                </a>
            </div>
        </div>

        <div class="d-flex justify-content-center align-items-center">
            <div class="col-lg-8">

                <!-- Informasi Pembayaran -->
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Informasi Pembayaran</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="text-muted">Periode Pembayaran :</td>
                                        <td class="fw-medium">{{ $bulan }} {{ $tahun }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Tanggal Pembayaran :</td>
                                        @if ($pembayaran->tanggal_bayar)
                                            <td class="fw-medium">
                                                {{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->translatedFormat('d F Y') }}
                                            </td>
                                        @else
                                            <td class="fw-medium">
                                                -
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Metode Pembayaran :</td>
                                        <td>
                                            @if ($pembayaran->jenis_pembayaran)
                                                <span class="badge bg-primary">{{ $pembayaran->jenis_pembayaran }}</span>
                                            @else
                                                <span class="badge bg-danger">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Status Pembayaran :</td>
                                        <td>
                                            @php
                                                $status = strtolower($pembayaran->status_pembayaran);
                                                $badgeClass = match ($status) {
                                                    'lunas' => 'success',
                                                    'pending' => 'warning',
                                                    'terlambat' => 'danger',
                                                    default => 'secondary',
                                                };
                                            @endphp

                                            <span class="badge bg-{{ $badgeClass }}">
                                                <i></i>{{ ucfirst($status) }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Penghuni & Kamar -->
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Informasi Penghuni & Kamar</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-md bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-4"
                                        style="width: 60px; height: 60px; font-size: 24px;">
                                        {{ strtoupper(substr($pembayaran->nama, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h6 class="mb-1">{{ $pembayaran->nama }}</h6>
                                        <p class="text-muted mb-0">NIM : {{ $pembayaran->nim }}</p>
                                    </div>
                                </div>
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td class="text-muted">No. HP :</td>
                                        <td class="fw-medium">{{ $pembayaran->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Email :</td>
                                        <td class="fw-medium">{{ $pembayaran->email }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-light border-0">
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <i class="ti ti-home me-2"></i>{{ $pembayaran->nama_kamar }}
                                        </h6>
                                        <div class="mb-2">
                                            <small class="text-muted">Lokasi :</small>
                                            <span class="badge bg-secondary ms-1">{{ $pembayaran->lokasi_kamar }}</span>
                                        </div>
                                        <div class="mb-2">
                                            <small class="text-muted">Tarif Bulanan :</small>
                                            <span class="fw-medium text-success">Rp
                                                {{ number_format($pembayaran->harga, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>

    @push('scripts')
        <script src="{{ asset('assets/js/bendahara/detailPembayaran.js') }}"></script>
    @endpush

@endsection
