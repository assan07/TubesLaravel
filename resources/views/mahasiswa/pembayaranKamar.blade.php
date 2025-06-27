@extends('layouts.mahasiswa.app')

@section('title', 'Pembayaran Kamar - Sistem Asrama Unidayan')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/mahasiswa/pembayaran_kamar.css') }}">
@section('main-content')

    <div class="container-fluid px-3 px-lg-4 py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-10">

                {{-- Breadcrumb --}}
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb bg-light rounded px-3 py-2">
                        <li class="breadcrumb-item active" aria-current="page">Pembayaran Kamar</li>
                    </ol>
                </nav>

                {{-- Header Card --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body text-center py-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle mb-3"
                            style="width: 60px; height: 60px;">
                            <i class="fas fa-credit-card text-primary fs-4"></i>
                        </div>
                        <h3 class="card-title mb-2 text-dark fw-bold">Pembayaran Kamar Asrama</h3>
                        <p class="text-muted mb-0">Silakan lakukan pembayaran sesuai dengan periode yang dipilih</p>
                    </div>
                </div>

                {{-- Main Payment Form --}}
                <form action="{{ url('/pembayaran-kamar/payment') }}" method="POST">
                    @csrf

                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 p-lg-5">

                            {{-- Profile Section --}}
                            <div class="row g-4 mb-5">
                                <div class="col-12 col-lg-4">
                                    <div class="text-center">
                                        <div class="position-relative d-inline-block mb-3">
                                            @if ($mahasiswa && $mahasiswa->foto)
                                                <img src="{{ asset('storage/' . $mahasiswa->foto) }}"
                                                    class="rounded-circle border border-3 border-light shadow"
                                                    style="width: 120px; height: 120px; object-fit: cover;"
                                                    alt="Foto Mahasiswa">
                                            @else
                                                <img src="{{ asset('assets/images/profile/user-1.jpg') }}"
                                                    class="rounded-circle border border-3 border-light shadow"
                                                    style="width: 120px; height: 120px; object-fit: cover;"
                                                    alt="Foto Default">
                                            @endif
                                            <span
                                                class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-2 border-white"
                                                style="width: 24px; height: 24px;"></span>
                                        </div>
                                        <h6 class="text-muted mb-0">Profil Mahasiswa</h6>
                                    </div>
                                </div>

                                {{-- Student Information --}}
                                <div class="col-12 col-lg-8">
                                    <div class="row g-3">
                                        <div class="col-12 col-sm-6">
                                            <div class="bg-light rounded p-3 h-100">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center"
                                                        style="width: 40px; height: 40px;">
                                                        <i class="fas fa-user text-primary"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <small class="text-muted d-block">Nama Lengkap</small>
                                                        <span class="fw-semibold">{{ $user->nama }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="bg-light rounded p-3 h-100">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-success bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center"
                                                        style="width: 40px; height: 40px;">
                                                        <i class="fas fa-envelope text-success"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <small class="text-muted d-block">Email</small>
                                                        <span class="fw-semibold">{{ $user->email }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="bg-light rounded p-3 h-100">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-info bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center"
                                                        style="width: 40px; height: 40px;">
                                                        <i class="fas fa-id-card text-info"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <small class="text-muted d-block">NIM</small>
                                                        <span class="fw-semibold">{{ $user->nim }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="bg-light rounded p-3 h-100">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-warning bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center"
                                                        style="width: 40px; height: 40px;">
                                                        <i class="fas fa-phone text-warning"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <small class="text-muted d-block">No. HP</small>
                                                        <span class="fw-semibold">{{ $mahasiswa->phone ?? '-' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            {{-- Room & Payment Details --}}
                            <div class="row g-4">
                                <div class="col-12 col-lg-6">
                                    <div class="card bg-primary bg-opacity-5 border-primary border-opacity-25 h-100">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="bg-primary rounded-circle me-3 d-flex align-items-center justify-content-center"
                                                    style="width: 50px; height: 50px;">
                                                    <i class="fas fa-bed text-white fs-5"></i>
                                                </div>
                                                <h5 class="card-title mb-0 text-primary">Detail Kamar</h5>
                                            </div>

                                            <div class="mb-3">
                                                <small class="text-muted d-block mb-1">Nama Kamar</small>
                                                <h6 class="fw-bold mb-0">
                                                    {{ optional($pendaftaran->room)->nama_kamar ?? '-' }}</h6>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between">
                                                <small class="text-muted">Harga per Bulan</small>
                                                <span class="badge bg-primary fs-6 px-3 py-2">
                                                    Rp {{ number_format($harga, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="card bg-success bg-opacity-5 border-success border-opacity-25 h-100">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-4">
                                                <div class="bg-success rounded-circle me-3 d-flex align-items-center justify-content-center"
                                                    style="width: 50px; height: 50px;">
                                                    <i class="fas fa-calendar-alt text-white fs-5"></i>
                                                </div>
                                                <h5 class="card-title mb-0 text-success">Pilih Periode</h5>
                                            </div>

                                            <div class="mb-3">
                                                <label for="bulan" class="form-label fw-semibold text-dark">
                                                    Bulan Pembayaran <span class="text-danger">*</span>
                                                </label>
                                                <select class="form-select form-select-lg border-2" id="bulan"
                                                    name="bulan" required>
                                                    <option value="" disabled selected>-- Pilih Bulan Pembayaran --
                                                    </option>
                                                    @foreach ($bulanList as $bulan)
                                                        <option value="{{ $bulan }}">{{ ucfirst($bulan) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="form-text">
                                                    <i class="fas fa-info-circle me-1"></i>
                                                    Pilih bulan yang ingin dibayarkan
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Payment Summary --}}
                            <div class="mt-4 p-4 bg-light rounded">
                                <div class="row align-items-center">
                                    <div class="col-12 col-md-8">
                                        <h6 class="mb-2 fw-bold">Ringkasan Pembayaran</h6>
                                        <p class="text-muted mb-0 small">
                                            <i class="fas fa-shield-alt me-1 text-success"></i>
                                            Pembayaran aman dan terenkripsi
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-4 text-md-end mt-3 mt-md-0">
                                        <div class="d-flex flex-column flex-md-block align-items-start align-items-md-end">
                                            <small class="text-muted">Total Pembayaran</small>
                                            <h4 class="text-primary fw-bold mb-0">
                                                Rp {{ number_format($harga, 0, ',', '.') }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="row mt-4 pt-3 border-top">
                                <div class="col-12">
                                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-end">
                                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-lg px-4">
                                            <i class="fas fa-arrow-left me-2"></i>
                                            Kembali
                                        </a>
                                        <button type="submit" class="btn btn-primary btn-lg px-5">
                                            <i class="fas fa-credit-card me-2"></i>
                                            Bayar Sekarang
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                {{-- End Form --}}
            </div>
        </div>
    </div>

@endsection
