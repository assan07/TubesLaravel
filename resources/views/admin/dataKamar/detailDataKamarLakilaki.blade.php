@extends('layouts.admin.app')

@section('title', 'Informasi Data Kamar Laki-Laki - Sistem Asrama Unidayan')
@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/admin/informasidatakamar.css') }}"> --}}

@section('main-content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Detail Kamar</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-5 fw-bold">Nama Kamar</div>
                            <div class="col-7">: {{ $kamar->nama_kamar }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5 fw-bold">No. Kamar</div>
                            <div class="col-7">: {{ $kamar->no_kamar }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5 fw-bold">Lokasi</div>
                            <div class="col-7">: {{ $kamar->lokasi_kamar }}</div>
                        </div>

                        {{-- Status: Tersedia --}}
                        <div class="row mb-3">
                            <div class="col-5 fw-bold">Tersedia</div>
                            <div class="col-7">:
                                @if ($kamar->status == 'tersedia')
                                    <span class="text-success">✔ Ya</span>
                                @else
                                    <span class="text-danger">✘ Tidak</span>
                                @endif
                            </div>
                        </div>

                        {{-- Status: Diisi --}}
                        <div class="row mb-3">
                            <div class="col-5 fw-bold">Diisi</div>
                            <div class="col-7">:
                                @if ($kamar->status == 'diisi')
                                    <span class="text-success">✔ Ya</span>
                                @else
                                    <span class="text-danger">✘ Tidak</span>
                                @endif
                            </div>
                        </div>

                        {{-- Status: Maintenance --}}
                        <div class="row mb-4">
                            <div class="col-5 fw-bold">Maintenance</div>
                            <div class="col-7">:
                                @if ($kamar->status == 'maintenance')
                                    <span class="text-success">✔ Ya</span>
                                @else
                                    <span class="text-danger">✘ Tidak</span>
                                @endif
                            </div>
                        </div>

                        <a href="{{ url('kelola-data-kamar/data-kamar/laki-laki') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
