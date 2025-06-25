@extends('layouts.admin.app')

@section('title', 'Kelola Data Berkas - Sistem Asrama Unidayan')
@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/mahasiswa/informasidatakamar.css') }}"> --}}

@section('main-content')
    <div class="container-fluid">
        {{-- card info regist guy --}}
        <div class="card-info-regis-room d-flex gap-2">
            <div class="card-info-gay card w-100">
                <div class="card-header">
                    <h3 class="card-title text-center">Kelola Data Berkas Pendaftar Laki-Laki</h3>
                    <div class="card-info d-flex flex-column gap-3">
                        <div class="card-room-gay row-lg-12 col-md-12 col-sm-12 d-flex gap-3">
                            <div class="card-room bg-primary w-100 rounded d-flex flex-column align-items-center p-2">
                                <div
                                    class="sub-card bg-white w-100 rounded d-flex align-items-center justify-content-center p-2 text-center">
                                    <h1 style="font-weight: bolder">{{ $stats['laki']['total'] }}</h1>
                                </div>
                                <strong>Pendaftar Baru</strong>
                            </div>
                            <div class="card-room bg-secondary w-100 rounded d-flex flex-column align-items-center p-2">
                                <div
                                    class="sub-card bg-white w-100 rounded d-flex align-items-center justify-content-center p-2 text-center">
                                    <h1 style="font-weight: bolder">{{ $stats['laki']['approved'] }}</h1>
                                </div>
                                <strong>Terkonfimasi</strong>
                            </div>
                        </div>
                        <a href="{{ route('admin.berkas.byGender', ['gender' => 'Laki-laki']) }}"
                            class="btn btn-info w-100 ">Detail</a>
                    </div>
                </div>
            </div>
            {{-- end card info regist guy --}}

            {{-- card info regist girl --}}
            <div class="card-info-girl card  w-100">
                <div class="card-header">
                    <h3 class="card-title text-center">Kelola Data Berkas Pendaftar Perempuan</h3>
                    <div class="card-info d-flex flex-column gap-3">
                        <div class="card-room-girl row-lg-12 col-md-12 col-sm-12 d-flex gap-3">
                            <div class="card-room bg-primary w-100 rounded d-flex flex-column align-items-center p-2">
                                <div
                                    class="sub-card bg-white w-100 rounded d-flex align-items-center justify-content-center p-2 text-center">
                                    <h1 style="font-weight: bolder">{{ $stats['perempuan']['total'] }}</h1>
                                </div>
                                <strong>Pendaftar Baru</strong>
                            </div>
                            <div class="card-room bg-secondary w-100 rounded d-flex flex-column align-items-center p-2">
                                <div
                                    class="sub-card bg-white w-100 rounded d-flex align-items-center justify-content-center p-2 text-center">
                                    <h1 style="font-weight: bolder">{{ $stats['laki']['approved'] }}</h1>
                                </div>
                                <strong>Terkonfimasi</strong>
                            </div>
                        </div>
                        <a href="{{ route('admin.berkas.byGender', ['gender' => 'Perempuan']) }}"
                            class="btn btn-info w-100 ">Detail</a>
                    </div>
                </div>
            </div>
            {{-- end card info regist girl --}}
        </div>
        {{-- end card info regist --}}

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
                                                class="badge bg-{{ $item->status_berkas === 'approved'
                                                    ? 'success'
                                                    : ($item->status_berkas === 'pending'
                                                        ? 'warning text-dark'
                                                        : 'danger') }}">
                                                {{ ucfirst($item->status_berkas) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.berkas.detail', $item->id) }}"
                                                class="btn btn-sm btn-primary">
                                                Cek Berkas
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada data pendaftaran.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
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
