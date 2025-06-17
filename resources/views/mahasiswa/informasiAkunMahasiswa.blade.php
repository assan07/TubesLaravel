@extends('layouts.mahasiswa.app')

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
                        <form id="profile-form" method="POST" action="POST" enctype="multipart/form-data">
                            <div class="row">
                                <!-- Profile Photo -->
                                <div class="col-md-4 d-flex flex-column align-items-center">
                                    <div class="profile-photo">
                                        <img id="profileImage" src="" alt="Foto Profil" />
                                        <p class="mt-2" id="nameMahasiswaSession">
                                            <i class="fas fa-user"></i> Hasan
                                        </p>
                                    </div>
                                    <button type="button" class="btn btn-info mt-2"
                                        onclick="$('#photoInputMahasiswa').click()">
                                        <i class="fas fa-camera"></i> Unggah Foto
                                    </button>
                                    <input type="file" id="photoInputMahasiswa" name="photo_mahasiswa"
                                        style="display: none" onchange="previewImage(event)" />
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
                                                name="namaMahasiswa" placeholder="Nama Lengkap" required />
                                        </div>
                                        <!-- NIM Mahasiswa -->
                                        <div class="col-md-6">
                                            <label for="nim"><i class="fas fa-id-card"></i> Nomor Induk
                                                Mahasiswa</label>
                                            <input type="text" class="form-control" id="nim" name="nim"
                                                placeholder="Nomor Induk Mahasiswa" required readonly />
                                        </div>
                                    </div>

                                    <!-- No. Handphone & Prodi Mahasiswa -->
                                    <div class="row mb-3">
                                        <!-- No. Handphone Mahasiswa -->
                                        <div class="col-md-6">
                                            <label for="phone"><i class="fas fa-phone"></i> No. Handphone</label>
                                            <input type="text" class="form-control" id="phoneMahasiswa"
                                                name="phoneMahasiswa" placeholder="No. Handphone" required />
                                        </div>
                                        <!-- Prodi Mahasiswa -->
                                        <div class="col-md-6">
                                            <label for="prodi"><i class="fas fa-user-graduate"></i> Program
                                                Studi</label>
                                            <input type="text" class="form-control" id="prodiMahasiswa"
                                                name="prodiMahasiswa" placeholder="Program Studi" required />
                                        </div>
                                    </div>

                                    <!-- Email & Payment Cycle -->
                                    <div class="row mb-3">
                                        <!-- Email Mahasiswa -->
                                        <div class="col-md-6">
                                            <label for="email"><i class="fas fa-envelope"></i> Email</label>
                                            <input type="email" class="form-control" id="emailMahasiswa"
                                                name="emailMahasiswa" placeholder="Email Mahasiswa" required />
                                        </div>

                                        <!-- Payment Cycle -->
                                        <div class="col-md-6">
                                            <label for="gender"><i class="fa-solid fa-person-half-dress"></i> Jenis
                                                Kelamin</label>
                                            <select class="form-control" id="paymentCycle" name="paymentCycle">
                                                <option value="" disabled selected>
                                                    Pilih Jenis Kelamin
                                                </option>
                                                <option value="lakilaki">Laki-Laki</option>
                                                <option value="perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Semester & Remining Cycle -->
                                    <div class="row mb-3">
                                        <!-- Semester Mahasiswa -->
                                        <div class="col-md-6">
                                            <label for="semester"><i class="fas fa-graduation-cap"></i>
                                                Semester</label>
                                            <select class="form-control" id="semesterMahasiswa" name="semesterMahasiswa"
                                                required>
                                                <option value="" disabled selected>
                                                    Semester yang sedang ditempuh
                                                </option>
                                                <option value="1">I</option>
                                                <option value="2">II</option>
                                                <option value="3">III</option>
                                                <option value="4">IV</option>
                                                <option value="5">V</option>
                                                <option value="6">VI</option>
                                                <option value="7">VII</option>
                                                <option value="8">VIII</option>
                                                <option value="9">IX</option>
                                                <option value="10">X</option>
                                                <option value="11">XI</option>
                                                <option value="12">XII</option>
                                                <option value="13">XIII</option>
                                                <option value="14">XIV</option>
                                            </select>
                                        </div>

                                        <!-- Remining Cycle -->
                                        <div class="col-md-6">
                                            <label for="age"><i class="fa-solid fa-user-tie"></i> Umur</label>
                                            <input type="text" class="form-control" id="age" name="age"
                                                placeholder="Umur Mahasiswa" readonly />
                                        </div>
                                    </div>

                                    <!-- Address Mahasiswa -->
                                    <div class="mb-3">
                                        <label for="address"><i class="fas fa-map-marker-alt"></i> Alamat</label>
                                        <textarea class="form-control" id="addressMahasiswa" name="addressMahasiswa" rows="3" placeholder="Alamat"
                                            required>
                                        </textarea>
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

@endsection
