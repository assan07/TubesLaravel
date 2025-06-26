@extends('layouts.admin.app')

@section('title', 'Edit Data Penghuni - Sistem Asrama Unidayan')

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Data Penghuni</h4>
                        <p class="card-subtitle">Edit Kamar & Status Akun Penghuni</p>

                        <div class="card-edit">
                            <form action="{{ url('/penghuni/' . $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                {{-- Nama --}}
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" value="{{ $user->nama }}" readonly>
                                </div>

                                {{-- NIM --}}
                                <div class="mb-3">
                                    <label class="form-label">NIM</label>
                                    <input type="text" class="form-control" value="{{ $user->nim }}" readonly>
                                </div>

                                {{-- Email --}}
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                                </div>

                                {{-- Nama Kamar (readonly) --}}
                                <div class="mb-3">
                                    <label class="form-label">Nama Kamar</label>
                                    <input type="text" class="form-control"
                                        value="{{ $user->pendaftaranKamar?->room->nama_kamar ?? '-' }}" readonly>
                                </div>

                                {{-- Nomor Kamar (readonly) --}}
                                <div class="mb-3">
                                    <label class="form-label">Nomor Kamar</label>
                                    <input type="text" class="form-control"
                                        value="{{ $user->pendaftaranKamar?->room->no_kamar ?? '-' }}" readonly>
                                </div>

                                {{-- Pilih Kamar Baru --}}
                                <div class="mb-3">
                                    <label for="room_id" class="form-label">Pindah ke Kamar</label>
                                    <select name="room_id" class="form-select" required>
                                        <option disabled selected>-- Pilih Kamar Baru --</option>
                                        @foreach ($rooms as $room)
                                            <option value="{{ $room->id }}"
                                                {{ $user->pendaftaranKamar && $user->pendaftaranKamar->room_id == $room->id ? 'selected' : '' }}>
                                                {{ $room->nama_kamar }} - No. {{ $room->no_kamar }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-success w-100">Simpan Perubahan</button>
                                    <a href="{{ url('/penghuni') }}" class="btn btn-warning w-100">Kembali</a>
                                </div>
                            
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
