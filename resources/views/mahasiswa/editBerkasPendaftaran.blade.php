@extends('layouts.mahasiswa.app')

@section('title', 'Edit Pendaftaran Kamar - Sistem Asrama Unidayan')
@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/mahasiswa/informasidatakamar.css') }}"> --}}

@section('main-content')
    <div class="container">
        <h3>Edit Berkas Pendaftaran</h3>
        <form action="{{ route('pendaftaran-kamar.update', $pendaftaran->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mt-2">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" value="{{ old('nama', $pendaftaran->nama) }}">
            </div>

            <div class="form-group mt-2">
                <label for="nim">NIM</label>
                <input type="text" class="form-control" name="nim" value="{{ old('nim', $pendaftaran->nim) }}">
            </div>

            <div class="form-group mt-2">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" value="{{ old('email', $pendaftaran->email) }}">
            </div>

            <div class="form-group mt-2">
                <label for="no_hp">No HP</label>
                <input type="text" class="form-control" name="no_hp" value="{{ old('no_hp', $pendaftaran->no_hp) }}">
            </div>

            <div class="form-group mt-2">
                <label for="prodi">Prodi</label>
                <input type="text" class="form-control" name="prodi" value="{{ old('prodi', $pendaftaran->prodi) }}">
            </div>

            <div class="form-group mt-2">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-control" name="jenis_kelamin">
                    <option value="Laki-laki" {{ $pendaftaran->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                    </option>
                    <option value="Perempuan" {{ $pendaftaran->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan
                    </option>
                </select>
            </div>

            <div class="form-group mt-2">
                <label for="room_id">Kamar</label>
                <select class="form-control" name="room_id">
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}" {{ $pendaftaran->room_id == $room->id ? 'selected' : '' }}>
                            {{ $room->nama_kamar }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-2">
                <label for="tanggal_pendaftaran">Tanggal Pendaftaran</label>
                <input type="date" class="form-control" name="tanggal_pendaftaran"
                    value="{{ old('tanggal_pendaftaran', $pendaftaran->tanggal_pendaftaran) }}">
            </div>

            <button type="submit" class="btn btn-success mt-3">Simpan Perubahan</button>
        </form>
    </div>
@endsection
