@extends('layouts.admin.app')

@section('title', 'Edit Data Akun - Sistem Asrama Unidayan')
@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/mahasiswa/informasidatakamar.css') }}"> --}}

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Data Akun</h4>
                        <p class="card-subtitle">Edit Status Akun Penghuni</p>
                        <div class="card-edit">
                            <form action="#" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" value="#"
                                        required autofocus autocomplete="name" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="nim" class="form-label">NIM</label>
                                    <input type="text" class="form-control" id="nim" name="nim" value="#"
                                        required autocomplete="nim" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="#"
                                        required autocomplete="email" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <input type="text" class="form-control" id="role" name="role" value="#"
                                        required autocomplete="role" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="aktif">Aktif</option>
                                        <option value="nonaktif">Non Aktif</option>
                                    </select>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-success  w-100">Simpan Perubahan</button>
                                    <a href="/admin/kelola-data-akun" class="btn btn-warning w-100">Kembali</a>
                                </div>
                            </form>
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
