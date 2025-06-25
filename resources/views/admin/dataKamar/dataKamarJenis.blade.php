@extends('layouts.admin.app')

@section('title', 'Informasi Data Kamar - Sistem Asrama Unidayan')
@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/admin/informasidatakamar.css') }}"> --}}

@section('main-content')

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Data Kamar {{ ucfirst($jenis_kamar) }}</h5>
                    <a href="{{ url('/kelola-data-kamar') }}" class="btn btn-light btn-sm">
                        <i class="ti ti-arrow-left"></i> Kembali
                    </a>
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
                            @forelse ($data as $kamar)
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
                                        <a href="{{ url("kelola-data-kamar/data-kamar/$jenis_kamar/detail/" . $kamar->id) }}"
                                            class="btn btn-info btn-sm" title="Detail">
                                            <i class="ti ti-eye-check" style="font-size: 1rem"></i>
                                        </a>
                                        <a href="{{ url("kelola-data-kamar/data-kamar/$jenis_kamar/edit/" . $kamar->id) }}"
                                            class="btn btn-warning btn-sm" title="Edit">
                                            <i class="ti ti-pencil" style="font-size: 1rem"></i>
                                        </a>
                                        <form
                                            action="{{ url("kelola-data-kamar/data-kamar/$jenis_kamar/delete/" . $kamar->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Hapus data ini?')" title="Hapus">
                                                <i class="ti ti-trash-x" style="font-size: 1rem"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-muted">Belum ada data kamar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


