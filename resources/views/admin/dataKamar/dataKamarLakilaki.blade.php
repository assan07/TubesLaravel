@extends('layouts.admin.app')

@section('title', 'Informasi Data Kamar Laki-Laki - Sistem Asrama Unidayan')
@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/admin/informasidatakamar.css') }}"> --}}

@section('main-content')

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Data Kamar Laki-Laki</h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-hover text-center align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Kamar</th>
                                    <th>No. Kamar</th>
                                    <th>Tersedia</th>
                                    <th>Diisi</th>
                                    <th>Maintenance</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Contoh data dummy, bisa di-loop pakai @foreach --}}
                                <tr>
                                    <td>Kamar A</td>
                                    <td>A12</td>
                                    <td><span class="text-success fs-4">✔</span></td>
                                    <td><span class="text-danger fs-4">✘</span></td>
                                    <td><span class="text-success fs-4">✔</span></td>
                                    <td>
                                        <a href="{{ url('admin/kelola-data-kamar/data-kamar/laki-laki/detail') }}" class="btn btn-info btn-sm">Detail</a>
                                        <a href="{{ url('admin/kelola-data-kamar/data-kamar/laki-laki/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="#" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Hapus data ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>

                                {{-- Tambahkan baris lain di sini --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
