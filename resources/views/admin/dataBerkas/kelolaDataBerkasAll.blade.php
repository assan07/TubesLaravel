@extends('layouts.admin.app')

@section('title', 'Kelola Data Berkas - Sistem Asrama Unidayan')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/admin/kelolaDataBerkas.css') }}">

@section('main-content')
    <div class="container-fluid">
        <div class="container card-container d-flex justify-content-between p-3 m-auto w-100 gap-2">
            <!-- Card Pendaftar Laki-Laki -->
            <div class="card shadow-sm w-100">
                <div class="card-header text-center text-white">
                    <h5 class="mb-0">Kelola Data Berkas Pendaftar Laki-Laki</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <!-- Total -->
                        <div class="col-md-6">
                            <div class="stat-card border-left-primary">
                                <div class="text-xs fw-bold text-primary text-uppercase mb-1">Total</div>
                                <div class="h5 mb-0 fw-bold text-secondary">{{ $stats['laki']['total'] }}</div>
                            </div>
                        </div>
                        <!-- Approved -->
                        <div class="col-md-6">
                            <div class="stat-card border-left-info">
                                <div class="text-xs fw-bold text-info text-uppercase mb-1">Terkonfirmasi</div>
                                <div class="h5 mb-0 fw-bold text-secondary">{{ $stats['laki']['approved'] }}</div>
                            </div>
                        </div>
                    </div>
                    <!-- Tombol Detail -->
                    <a href="{{ route('admin.berkas.byGender', ['gender' => 'Laki-laki']) }}"
                        class="btn btn-outline-info w-100 mt-3">Detail</a>
                </div>
            </div>

            <!-- Card Pendaftar Perempuan -->
            <div class="card shadow-sm w-100">
                <div class="card-header text-center text-white">
                    <h5 class="mb-0">Kelola Data Berkas Pendaftar Perempuan</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <!-- Total -->
                        <div class="col-md-6">
                            <div class="stat-card border-left-primary">
                                <div class="text-xs fw-bold text-primary text-uppercase mb-1">Total</div>
                                <div class="h5 mb-0 fw-bold text-secondary">{{ $stats['perempuan']['total'] }}</div>
                            </div>
                        </div>
                        <!-- Approved -->
                        <div class="col-md-6">
                            <div class="stat-card border-left-info">
                                <div class="text-xs fw-bold text-info text-uppercase mb-1">Terkonfirmasi</div>
                                <div class="h5 mb-0 fw-bold text-secondary">{{ $stats['perempuan']['approved'] }}</div>
                            </div>
                        </div>
                    </div>
                    <!-- Tombol Detail -->
                    <a href="{{ route('admin.berkas.byGender', ['gender' => 'Perempuan']) }}"
                        class="btn btn-outline-primary w-100 mt-3">Detail</a>
                </div>
            </div>
        </div>

        {{-- Tabel Data Berkas --}}
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title mb-3">Data Pendaftar Terbaru</h5>
                <div class="table-responsive">
                    <table id="dataBerkas" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>No. Handphone</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Pendaftaran</th>
                                <th>Status Berkas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latest as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->no_hp }}</td>
                                    <td>{{ $item->jenis_kelamin }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pendaftaran)->translatedFormat('d M Y') }}
                                    </td>
                                    <td>
                                        <span
                                            class="badge bg-{{ $item->status_berkas === 'approved' ? 'success' : ($item->status_berkas === 'pending' ? 'warning text-dark' : 'danger') }}">
                                            {{ ucfirst($item->status_berkas) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.berkas.detail', $item->id) }}"
                                            class=""><i class="ti ti-eye" title="cek berkas" style="font-size: 1rem"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada data pendaftaran.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    @endpush

@endsection
