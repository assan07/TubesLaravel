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

                         {{-- Total: tanpa filter --}}
                         <a href="{{ url('kelola-data-kamar/data-kamar/laki-laki') }}"
                             class="card-room bg-primary w-100 rounded d-flex flex-column align-items-center p-2">
                             <div
                                 class="sub-card bg-white w-100 rounded d-flex align-items-center justify-content-center p-2 text-center">
                                 <h1 style="font-weight: bolder">{{ $data['laki']['total'] }}</h1>
                             </div>
                             <strong class="text-white mt-1">Total</strong>
                         </a>

                         {{-- Tersedia --}}
                         <a href="{{ url('kelola-data-kamar/data-kamar/laki-laki?status=tersedia') }}"
                             class="card-room bg-success w-100 rounded d-flex flex-column align-items-center p-2">
                             <div
                                 class="sub-card bg-white w-100 rounded d-flex align-items-center justify-content-center p-2 text-center">
                                 <h1 style="font-weight: bolder">{{ $data['laki']['tersedia'] }}</h1>
                             </div>
                             <strong class="text-white mt-1">Tersedia</strong>
                         </a>

                         {{-- Diisi --}}
                         <a href="{{ url('kelola-data-kamar/data-kamar/laki-laki?status=diisi') }}"
                             class="card-room bg-info w-100 rounded d-flex flex-column align-items-center p-2">
                             <div
                                 class="sub-card bg-white w-100 rounded d-flex align-items-center justify-content-center p-2 text-center">
                                 <h1 style="font-weight: bolder">{{ $data['laki']['diisi'] }}</h1>
                             </div>
                             <strong class="text-white mt-1">Diisi</strong>
                         </a>

                         {{-- Maintenance --}}
                         <a href="{{ url('kelola-data-kamar/data-kamar/laki-laki?status=maintenance') }}"
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
                 <div class="room-girl card col-sm-12 col-md-12 col-xl-12 d-flex flex-column flex-wrap p-4 gap-2">
                     <h1><strong>Kamar Perempuan</strong></h1>
                     <div class="card-room-girl row-lg-12 col-md-12 col-sm-12 d-flex gap-3 w-100">

                         {{-- Total: tanpa filter --}}
                         <a href="{{ url('kelola-data-kamar/data-kamar/perempuan') }}" class="col-xl-3 col-md-6">
                             <div class="card border-left-primary shadow h-100">
                                 <div class="card-body">
                                     <div class="row no-gutters align-items-center">
                                         <div class="col mr-2">
                                             <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                 Total
                                             </div>
                                             <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                 {{ $data['perempuan']['total'] }}</div>
                                         </div>

                                     </div>
                                 </div>
                             </div>
                         </a>

                         {{-- Tersedia --}}
                         <a href="{{ url('kelola-data-kamar/data-kamar/perempuan?status=tersedia') }}"
                             class="col-xl-3 col-md-6">
                             <div class="card border-left-success shadow h-100">
                                 <div class="card-body">
                                     <div class="row no-gutters align-items-center">
                                         <div class="col mr-2">
                                             <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                 Tersedia
                                             </div>
                                             <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                 {{ $data['perempuan']['tersedia'] }}</div>
                                         </div>

                                     </div>
                                 </div>
                             </div>
                         </a>

                         {{-- Diisi --}}
                         <a href="{{ url('kelola-data-kamar/data-kamar/perempuan?status=diisi') }}"
                             class="col-xl-3 col-md-6">
                             <div class="card border-left-info shadow h-100">
                                 <div class="card-body">
                                     <div class="row no-gutters align-items-center">
                                         <div class="col mr-2">
                                             <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                 Diisi
                                             </div>
                                             <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                 {{ $data['perempuan']['diisi'] }}</div>
                                         </div>

                                     </div>
                                 </div>
                             </div>
                         </a>

                         {{-- Maintenance --}}
                         <a href="{{ url('kelola-data-kamar/data-kamar/perempuan?status=maintenance') }}"
                             class="col-xl-3 col-md-6">
                             <div class="card border-left-warning shadow h-100">
                                 <div class="card-body">
                                     <div class="row no-gutters align-items-center">
                                         <div class="col mr-2">
                                             <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                 Maintenance
                                             </div>
                                             <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                 {{ $data['perempuan']['maintenance'] }}</div>
                                         </div>

                                     </div>
                                 </div>
                             </div>
                         </a>

                     </div>
                 </div>
             </div>

         </div>
     </div>


 @endsection
