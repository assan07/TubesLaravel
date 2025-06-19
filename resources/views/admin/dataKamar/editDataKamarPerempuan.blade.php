@extends('layouts.admin.app')

@section('title', 'Informasi Data Kamar Perempuan - Sistem Asrama Unidayan')
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
                        <form action="#" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Nama Kamar</label>
                                <input type="text" class="form-control" name="nama_kamar"
                                    value="" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">No. Kamar</label>
                                <input type="text" class="form-control" name="no_kamar" value=""
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Lokasi</label>
                                <input type="text" class="form-control" name="lokasi" value=""
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tersedia</label>
                                <select class="form-control" name="tersedia" required>
                                    <option value="1" >Ya</option>
                                    <option value="0" >Tidak</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Diisi</label>
                                <select class="form-control" name="diisi" required>
                                    <option value="1" >Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Maintenance</label>
                                <select class="form-control" name="maintenance" required>
                                    <option value="1" >Ya</option>
                                    <option value="0" >Tidak</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ url('/admin/kelola-data-kamar/data-kamar/perempuan') }}" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
