@extends('layouts.mahasiswa.app')

@section('title', 'Pendaftaran Kamar - Sistem Asrama Unidayan')
@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/mahasiswa/informasidatakamar.css') }}"> --}}

@section('main-content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 d-flex flex-column ">
                {{-- card title --}}
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Pendaftaran Kamar</h4>
                    </div>
                </div>
                {{-- end card title --}}
                {{-- form registration room --}}
                <div class="card col-sm-12 col-md-12 d-flex flex-column p-4 gap-3">

                    <form action="{{ route('pendaftaran-kamar.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                name="nama" value="{{ old('nama') }}">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nim"
                                name="nim" value="{{ old('nim') }}">
                            @error('nim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="noHp">No.Hp</label>
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="noHp"
                                name="no_hp" value="{{ old('no_hp') }}">
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="prodi">Program Studi</label>
                            <input type="text" class="form-control @error('prodi') is-invalid @enderror" id="prodi"
                                name="prodi" value="{{ old('prodi') }}">
                            @error('prodi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin"
                                name="jenis_kelamin" value="{{ old('jenis_kelamin') }}">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kamar">Kamar</label>
                            <select class="form-control @error('kamar') is-invalid @enderror" id="kamar" name="kamar"
                                value="{{ old('kamar') }}">
                                <option value="">Pilih Kamar</option>
                                <option value="Kamar1">Kamar 1</option>
                                <option value="Kamar2">Kamar 2</option>
                                <option value="Kamar3">Kamar 3</option>
                            </select>
                            @error('kamar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tanggal_pendaftaran">Tanggal Pendaftaran</label>
                            <input type="date" class="form-control @error('tanggal_pendaftaran') is-invalid @enderror"
                                id="tanggal_pendaftaran" name="tanggal_pendaftaran"
                                value="{{ old('tanggal_pendaftaran') }}">
                            @error('tanggal_pendaftaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-3">Daftar</button>
                    </form>
                </div>
                {{-- end form registration room --}}
            </div>
        </div>
    </div>

@endsection
