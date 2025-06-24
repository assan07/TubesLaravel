@extends('layouts.admin.app')

@section('title', 'Informasi Data Kamar Perempuan - Sistem Asrama Unidayan')
@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/admin/informasidatakamar.css') }}"> --}}

@section('main-content')

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Data Kamar Perempuan</h5>
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
                                @foreach ($kamarPerempuan as $kamar)
                                    <tr>
                                        <td>{{ $kamar->nama_kamar }}</td>
                                        <td>{{ $kamar->no_kamar }}</td>
                                        <td>
                                            @if ($kamar->status == 'tersedia')
                                                <span class="text-success fs-4">✔</span>
                                            @else
                                                <span class="text-danger fs-4">✘</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($kamar->status == 'diisi')
                                                <span class="text-success fs-4">✔</span>
                                            @else
                                                <span class="text-danger fs-4">✘</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($kamar->status == 'maintenance')
                                                <span class="text-success fs-4">✔</span>
                                            @else
                                                <span class="text-danger fs-4">✘</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('kelola-data-kamar/data-kamar/' . $jenis_kamar . '/detail/' . $kamar->id) }}"
                                                class="btn btn-info btn-sm">Detail</a>

                                            <a href="{{ url('kelola-data-kamar/data-kamar/' . $jenis_kamar . '/edit/' . $kamar->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>

                                            <form
                                                action="{{ url('kelola-data-kamar/data-kamar/' . $jenis_kamar . '/delete/' . $kamar->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Hapus data ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
