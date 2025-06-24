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
                                    <h1 style="font-weight: bolder">40</h1>
                                </div>
                                <strong>Pendaftar Baru</strong>
                            </div>
                            <div class="card-room bg-secondary w-100 rounded d-flex flex-column align-items-center p-2">
                                <div
                                    class="sub-card bg-white w-100 rounded d-flex align-items-center justify-content-center p-2 text-center">
                                    <h1 style="font-weight: bolder">21</h1>
                                </div>
                                <strong>Terkonfimasi</strong>
                            </div>
                        </div>
                        <a href="{{ route('admin.berkas.laki') }}" class="btn btn-info w-100 ">Detail</a>
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
                                    <h1 style="font-weight: bolder">40</h1>
                                </div>
                                <strong>Pendaftar Baru</strong>
                            </div>
                            <div class="card-room bg-secondary w-100 rounded d-flex flex-column align-items-center p-2">
                                <div
                                    class="sub-card bg-white w-100 rounded d-flex align-items-center justify-content-center p-2 text-center">
                                    <h1 style="font-weight: bolder">21</h1>
                                </div>
                                <strong>Terkonfimasi</strong>
                            </div>
                        </div>
                        <a href="/admin/kelola-berkas-pendaftran/perempuan" class="btn btn-info w-100 ">Detail</a>
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
                                <tr>
                                    <td>1</td>
                                    <td>Hasan</td>
                                    <td>22650062</td>
                                    <td>Laki-Laki</td>
                                    <td>12 Juni 2025</td>
                                    <td>
                                        <span class="badge bg-success btn-sm">Approve</span>
                                    <td>
                                        <a href="{{ url('/admin/kelola-berkas-pendaftran/laki-laki/detail') }}" class="btn btn-primary btn-sm">Cek Berkas</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Siti</td>
                                    <td>22650063</td>
                                    <td>Perempuan</td>
                                    <td>12 Juli 2025</td>
                                    <td>
                                        <span class="badge bg-warning btn-sm">Pendding</span>
                                    <td>
                                        <a href="{{ url('/admin/kelola-berkas-pendaftran/perempuan/detail') }}" class="btn btn-primary btn-sm">Cek Berkas</a>
                                    </td>
                                </tr>

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
