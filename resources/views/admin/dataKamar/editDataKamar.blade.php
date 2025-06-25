@extends('layouts.admin.app')

@section('title', 'Edit Data Kamar ' . ucfirst($kamar->jenis_kamar) . ' - Sistem Asrama Unidayan')

@section('main-content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0">Edit Data Kamar</h5>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ url('/kelola-data-kamar/data-kamar/' . $kamar->jenis_kamar . '/update/' . $kamar->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Nama kamar --}}
                            <div class="mb-3">
                                <label class="form-label">Nama Kamar</label>
                                <input type="text" class="form-control" name="nama_kamar"
                                    value="{{ $kamar->nama_kamar }}" required>
                            </div>

                            {{-- No Kamar --}}
                            <div class="mb-3">
                                <label class="form-label">No. Kamar</label>
                                <input type="text" class="form-control" name="no_kamar" value="{{ $kamar->no_kamar }}"
                                    required>
                            </div>

                            {{-- Lokasi Kamar --}}
                            <div class="mb-3">
                                <label class="form-label">Lokasi</label>
                                <input type="text" class="form-control" name="lokasi_kamar"
                                    value="{{ $kamar->lokasi_kamar }}" required>
                            </div>

                            {{-- Harga Kamar --}}
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga Kamar</label>
                                <input type="text" class="form-control" id="harga" name="harga"
                                    value="{{ $kamar->harga }}" required>
                            </div>

                            {{-- Status Kamar --}}
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

                            {{-- Btn Simpan --}}
                            <button type="submit" class="btn btn-primary">Simpan</button>

                            {{-- Btn Kembali --}}
                            <a href="{{ url('kelola-data-kamar/data-kamar/' . $kamar->jenis_kamar) }}"
                                class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
