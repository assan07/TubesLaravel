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
                    @if ($pendaftaran)
                        {{-- ✅ Alert sudah mendaftar --}}
                        <div class="alert alert-success">
                            <strong>Anda sudah mendaftar!</strong> Silakan periksa kembali berkas pendaftaran Anda.
                        </div>

                        {{-- ✅ Riwayat pendaftaran --}}
                        <div class="card p-3 mb-3">
                            <h5>Riwayat Pendaftaran Kamar</h5>
                            <ul class="list-group">
                                <li class="list-group-item">Nama: {{ $pendaftaran->nama }}</li>
                                <li class="list-group-item">NIM: {{ $pendaftaran->nim }}</li>
                                <li class="list-group-item">Email: {{ $pendaftaran->email }}</li>
                                <li class="list-group-item">No HP: {{ $pendaftaran->no_hp }}</li>
                                <li class="list-group-item">Prodi: {{ $pendaftaran->prodi }}</li>
                                <li class="list-group-item">Jenis Kelamin: {{ $pendaftaran->jenis_kelamin }}</li>
                                <li class="list-group-item">Kamar: {{ $pendaftaran->room->nama_kamar ?? '-' }}</li>
                                <li class="list-group-item">Tanggal Daftar:
                                    {{ \Carbon\Carbon::parse($pendaftaran->tanggal_pendaftaran)->format('d M Y') }}</li>
                                <li class="list-group-item">Status Berkas:
                                    <span
                                        class="badge bg-{{ $pendaftaran->status_berkas == 'approved' ? 'success' : ($pendaftaran->status_berkas == 'rejected' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($pendaftaran->status_berkas) }}
                                    </span>
                                </li>
                            </ul>

                            {{-- ✅ Tombol edit berkas --}}
                            <a href="{{ route('pendaftaran-kamar.edit', $pendaftaran->id) }}" class="btn btn-warning mt-3">
                                Edit Berkas
                            </a>
                        </div>
                    @else
                        <form action="{{ route('pendaftaran-kamar.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" value="{{ old('nama', $user->nama) }}">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nim">NIM</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nim" name="nim" value="{{ old('nama', $user->nim) }}">
                                @error('nim')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value=" {{ old('prodi', $user->email ?? '') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="noHp">No.Hp</label>
                                <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                    id="noHp" name="no_hp"
                                    value="{{ old('prodi', $user->mahasiswa->phone ?? '') }}">
                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="prodi">Program Studi</label>
                                <input type="text" class="form-control @error('prodi') is-invalid @enderror"
                                    id="prodi" name="prodi"
                                    value="{{ old('prodi', $user->mahasiswa->prodi ?? '') }}">
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
                                <label for="kamar">Kamar</label><br>
                                <span class="fw-light" style="font-size: 11px"><Strong>Note: </Strong>Kode "L" / "P"
                                    diakhir nama kamar sebagai tanda jenis kamar.</span>
                                <select class="form-control @error('kamar') is-invalid @enderror" id="kamar"
                                    name="kamar">
                                    <option value="">Pilih Kamar</option>
                                    @foreach ($rooms as $room)
                                        <option value="{{ $room->id }}"
                                            {{ old('kamar') == $room->id ? 'selected' : '' }}>
                                            {{ $room->nama_kamar }}
                                        </option>
                                    @endforeach


                                </select>
                                @error('kamar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tanggal_pendaftaran">Tanggal Pendaftaran</label>
                                <input type="date"
                                    class="form-control @error('tanggal_pendaftaran') is-invalid @enderror"
                                    id="tanggal_pendaftaran" name="tanggal_pendaftaran"
                                    value="{{ old('tanggal_pendaftaran') }}">
                                @error('tanggal_pendaftaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-3">Daftar</button>
                        </form>
                    @endif
                </div>
                {{-- end form registration room --}}
            </div>
        </div>
    </div>

@endsection
