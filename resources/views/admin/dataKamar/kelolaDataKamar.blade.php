 @extends('layouts.admin.app')

 @section('title', 'Informasi Data Kamar - Sistem Asrama Unidayan')
 @section('css')
     <link rel="stylesheet" href="{{ asset('assets/css/admin/informasidatakamar.css') }}">

 @section('main-content')

     <div class="container">
         <div class="row justify-content-center">
             <div class="col-md-12 d-flex flex-column">
                 <div class="card">
                     {{-- Header bagian atas: Form search + Judul + Tombol Tambah --}}
                     <div class="card-header d-flex align-items-center justify-content-between">
                         {{-- Form pencarian kamar --}}
                         <div class="search-room d-flex align-items-center">
                             <form action="{{ url('/search-data-kamar') }}" method="GET"
                                 class="d-flex align-items-center w-50">
                                 <label for="search">Search</label>
                                 <input type="text" class="form-control mx-2" name="search" id="search"
                                     placeholder="Cari Nama Kamar" value="{{ request('search') }}"> {{-- isi tetap muncul setelah pencarian --}}
                             </form>
                         </div>

                         {{-- Judul halaman --}}
                         <div class="title">
                             <h4>Informasi Data Kamar</h4>
                         </div>

                         {{-- Tombol Tambah Kamar --}}
                         <div class="btn-add-room">
                             <a href="{{ url('kelola-data-kamar/tambah-kamar') }}" class="btn btn-success">Tambah Kamar</a>
                         </div>
                     </div>
                 </div>

                 {{-- ======================= KAMAR LAKI-LAKI ======================= --}}
                 <div class="room-guy card col-sm-12 col-md-12 d-flex flex-column p-4 gap-3">
                     <h1><strong>Kamar Laki-Laki</strong></h1>
                     <div class="card-room-guy row-lg-12 col-md-12 col-sm-12 d-flex gap-3">

                         {{-- Total --}}
                         <a href="{{ url('kelola-data-kamar/data-kamar/laki-laki') }}"
                             class="card-room bg-primary w-100 rounded d-flex flex-column align-items-center p-2">
                             <div
                                 class="sub-card bg-white w-100 rounded d-flex align-items-center justify-content-center p-2 text-center">
                                 <h1 style="font-weight: bolder">{{ $data['laki']['total'] }}</h1>
                             </div>
                             <strong class="text-white mt-1">Total</strong>
                         </a>

                         {{-- Tersedia --}}
                         <a href="{{ url('kelola-data-kamar/data-kamar/laki-laki') }}"
                             class="card-room bg-success w-100 rounded d-flex flex-column align-items-center p-2">
                             <div
                                 class="sub-card bg-white w-100 rounded d-flex align-items-center justify-content-center p-2 text-center">
                                 <h1 style="font-weight: bolder">{{ $data['laki']['tersedia'] }}</h1>
                             </div>
                             <strong class="text-white mt-1">Tersedia</strong>
                         </a>

                         {{-- Diisi --}}
                         <a href="{{ url('kelola-data-kamar/data-kamar/laki-laki') }}"
                             class="card-room bg-info w-100 rounded d-flex flex-column align-items-center p-2">
                             <div
                                 class="sub-card bg-white w-100 rounded d-flex align-items-center justify-content-center p-2 text-center">
                                 <h1 style="font-weight: bolder">{{ $data['laki']['diisi'] }}</h1>
                             </div>
                             <strong class="text-white mt-1">Diisi</strong>
                         </a>

                         {{-- Maintenance --}}
                         <a href="{{ url('kelola-data-kamar/data-kamar/laki-laki') }}"
                             class="card-room bg-warning w-100 rounded d-flex flex-column align-items-center p-2">
                             <div
                                 class="sub-card bg-white w-100 rounded d-flex align-items-center justify-content-center p-2 text-center">
                                 <h1 style="font-weight: bolder">{{ $data['laki']['maintenance'] }}</h1>
                             </div>
                             <strong class="text-white mt-1">Maintenance</strong>
                         </a>
                     </div>
                 </div>

                 {{-- ======================= KAMAR PEREMPUAN ======================= --}}
                 <div class="room-girl card col-sm-12 col-md-12 d-flex flex-column p-4 gap-3">
                     <h1><strong>Kamar Perempuan</strong></h1>
                     <div class="card-room-girl row-lg-12 col-md-12 col-sm-12 d-flex gap-3">

                         {{-- Total --}}
                         <a href="{{ url('kelola-data-kamar/data-kamar/perempuan') }}"
                             class="card-room bg-primary w-100 rounded d-flex flex-column align-items-center p-2">
                             <div
                                 class="sub-card bg-white w-100 rounded d-flex align-items-center justify-content-center p-2 text-center">
                                 <h1 style="font-weight: bolder">{{ $data['perempuan']['total'] }}</h1>
                             </div>
                             <strong class="text-white mt-1">Total</strong>
                         </a>

                         {{-- Tersedia --}}
                         <a href="{{ url('kelola-data-kamar/data-kamar/perempuan') }}"
                             class="card-room bg-success w-100 rounded d-flex flex-column align-items-center p-2">
                             <div
                                 class="sub-card bg-white w-100 rounded d-flex align-items-center justify-content-center p-2 text-center">
                                 <h1 style="font-weight: bolder">{{ $data['perempuan']['tersedia'] }}</h1>
                             </div>
                             <strong class="text-white mt-1">Tersedia</strong>
                         </a>

                         {{-- Diisi --}}
                         <a href="{{ url('kelola-data-kamar/data-kamar/perempuan') }}"
                             class="card-room bg-info w-100 rounded d-flex flex-column align-items-center p-2">
                             <div
                                 class="sub-card bg-white w-100 rounded d-flex align-items-center justify-content-center p-2 text-center">
                                 <h1 style="font-weight: bolder">{{ $data['perempuan']['diisi'] }}</h1>
                             </div>
                             <strong class="text-white mt-1">Diisi</strong>
                         </a>

                         {{-- Maintenance --}}
                         <a href="{{ url('kelola-data-kamar/data-kamar/perempuan') }}"
                             class="card-room bg-warning w-100 rounded d-flex flex-column align-items-center p-2">
                             <div
                                 class="sub-card bg-white w-100 rounded d-flex align-items-center justify-content-center p-2 text-center">
                                 <h1 style="font-weight: bolder">{{ $data['perempuan']['maintenance'] }}</h1>
                             </div>
                             <strong class="text-white mt-1">Maintenance</strong>
                         </a>
                     </div>
                 </div>
             </div>

         </div>
     </div>


 @endsection
