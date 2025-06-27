@extends('layouts.mahasiswa.app')

@section('title', 'Pendaftaran Kamar - Sistem Asrama Unidayan')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/mahasiswa/pendaftaran_kamar.css') }}">
@endsection

@section('main-content')

    <div class="container-fluid px-3 px-lg-4 py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-10">
                

                {{-- Header Card --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body text-center py-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-home text-primary fs-4"></i>
                        </div>
                        <h3 class="card-title mb-2 text-dark fw-bold">Pendaftaran Kamar Asrama</h3>
                        <p class="text-muted mb-0">Lengkapi data pendaftaran untuk mendapatkan kamar asrama</p>
                    </div>
                </div>

                {{-- Main Content --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 p-lg-5">
                        
                        @if ($pendaftaran)
                            {{-- Registration Success Section --}}
                            <div class="text-center mb-4">
                                <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 rounded-circle mb-3" style="width: 80px; height: 80px;">
                                    <i class="fas fa-check-circle text-success fs-1"></i>
                                </div>
                                <h4 class="text-success fw-bold mb-2">Pendaftaran Berhasil!</h4>
                                <p class="text-muted">Anda sudah terdaftar dalam sistem asrama. Silakan periksa kembali berkas pendaftaran Anda.</p>
                            </div>

                            {{-- Registration History Card --}}
                            <div class="card bg-light border-0 mb-4">
                                <div class="card-header bg-transparent border-0 pb-0">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="fas fa-history text-primary"></i>
                                        </div>
                                        <h5 class="mb-0 fw-bold text-dark">Riwayat Pendaftaran Kamar</h5>
                                    </div>
                                </div>
                                <div class="card-body pt-3">
                                    <div class="row g-3">
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="bg-white rounded p-3 border">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                        <i class="fas fa-user text-primary small"></i>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted d-block">Nama Lengkap</small>
                                                        <span class="fw-semibold">{{ $pendaftaran->nama }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="bg-white rounded p-3 border">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-info bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                        <i class="fas fa-id-card text-info small"></i>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted d-block">NIM</small>
                                                        <span class="fw-semibold">{{ $pendaftaran->nim }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="bg-white rounded p-3 border">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-success bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                        <i class="fas fa-envelope text-success small"></i>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted d-block">Email</small>
                                                        <span class="fw-semibold">{{ $pendaftaran->email }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="bg-white rounded p-3 border">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-warning bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                        <i class="fas fa-phone text-warning small"></i>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted d-block">No HP</small>
                                                        <span class="fw-semibold">{{ $pendaftaran->no_hp }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="bg-white rounded p-3 border">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-secondary bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                        <i class="fas fa-graduation-cap text-secondary small"></i>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted d-block">Program Studi</small>
                                                        <span class="fw-semibold">{{ $pendaftaran->prodi }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="bg-white rounded p-3 border">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-danger bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                        <i class="fas fa-venus-mars text-danger small"></i>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted d-block">Jenis Kelamin</small>
                                                        <span class="fw-semibold">{{ $pendaftaran->jenis_kelamin }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="bg-white rounded p-3 border">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-purple bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; background-color: rgba(123, 31, 162, 0.1);">
                                                        <i class="fas fa-bed text-purple small" style="color: #7b1fa2;"></i>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted d-block">Kamar</small>
                                                        <span class="fw-semibold">{{ $pendaftaran->room->nama_kamar ?? '-' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="bg-white rounded p-3 border">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-teal bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; background-color: rgba(0, 150, 136, 0.1);">
                                                        <i class="fas fa-calendar text-teal small" style="color: #009688;"></i>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted d-block">Tanggal Daftar</small>
                                                        <span class="fw-semibold">{{ \Carbon\Carbon::parse($pendaftaran->tanggal_pendaftaran)->format('d M Y') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="bg-white rounded p-3 border">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-success bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                            <i class="fas fa-file-check text-success small"></i>
                                                        </div>
                                                        <div>
                                                            <small class="text-muted d-block">Status Berkas</small>
                                                            <span class="fw-semibold">Status Pendaftaran</span>
                                                        </div>
                                                    </div>
                                                    <span class="badge fs-6 px-3 py-2 bg-{{ $pendaftaran->status_berkas == 'approved' ? 'success' : ($pendaftaran->status_berkas == 'rejected' ? 'danger' : 'warning') }}">
                                                        {{ ucfirst($pendaftaran->status_berkas) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Edit Button --}}
                                    <div class="mt-4 pt-3 border-top">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('pendaftaran-kamar.edit', $pendaftaran->id) }}" class="btn btn-warning btn-lg px-4">
                                                <i class="fas fa-edit me-2"></i>
                                                Edit Berkas Pendaftaran
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @else
                            {{-- Registration Form --}}

                            <form action="{{ route('pendaftaran-kamar.store') }}" method="POST">
                                @csrf

                                <div class="row g-4">
                                    {{-- Personal Information Section --}}
                                    <div class="col-12">
                                        <div class="card bg-light border-0">
                                            <div class="card-header bg-transparent border-0 pb-0">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                        <i class="fas fa-user text-primary"></i>
                                                    </div>
                                                    <h5 class="mb-0 fw-bold text-dark">Informasi Pribadi</h5>
                                                </div>
                                            </div>
                                            <div class="card-body pt-3">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-6">
                                                        <label for="nama" class="form-label fw-semibold">
                                                            Nama Lengkap <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="input-group">
                                                            <span class="input-group-text bg-light border-end-0">
                                                                <i class="fas fa-user text-muted"></i>
                                                            </span>
                                                            <input type="text" class="form-control border-start-0 @error('nama') is-invalid @enderror"
                                                                id="nama" name="nama" value="{{ old('nama', $user->nama) }}" placeholder="Masukkan nama lengkap">
                                                        </div>
                                                        @error('nama')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-12 col-md-6">
                                                        <label for="nim" class="form-label fw-semibold">
                                                            NIM <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="input-group">
                                                            <span class="input-group-text bg-light border-end-0">
                                                                <i class="fas fa-id-card text-muted"></i>
                                                            </span>
                                                            <input type="text" class="form-control border-start-0 @error('nim') is-invalid @enderror"
                                                                id="nim" name="nim" value="{{ old('nim', $user->nim) }}" placeholder="Masukkan NIM">
                                                        </div>
                                                        @error('nim')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-12 col-md-6">
                                                        <label for="email" class="form-label fw-semibold">
                                                            Email <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="input-group">
                                                            <span class="input-group-text bg-light border-end-0">
                                                                <i class="fas fa-envelope text-muted"></i>
                                                            </span>
                                                            <input type="email" class="form-control border-start-0 @error('email') is-invalid @enderror"
                                                                id="email" name="email" value="{{ old('email', $user->email ?? '') }}" placeholder="Masukkan email">
                                                        </div>
                                                        @error('email')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-12 col-md-6">
                                                        <label for="noHp" class="form-label fw-semibold">
                                                            No. HP <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="input-group">
                                                            <span class="input-group-text bg-light border-end-0">
                                                                <i class="fas fa-phone text-muted"></i>
                                                            </span>
                                                            <input type="text" class="form-control border-start-0 @error('no_hp') is-invalid @enderror"
                                                                id="noHp" name="no_hp" value="{{ old('no_hp', $user->mahasiswa->phone ?? '') }}" placeholder="Masukkan nomor HP">
                                                        </div>
                                                        @error('no_hp')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-12 col-md-6">
                                                        <label for="prodi" class="form-label fw-semibold">
                                                            Program Studi <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="input-group">
                                                            <span class="input-group-text bg-light border-end-0">
                                                                <i class="fas fa-graduation-cap text-muted"></i>
                                                            </span>
                                                            <input type="text" class="form-control border-start-0 @error('prodi') is-invalid @enderror"
                                                                id="prodi" name="prodi" value="{{ old('prodi', $user->mahasiswa->prodi ?? '') }}" placeholder="Masukkan program studi">
                                                        </div>
                                                        @error('prodi')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-12 col-md-6">
                                                        <label for="jenis_kelamin" class="form-label fw-semibold">
                                                            Jenis Kelamin <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="input-group">
                                                            <span class="input-group-text bg-light border-end-0">
                                                                <i class="fas fa-venus-mars text-muted"></i>
                                                            </span>
                                                            <select class="form-select border-start-0 @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin">
                                                                <option value="">Pilih Jenis Kelamin</option>
                                                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                            </select>
                                                        </div>
                                                        @error('jenis_kelamin')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Room Selection Section --}}
                                    <div class="col-12">
                                        <div class="card bg-light border-0">
                                            <div class="card-header bg-transparent border-0 pb-0">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-success bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                        <i class="fas fa-bed text-success"></i>
                                                    </div>
                                                    <h5 class="mb-0 fw-bold text-dark">Pilihan Kamar & Tanggal</h5>
                                                </div>
                                            </div>
                                            <div class="card-body pt-3">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-6">
                                                        <label for="kamar" class="form-label fw-semibold">
                                                            Pilih Kamar <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="input-group">
                                                            <span class="input-group-text bg-light border-end-0">
                                                                <i class="fas fa-bed text-muted"></i>
                                                            </span>
                                                            <select class="form-select border-start-0 @error('kamar') is-invalid @enderror" id="kamar" name="kamar">
                                                                <option value="">Pilih Kamar</option>
                                                                @foreach ($rooms as $room)
                                                                    <option value="{{ $room->id }}" {{ old('kamar') == $room->id ? 'selected' : '' }}>
                                                                        {{ $room->nama_kamar }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-text">
                                                            <i class="fas fa-info-circle me-1"></i>
                                                            <strong>Note:</strong> Kode "L" / "P" diakhir nama kamar sebagai tanda jenis kamar.
                                                        </div>
                                                        @error('kamar')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-12 col-md-6">
                                                        <label for="tanggal_pendaftaran" class="form-label fw-semibold">
                                                            Tanggal Pendaftaran <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="input-group">
                                                            <span class="input-group-text bg-light border-end-0">
                                                                <i class="fas fa-calendar text-muted"></i>
                                                            </span>
                                                            <input type="date" class="form-control border-start-0 @error('tanggal_pendaftaran') is-invalid @enderror"
                                                                id="tanggal_pendaftaran" name="tanggal_pendaftaran" value="{{ old('tanggal_pendaftaran') }}">
                                                        </div>
                                                        @error('tanggal_pendaftaran')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Submit Button --}}
                                    <div class="col-12">
                                        <div class="text-center pt-3">
                                            <button type="submit" class="btn btn-primary btn-lg px-5 py-3">
                                                <i class="fas fa-paper-plane me-2"></i>
                                                Daftar Sekarang
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
