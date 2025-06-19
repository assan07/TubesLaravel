@extends('layouts.admin.app')

@section('title', 'Data Berkas Perempuan - Sistem Asrama Unidayan')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/admin/kelolaDataBerkasPerempuan.css') }}">

@section('main-content')
    <div class="container-fluid">
        <div class="col-12 col-md-10 col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Detail Berkas Pendaftaran Laki-Laki</h4>

                    <div class="info-row">
                        <div class="info-label">Nama Lengkap</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">Siti</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">NIM</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">123456789</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Jenis Kelamin</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">Perempuan</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">No. Handphone</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">08123456789</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">No. Kamar</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">A14</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Tanggal Pendaftaran</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">2025-10-23</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Total Bayar</div>
                        <div class="info-separator">:</div>
                        <div class="info-value text-warning">-</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Status Berkas</div>
                        <div class="info-separator">:</div>
                        <div class="info-value text-warning">Pendding</div>
                    </div>

                    <div class="btn-action d-flex justify-content-between">
                        <div class="mt-4 d-flex flex-wrap gap-2">
                            <button type="button" class="btn btn-success btn-sm">Approve</button>
                            <button type="button" class="btn btn-warning btn-sm">Pending</button>
                            <button type="button" class="btn btn-danger btn-sm">Tolak</button>
                        </div>
                        <div class="mt-4 d-flex flex-wrap gap-2">
                            <a href="{{ url('/admin/kelola-berkas-pendaftran/perempuan') }}"
                                class="btn btn-info btn-sm">Back</a>
                            <a href="#" class="btn btn-secondary btn-sm">Download</a>
                        </div>
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
