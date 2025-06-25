 @extends('layouts.mahasiswa.app')

 @section('title', 'Informasi Data Kamar - Sistem Asrama Unidayan')
 @section('css')
     <link rel="stylesheet" href="{{ asset('assets/css/mahasiswa/informasidatakamar.css') }}">

 @section('main-content')

     <div class="container">
         <div class="row justify-content-center">
             <div class="col-md-12 d-flex flex-column ">
                 <div class="card">
                     <div class="card-header text-center">
                         <h4>Informasi Data Kamar</h4>
                     </div>
                 </div>
                 {{--card room boy info --}}

                 <div class="room-guy card col-sm-12 col-md-12 d-flex flex-column p-4 gap-3">
                     <h1><strong>Kamar Laki-Laki</strong></h1>
                     <div class="card-room-guy row-lg-12 col-md-12 col-sm-12 d-flex gap-3">
                         <div class="card-room bg-primary w-100 rounded d-flex flex-column align-items-center p-2">
                             <div
                                 class="sub-card bg-white w-100 rounded d-flex align-items-center justify-content-center p-2 text-center">
                                 <h1 style="font-weight: bolder">{{ $data['laki']['total'] }}</h1>
                             </div>
                             <strong>Total</strong>
                         </div>
                         <div class="card-room bg-secondary w-100 rounded d-flex flex-column align-items-center p-2">
                             <div
                                 class="sub-card bg-white w-100 rounded d-flex align-items-center justify-content-center p-2 text-center">
                                 <h1 style="font-weight: bolder">{{ $data['laki']['tersedia'] }}</h1>
                             </div>
                             <strong>Tersedia</strong>
                         </div>
                         <div class="card-room bg-info w-100 rounded d-flex flex-column align-items-center p-2">
                             <div
                                 class="sub-card bg-white w-100 rounded d-flex align-items-center justify-content-center p-2 text-center">
                                 <h1 style="font-weight: bolder">{{ $data['laki']['diisi'] }}</h1>
                             </div>
                             <strong>Diisi</strong>
                         </div>
                         <div class="card-room bg-warning w-100 rounded d-flex flex-column align-items-center p-2">
                             <div
                                 class="sub-card bg-white w-100 rounded d-flex align-items-center justify-content-center p-2 text-center">
                                 <h1 style="font-weight: bolder">{{ $data['laki']['maintenance'] }}</h1>
                             </div>
                             <strong>Maintenanca</strong>
                         </div>
                     </div>
                 </div>
                 {{-- end card room boy info --}}
                 
                 {{--card room girl info --}}
                 <div class="room-girl card col-sm-12 col-md-12 d-flex flex-column p-4 gap-3">
                     <h1><strong>Kamar Perempuan</strong></h1>
                     <div class="card-room-girl row-lg-12 col-md-12 col-sm-12 d-flex gap-3">
                         <div class="card-room bg-primary w-100 rounded d-flex flex-column align-items-center p-2">
                             <div
                                 class="sub-card bg-white w-100 rounded d-flex align-items-center justify-content-center p-2 text-center">
                                 <h1 style="font-weight: bolder">{{ $data['perempuan']['total'] }}</h1>
                             </div>
                             <strong>Total</strong>
                         </div>
                         <div class="card-room bg-secondary w-100 rounded d-flex flex-column align-items-center p-2">
                             <div
                                 class="sub-card bg-white w-100 rounded d-flex align-items-center justify-content-center p-2 text-center">
                                 <h1 style="font-weight: bolder">{{ $data['perempuan']['tersedia'] }}</h1>
                             </div>
                             <strong>Tersedia</strong>
                         </div>
                         <div class="card-room bg-info w-100 rounded d-flex flex-column align-items-center p-2">
                             <div
                                 class="sub-card bg-white w-100 rounded d-flex align-items-center justify-content-center p-2 text-center">
                                 <h1 style="font-weight: bolder">{{ $data['perempuan']['diisi'] }}</h1>
                             </div>
                             <strong>Diisi</strong>
                         </div>
                         <div class="card-room bg-warning w-100 rounded d-flex flex-column align-items-center p-2">
                             <div
                                 class="sub-card bg-white w-100 rounded d-flex align-items-center justify-content-center p-2 text-center">
                                 <h1 style="font-weight: bolder">{{ $data['perempuan']['maintenance'] }}</h1>
                             </div>
                             <strong>Maintenanca</strong>
                         </div>
                     </div>
                 </div>
                 {{--end card room girl info --}}
                 
             </div>
         </div>
     </div>

 @endsection
