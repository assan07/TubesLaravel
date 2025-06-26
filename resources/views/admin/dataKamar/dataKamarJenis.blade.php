@extends('layouts.admin.app')

@section('title', 'Informasi Data Kamar - Sistem Asrama Unidayan')
@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/admin/informasidatakamar.css') }}"> --}}

@section('main-content')

    <div class="row justify-content-center">
        <div class="col-12">
            {{-- Info Filter By Status  --}}
            @if (request('status'))
                <div class="mb-2">
                    <span class="badge bg-secondary">Filter: {{ ucfirst(request('status')) }}</span>
                    <a href="{{ url()->current() }}" class="btn btn-sm btn-outline-secondary ms-2">Reset</a>
                </div>
            @endif
            {{-- Form pencarian kamar --}}
            <div class="search-room d-flex align-items-center mb-2 w-100">
                <form action="{{ url()->current() }}" method="GET" class="d-flex align-items-center w-50">
                    <label for="search" class="me-1 w-50">Cari Nama Kamar:</label>
                    <select name="search" id="search" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Pilih Nama Kamar --</option>
                        @foreach ($namaKamarList as $nama)
                            <option value="{{ $nama }}" {{ request('search') == $nama ? 'selected' : '' }}>
                                {{ $nama }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>


            <div class="card shadow">

                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Data Kamar {{ ucfirst($jenis_kamar) }}</h5>
                    <a href="{{ url('/kelola-data-kamar') }}" class="btn btn-light btn-sm">
                        <i class="ti ti-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover text-center align-middle table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>Nama Kamar</th>
                                <th>No. Kamar</th>
                                <th>Harga</th>
                                <th>Tersedia</th>
                                <th>Diisi</th>
                                <th>Maintenance</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kamarList as $kamar)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kamar->nama_kamar }}</td>
                                    <td>{{ $kamar->no_kamar }}</td>
                                    <td>Rp.{{ $kamar->harga }}</td>
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
                                    <td colspan="8" class="text-muted">Belum ada data kamar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
