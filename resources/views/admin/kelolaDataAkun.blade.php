@extends('layouts.admin.app')

@section('title', 'Kelola Data Akun - Sistem Asrama Unidayan')
@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/mahasiswa/informasidatakamar.css') }}"> --}}

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Kelola Data Akun</h4>
                        <p class="card-subtitle">Berikut adalah data akun yang terdaftar di sistem asrama Unidayan</p>
                        <div class="table-responsive">
                            <table id="kelolaDataAkun" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIM</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Hasan</td>
                                        <td>123456789</td>
                                        <td>Email</td>
                                        <td>Mahasiswa</td>
                                        <td>
                                            <span class="badge bg-success">Approve</span>
                                            {{-- nanti di statusnya ini di ganti lewat view edit --}}
                                        </td>
                                        <td>

                                            <button type="button" class="btn btn-success btn-sm">Approve</button>
                                            <button type="submit" class="btn btn-warning btn-sm">Pandding</button>

                                        </td>
                                    </tr>

                                </tbody>
                            </table>
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
