 @extends('layouts.app')

 @section('title', 'Informasi Data Kamar - Sistem Asrama Unidayan')
 @section('css')
     {{-- <link rel="stylesheet" href="{{ asset('assets/css/mahasiswa/login_mahasiswa.css') }}"> --}}

 @section('main-content')

     <div class="container">
         <div class="row justify-content-center">
             <div class="col-md-12">
                 <div class="card">
                     <div class="card-header text-center">
                         <h4>Informasi Data Kamar</h4>
                     </div>

                     <div class="card-body ">
                         <p>Berikut adalah informasi data kamar yang tersedia di asrama Unidayan.</p>
                     </div>
                 </div>
                 <div class="room-boy">
                     <h1><strong>Kamar Laki-Laki</strong></h1>
                     <div class="d-flex row-cols-md-6 gap-3">
                         <div class="card">
                             <div class="card-header text-center">
                                 <h4>Informasi Data Kamar</h4>
                             </div>

                             <div class="card-body ">
                                 <div class="card-1">40</div>
                             </div>
                         </div>
                         <div class="card">
                             <div class="card-header text-center">
                                 <h4>Informasi Data Kamar</h4>
                             </div>

                             <div class="card-body ">
                                 <div class="card-1">40</div>
                             </div>
                         </div>
                         <div class="card">
                             <div class="card-header text-center">
                                 <h4>Informasi Data Kamar</h4>
                             </div>

                             <div class="card-body ">
                                 <div class="card-1">40</div>
                             </div>
                         </div>
                         <div class="card">
                             <div class="card-header text-center">
                                 <h4>Informasi Data Kamar</h4>
                             </div>

                             <div class="card-body ">
                                 <div class="card-1">40</div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="room-girl">
                     <h1><strong>Kamar Perempuan</strong></h1>
                     <div class="d-flex row-cols-md-6 gap-3">
                         <div class="card">
                             <div class="card-header text-center">
                                 <h4>Informasi Data Kamar</h4>
                             </div>

                             <div class="card-body ">
                                 <div class="card-1">40</div>
                             </div>
                         </div>
                         <div class="card">
                             <div class="card-header text-center">
                                 <h4>Informasi Data Kamar</h4>
                             </div>

                             <div class="card-body ">
                                 <div class="card-1">40</div>
                             </div>
                         </div>
                         <div class="card">
                             <div class="card-header text-center">
                                 <h4>Informasi Data Kamar</h4>
                             </div>

                             <div class="card-body ">
                                 <div class="card-1">40</div>
                             </div>
                         </div>
                         <div class="card">
                             <div class="card-header text-center">
                                 <h4>Informasi Data Kamar</h4>
                             </div>

                             <div class="card-body ">
                                 <div class="card-1">40</div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

 @endsection
