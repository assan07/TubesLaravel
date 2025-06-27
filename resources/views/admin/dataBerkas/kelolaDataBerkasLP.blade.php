@extends('layouts.admin.app')

@section('title', 'Kelola Data Berkas - Sistem Asrama Unidayan')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/admin/informasidataberkasLP.css') }}">

@section('main-content')
    <div class="container-fluid">
        {{-- Card Info Regist --}}
        <div class="card-info-regis-room">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary text-center">
                        Kelola Data Berkas Pendaftar {{ $gender }}
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- Card Pendaftar Baru --}}
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Pendaftar Baru
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $stats['total'] }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End Card Pendaftar Baru --}}

                        {{-- Card Pendaftar Terkonfirmasi --}}
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Terkonfirmasi
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $stats['approved'] }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End Card Pendaftar Terkonfirmasi --}}

                        {{-- Card Pendaftar Pending --}}
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $stats['pending'] }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End Card Pendaftar Pending --}}

                        {{-- Card Pendaftar Rejected --}}
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Rejected
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $stats['rejected'] }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End Card Pendaftar Rejected --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- End Card Info Regist --}}

        {{-- table data berkas --}}

        {{-- 5 Data terbaru --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
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
                                @foreach ($pendaftars as $no => $item)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->no_hp }}</td>
                                        <td>{{ $item->jenis_kelamin }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_pendaftaran)->translatedFormat('d F Y') }}
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $item->status_berkas == 'approved' ? 'success' : ($item->status_berkas == 'pending' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($item->status_berkas) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.berkas.detail', $item->id) }}"
                                                class="btn btn-primary btn-sm">Cek Berkas</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{-- end table data berkas  --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Push JS --}}
    @push('scripts')
        {{-- <script src="{{ asset('assets/js/mahasiswa/login_mahasiswa.js') }}"></script> --}}
    @endpush

@endsection
