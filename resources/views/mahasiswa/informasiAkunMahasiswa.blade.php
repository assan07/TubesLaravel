@extends('layouts.mahasiswa.app')
@section('csrf_token')
    <meta name="csrf-token" content="{{ csrf_token() }}">

@section('title', 'Profile Mahasiswa - Sistem Asrama Unidayan')
@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/mahasiswa/informasidatakamar.css') }}"> --}}

@section('main-content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 d-flex flex-column ">
                {{-- card title --}}
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Profile Mahasiswa</h4>
                    </div>
                </div>
                {{-- end card title --}}
                {{-- form Profile Mahasiswa room --}}


                <div class="container">
                    <h3 class="mb-4">Data Mahasiswa</h3>
                    <div class="card p-4">
                        <form id="profile-form" method="POST" action="{{ route('informasi-akun.store') }}"
                            enctype="multipart/form-data" data-delete-url="{{ route('delete.photo') }}"
                            data-csrf-token="{{ csrf_token() }}"
                            data-default-image="{{ asset('assets/images/profile/user-1.jpg') }}">
                            @csrf
                            <div class="row">
                                <!-- Profile Photo -->
                                <div class="col-md-4 d-flex flex-column align-items-center">
                                    <div class="profile-photo">
                                        <img id="profileImage"
                                            src="{{ $mahasiswa && $mahasiswa->foto ? asset('storage/' . $mahasiswa->foto) : asset('assets/images/profile/user-1.jpg') }}"
                                            alt="Foto Profil" class="img-fluid rounded-circle"
                                            style="width: 150px; height: 150px; object-fit: cover;" />

                                    </div>
                                    {{-- button upload foto --}}
                                    <button type="button" class="btn btn-info mt-2"
                                        onclick="$('#photoInputMahasiswa').click()">
                                        <i class="fas fa-camera"></i> Unggah Foto
                                    </button>
                                    <input type="file" id="photoInputMahasiswa" name="photo_mahasiswa"
                                        class="form-control @error('photo_mahasiswa') is-invalid @enderror"
                                        style="display: none" onchange="previewImage(event)" />
                                    @error('photo_mahasiswa')
                                        <div class="invalid-feedback text-center">{{ $message }}</div>
                                    @enderror
                                    {{-- button delete foto --}}
                                    <button type="button" id="deletePhotoBtn" class="btn btn-danger mt-2"
                                        onclick="deletePhotoProfile()">
                                        <i class="fas fa-trash-alt"></i> Hapus Foto
                                    </button>
                                </div>

                                <!-- Data Mahasiswa -->
                                <div class="col-md-8">
                                    <h3 class="mb-3">Informasi Pribadi</h3>
                                    <!-- Name & Nim Mahasiswa -->
                                    <div class="row mb-3">
                                        <!-- Name Mahasiswa -->
                                        <div class="col-md-6">
                                            <label for="fullName"><i class="fas fa-user"></i> Nama Lengkap</label>
                                            <input type="text" class="form-control" id="namaMahasiswa"
                                                name="namaMahasiswa" value="{{ $user->nama }}" readonly />
                                        </div>
                                        <!-- NIM Mahasiswa -->
                                        <div class="col-md-6">
                                            <label for="nim"><i class="fas fa-id-card"></i> Nomor Induk
                                                Mahasiswa</label>
                                            <input type="text" class="form-control" id="nim" name="nim"
                                                value="{{ $user->nim }}" readonly />
                                        </div>
                                    </div>

                                    <!-- No. Handphone & Prodi Mahasiswa -->
                                    <div class="row mb-3">
                                        <!-- No. Handphone Mahasiswa -->
                                        <div class="col-md-6">
                                            <label for="phone"><i class="fas fa-phone"></i> No. Handphone</label>
                                            <input type="text"
                                                class="form-control @error('phoneMahasiswa') is-invalid @enderror"
                                                id="phoneMahasiswa" name="phoneMahasiswa" placeholder="No. Handphone"
                                                value="{{ old('phoneMahasiswa', $mahasiswa->phone ?? '') }}" />
                                            @error('phoneMahasiswa')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!-- Prodi Mahasiswa -->
                                        <div class="col-md-6">
                                            <label for="prodi"><i class="fas fa-user-graduate"></i> Program
                                                Studi</label>
                                            <input type="text"
                                                class="form-control @error('prodiMahasiswa') is-invalid @enderror"
                                                id="prodiMahasiswa" name="prodiMahasiswa" placeholder="Program Studi"
                                                value="{{ old('prodiMahasiswa', $mahasiswa->prodi ?? '') }}" />
                                            @error('prodiMahasiswa')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>

                                    <!-- Email & Gender -->
                                    <div class="row mb-3">
                                        <!-- Email Mahasiswa -->
                                        <div class="col-md-6">
                                            <label for="email"><i class="fas fa-envelope"></i> Email</label>
                                            <input type="email" class="form-control" id="emailMahasiswa"
                                                name="emailMahasiswa" value="{{ $user->email }}" readonly />
                                        </div>

                                        <!-- Gender -->
                                        <div class="col-md-6">
                                            <label for="gender"><i class="fa-solid fa-person-half-dress"></i> Jenis
                                                Kelamin</label>
                                            <select class="form-control @error('gender') is-invalid @enderror"
                                                id="gender" name="gender">
                                                <option value="" disabled
                                                    {{ old('gender', $mahasiswa->gender ?? '') == '' ? 'selected' : '' }}>
                                                    Pilih Jenis Kelamin</option>
                                                <option value="lakilaki"
                                                    {{ old('gender', $mahasiswa->gender ?? '') == 'lakilaki' ? 'selected' : '' }}>
                                                    Laki-Laki</option>
                                                <option value="perempuan"
                                                    {{ old('gender', $mahasiswa->gender ?? '') == 'perempuan' ? 'selected' : '' }}>
                                                    Perempuan</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>

                                    <!-- Semester & Umur -->
                                    <div class="row mb-3">
                                        <!-- Semester Mahasiswa -->
                                        <div class="col-md-6">
                                            <label for="semester"><i class="fas fa-graduation-cap"></i>
                                                Semester</label>
                                            <select class="form-control @error('semesterMahasiswa') is-invalid @enderror"
                                                id="semesterMahasiswa" name="semesterMahasiswa">
                                                @for ($i = 1; $i <= 14; $i++)
                                                    <option value="{{ $i }}"
                                                        {{ old('semesterMahasiswa', $mahasiswa->semester ?? '') == $i ? 'selected' : '' }}>
                                                        Semester {{ $i }} ({{ toRomawi($i) }})
                                                    </option>
                                                @endfor
                                            </select>
                                            @error('semesterMahasiswa')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                        </div>

                                        <!-- Umur -->
                                        <div class="col-md-6">
                                            <label for="age"><i class="fa-solid fa-user-tie"></i> Umur</label>
                                            <input type="text" class="form-control @error('age') is-invalid @enderror"
                                                id="age" name="age" placeholder="Umur Mahasiswa"
                                                value="{{ old('age', $mahasiswa->umur ?? '') }}" />
                                            @error('age')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>

                                    <!-- Address Mahasiswa -->
                                    <div class="mb-3">
                                        <label for="address"><i class="fas fa-map-marker-alt"></i> Alamat</label>
                                        <textarea class="form-control @error('addressMahasiswa') is-invalid @enderror" id="addressMahasiswa"
                                            name="addressMahasiswa" rows="3" placeholder="Alamat">{{ old('addressMahasiswa', $mahasiswa->alamat ?? '') }}</textarea>
                                        @error('addressMahasiswa')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                    </div>

                                    <!-- Button Save -->

                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                    <button type="button" class="btn btn-primary">
                                        <i class="fas fa-outdent"></i> Cencle
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- end form Profile Mahasiswa room --}}
            </div>
        </div>
    </div>
    @push('scripts')
        <!-- SweetAlert2 CDN -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('assets/js/mahasiswa/editProfileMahaiswa.js') }}"></script>
    @endpush

@endsection
