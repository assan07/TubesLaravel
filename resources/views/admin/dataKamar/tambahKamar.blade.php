 @extends('layouts.admin.app')

 @section('title', 'Informasi Data Kamar - Sistem Asrama Unidayan')
 @section('css')
     <link rel="stylesheet" href="{{ asset('assets/css/admin/informasidatakamar.css') }}">

 @section('main-content')

     <div class="container mt-4">
         <div class="row justify-content-center">
             <div class="col-12 col-md-8 col-lg-6">
                 <div class="card shadow">
                     <div class="card-header bg-primary text-white">
                         <h5 class="mb-0">Form Input Kamar</h5>
                     </div>
                     <div class="card-body">
                         <form action="{{ url('/kelola-data-kamar/tambah-kamar/store') }}" method="POST">
                             @csrf

                             {{-- Jenis Kamar --}}
                             <div class="mb-3">
                                 <label for="jenis_kamar" class="form-label">Jenis Kamar</label>
                                 <select class="form-select" name="jenis_kamar" id="jenis_kamar" required>
                                     <option value="">-- Pilih Jenis Kamar --</option>
                                     <option value="laki-laki">Laki-Laki</option>
                                     <option value="perempuan">Perempuan</option>
                                 </select>
                             </div>

                             {{-- Nama Kamar --}}
                             <div class="mb-3">
                                 <label for="nama_kamar" class="form-label">Nama Kamar</label>
                                 <input type="text" class="form-control" id="nama_kamar" name="nama_kamar"
                                     placeholder="Contoh: Kamar-A1-L" required>
                                     <span class="fw-light" style="font-size: 11px"><Strong>Note: </Strong>Beri kode "L" / "P" diakhir nama kamar sebagai tanda jenis kamar.</span>
                             </div>

                             {{-- No. Kamar --}}
                             <div class="mb-3">
                                 <label for="no_kamar" class="form-label">Nomor Kamar</label>
                                 <input type="text" class="form-control" id="no_kamar" name="no_kamar"
                                     placeholder="Contoh: A12" required>
                             </div>

                             {{-- Lokasi Kamar --}}
                             <div class="mb-3">
                                 <label for="lokasi_kamar" class="form-label">Lokasi Kamar</label>
                                 <input type="text" class="form-control" id="lokasi_kamar" name="lokasi_kamar"
                                     placeholder="Contoh: Lantai 1 / Sayap Timur" required>
                             </div>


                             {{-- Status --}}
                             <div class="mb-3">
                                 <label for="status" class="form-label">Status Kamar</label>
                                 <select class="form-select" name="status" id="status" required>
                                     <option value="">-- Pilih Status --</option>
                                     <option value="tersedia">Tersedia</option>
                                     <option value="diisi">Diisi</option>
                                     <option value="maintenance">Maintenance</option>
                                 </select>
                             </div>

                             <div class="d-grid gap-3">
                                 <button type="submit" class="btn btn-primary">Simpan Data Kamar</button>
                                 <a href="{{ url('/admin/kelola-data-kamar') }}" class="btn btn-info">Kembali</a>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>


 @endsection
