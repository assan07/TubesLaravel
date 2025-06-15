<?php

use Illuminate\Support\Facades\Route;

// Route for the Mahasiswa login page
Route::get('/', function () {
    return view('mahasiswa.loginMahasiswa');
});

// Route for the Mahasiswa registration page
Route::get('/register', function () {
    return view('mahasiswa.registerMahasiswa');
});

// Route for the Information Data Room Hostel page
Route::get('/data-kamar', function () {
    return view('mahasiswa.informasiDataKamar');
});
