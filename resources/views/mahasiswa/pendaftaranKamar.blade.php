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
                    <form action="#" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="text" class="form-control" id="nim" name="nim" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="noHp">No.Hp</label>
                            <input type="text" class="form-control" id="noHp" name="noHp" required>
                        </div>
                        <div class="form-group">
                            <label for="prodi">Program Studi</label>
                            <input type="text" class="form-control" id="prodi" name="prodi" required>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kamar">Kamar</label>
                            <select class="form-control" id="kamar" name="kamar" required>
                                <option value="">Pilih Kamar</option>
                                <option value="">Kamar 1</option>
                                <option value="">Kamar 2</option>
                                <option value="">Kamar 3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_pendaftaran">Tanggal Pendaftaran</label>
                            <input type="date" class="form-control" id="tanggal_pendaftaran" name="tanggal_pendaftaran"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-3">Daftar</button>
                    </form>
                </div>
                {{-- end form registration room --}}
            </div>
        </div>
    </div>

@endsection
