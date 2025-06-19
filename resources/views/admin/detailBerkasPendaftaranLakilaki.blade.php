@extends('layouts.admin.app')

@section('title', 'Data Berkas Laki-Laki - Sistem Asrama Unidayan')
@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/mahasiswa/informasidatakamar.css') }}"> --}}

@section('main-content')
    <div class="container-fluid">
        
        {{-- Push JS --}}
        @push('scripts')
            {{-- <script src="{{ asset('assets/js/mahasiswa/login_mahasiswa.js') }}"></script> --}}
        @endpush

    @endsection
