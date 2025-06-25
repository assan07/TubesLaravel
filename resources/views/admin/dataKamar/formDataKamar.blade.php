@extends('layouts.admin.app')

@section('title', isset($kamar) ? 'Edit Data Kamar - Sistem Asrama Unidayan' : 'Tambah Data Kamar - Sistem Asrama
    Unidayan')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/admin/informasidatakamar.css') }}">
@endsection

@section('main-content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card shadow">
                    <div class="card-header {{ isset($kamar) ? 'bg-warning text-dark' : 'bg-primary text-white' }}">
                        <h5 class="mb-0">{{ isset($kamar) ? 'Edit Data Kamar' : 'Form Input Kamar' }}</h5>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ isset($kamar)
                                ? url('/kelola-data-kamar/data-kamar/' . $kamar->jenis_kamar . '/update/' . $kamar->id)
                                : url('/kelola-data-kamar/tambah-kamar/store') }}"
                            method="POST">
                            @csrf
                            @if (isset($kamar))
                                @method('PUT')
                            @endif

                            {{-- Jenis Kamar --}}
                            <div class="mb-3">
                                <label for="jenis_kamar" class="form-label">Jenis Kamar</label>
                                <select class="form-select" name="jenis_kamar" id="jenis_kamar" required
                                    {{ isset($kamar) ? 'disabled' : '' }}>
                                    <option value="">-- Pilih Jenis Kamar --</option>
                                    <option value="laki-laki"
                                        {{ old('jenis_kamar', $kamar->jenis_kamar ?? '') == 'laki-laki' ? 'selected' : '' }}>
                                        Laki-Laki</option>
                                    <option value="perempuan"
                                        {{ old('jenis_kamar', $kamar->jenis_kamar ?? '') == 'perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                @if (isset($kamar))
                                    <input type="hidden" name="jenis_kamar" value="{{ $kamar->jenis_kamar }}">
                                @endif
                            </div>

                            {{-- Nama Kamar --}}
                            <div class="mb-3">
                                <label for="nama_kamar" class="form-label">Nama Kamar</label>
                                <input type="text" class="form-control" id="nama_kamar" name="nama_kamar"
                                    value="{{ old('nama_kamar', $kamar->nama_kamar ?? '') }}"
                                    placeholder="Contoh: Kamar-A1-L" required>
                                <span class="fw-light" style="font-size: 11px">
                                    <strong>Note: </strong>Beri kode "L" / "P" diakhir nama kamar sebagai tanda jenis kamar.
                                </span>
                            </div>

                            {{-- No. Kamar --}}
                            <div class="mb-3">
                                <label for="no_kamar" class="form-label">Nomor Kamar</label>
                                <input type="text" class="form-control" id="no_kamar" name="no_kamar"
                                    value="{{ old('no_kamar', $kamar->no_kamar ?? '') }}" placeholder="Contoh: A12"
                                    required>
                            </div>

                            {{-- Lokasi Kamar --}}
                            <div class="mb-3">
                                <label for="lokasi_kamar" class="form-label">Lokasi Kamar</label>
                                <input type="text" class="form-control" id="lokasi_kamar" name="lokasi_kamar"
                                    value="{{ old('lokasi_kamar', $kamar->lokasi_kamar ?? '') }}"
                                    placeholder="Contoh: Lantai 1 / Sayap Timur" required>
                            </div>

                            {{-- Harga Kamar --}}
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga Kamar</label>
                                <input type="text" class="form-control" id="harga" name="harga"
                                    value="{{ old('harga', $kamar->harga ?? '') }}" placeholder="250000" required>
                            </div>

                            {{-- Status --}}
                            <div class="mb-3">
                                <label for="status" class="form-label">Status Kamar</label>
                                <select class="form-select" name="status" id="status" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="tersedia"
                                        {{ old('status', $kamar->status ?? '') == 'tersedia' ? 'selected' : '' }}>
                                        Tersedia</option>
                                    <option value="diisi"
                                        {{ old('status', $kamar->status ?? '') == 'diisi' ? 'selected' : '' }}>Diisi
                                    </option>
                                    <option value="maintenance"
                                        {{ old('status', $kamar->status ?? '') == 'maintenance' ? 'selected' : '' }}>
                                        Maintenance</option>
                                </select>
                            </div>

                            {{-- Tombol --}}
                            <div class="d-grid gap-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($kamar) ? 'Update Data Kamar' : 'Simpan Data Kamar' }}
                                </button>
                                <a href="{{ url('/admin/kelola-data-kamar') }}" class="btn btn-info">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
