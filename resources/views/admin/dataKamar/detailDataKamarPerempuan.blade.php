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
                            <div class="col-7">: Kamar A</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5 fw-bold">No. Kamar</div>
                            <div class="col-7">: A21</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5 fw-bold">Lokasi</div>
                            <div class="col-7">: L-3 Sayap Kanan</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5 fw-bold">Tersedia</div>
                            <div class="col-7">: <span class="text-success">✔ Ya</span></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5 fw-bold">Diisi</div>
                            <div class="col-7">: <span class="text-success">✔ Ya</span></div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-5 fw-bold">Maintenance</div>
                            <div class="col-7">:<span class="text-danger">✘ Tidak</span></div>
                        </div>

                        <a href="{{ url('admin/kelola-data-kamar/data-kamar/perempuan') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
