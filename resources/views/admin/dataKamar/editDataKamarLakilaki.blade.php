@extends('layouts.admin.app')

@section('title', 'Informasi Data Kamar Laki-Laki - Sistem Asrama Unidayan')
@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/admin/informasidatakamar.css') }}"> --}}

@section('main-content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0">Edit Data Kamar</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/kelola-data-kamar/data-kamar/laki-laki/update', $kamar->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Nama Kamar</label>
                                <input type="text" class="form-control" name="nama_kamar"
                                    value="{{ $kamar->nama_kamar }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">No. Kamar</label>
                                <input type="text" class="form-control" name="no_kamar" value="{{ $kamar->no_kamar }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Lokasi</label>
                                <input type="text" class="form-control" name="lokasi_kamar"
                                    value="{{ $kamar->lokasi_kamar }}" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Status</label>
                                <select class="form-control" name="status" required>
                                    <option value="tersedia" {{ $kamar->status == 'tersedia' ? 'selected' : '' }}>Tersedia
                                    </option>
                                    <option value="diisi" {{ $kamar->status == 'diisi' ? 'selected' : '' }}>Diisi</option>
                                    <option value="maintenance" {{ $kamar->status == 'maintenance' ? 'selected' : '' }}>
                                        Maintenance</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ url('kelola-data-kamar/data-kamar/laki-laki') }}" class="btn btn-secondary">Kembali</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
