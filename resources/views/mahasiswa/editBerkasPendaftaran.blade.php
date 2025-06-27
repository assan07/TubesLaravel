@extends('layouts.mahasiswa.app')

@section('title', 'Edit Pendaftaran Kamar - Sistem Asrama Unidayan')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/mahasiswa/edit_berkas_pendaftaran.css') }}">

@section('main-content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-12 col-xl-10">
                <div class="card form-header">
                    <h2><i class="fas fa-edit me-2"></i>Edit Berkas Pendaftaran Kamar</h2>
                </div>
                <div class="form-container">


                    <form action="{{ route('pendaftaran-kamar.update', $pendaftaran->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama" class="form-label">
                                        <i class="fas fa-user me-1"></i>Nama Lengkap
                                    </label>
                                    <div class="icon-input">
                                        <i class="fas fa-user"></i>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            value="{{ $pendaftaran->nama }}" required placeholder="Masukkan nama lengkap">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nim" class="form-label">
                                        <i class="fas fa-id-card me-1"></i>NIM
                                    </label>
                                    <div class="icon-input">
                                        <i class="fas fa-id-card"></i>
                                        <input type="text" class="form-control" id="nim" name="nim"
                                            value="{{ $pendaftaran->nim }}" required placeholder="Masukkan NIM">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">
                                        <i class="fas fa-envelope me-1"></i>Email
                                    </label>
                                    <div class="icon-input">
                                        <i class="fas fa-envelope"></i>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ $pendaftaran->email }}" required placeholder="Masukkan email">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_hp" class="form-label">
                                        <i class="fas fa-phone me-1"></i>No HP
                                    </label>
                                    <div class="icon-input">
                                        <i class="fas fa-phone"></i>
                                        <input type="text" class="form-control" id="no_hp" name="no_hp"
                                            value="{{ $pendaftaran->no_hp }}" required placeholder="Masukkan nomor HP">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prodi" class="form-label">
                                        <i class="fas fa-graduation-cap me-1"></i>Program Studi
                                    </label>
                                    <div class="icon-input">
                                        <i class="fas fa-graduation-cap"></i>
                                        <input type="text" class="form-control" id="prodi" name="prodi"
                                            value="{{ $pendaftaran->prodi }}" required placeholder="Masukkan program studi">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis_kelamin" class="form-label">
                                        <i class="fas fa-venus-mars me-1"></i>Jenis Kelamin
                                    </label>
                                    <div class="icon-input">
                                        <i class="fas fa-venus-mars"></i>
                                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki"
                                                {{ $pendaftaran->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                                                Laki-laki
                                            </option>
                                            <option value="Perempuan"
                                                {{ $pendaftaran->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                                Perempuan
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="room_id" class="form-label">
                                        <i class="fas fa-bed me-1"></i>Kamar
                                    </label>
                                    <div class="icon-input">
                                        <i class="fas fa-bed"></i>
                                        <select class="form-select" id="room_id" name="room_id" required>
                                            <option value="">Pilih Kamar</option>
                                            @foreach ($rooms as $room)
                                                <option value="{{ $room->id }}"
                                                    {{ $pendaftaran->room_id == $room->id ? 'selected' : '' }}>
                                                    {{ $room->nama_kamar }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_pendaftaran" class="form-label">
                                        <i class="fas fa-calendar me-1"></i>Tanggal Pendaftaran
                                    </label>
                                    <div class="icon-input">
                                        <i class="fas fa-calendar"></i>
                                        <input type="date" class="form-control" id="tanggal_pendaftaran"
                                            name="tanggal_pendaftaran" value="{{ $pendaftaran->tanggal_pendaftaran }}"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="button-group">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                            <a href="{{ route('pendaftaran-kamar.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
