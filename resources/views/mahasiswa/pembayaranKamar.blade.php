@extends('layouts.mahasiswa.app')

@section('title', 'Pembayaran Kamar - Sistem Asrama Unidayan')
@section('main-content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                {{-- Judul --}}
                <div class="card mb-4">
                    <div class="card-header text-center">
                        <h4>Pembayaran Kamar Asrama</h4>
                    </div>
                </div>

                {{-- Form Pembayaran --}}
                <form action="{{ url('/pembayaran-kamar/payment') }}" method="POST">
                    @csrf

                    <div class="card shadow-sm p-4">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                @if ($mahasiswa && $mahasiswa->foto)
                                    <img src="{{ asset('storage/' . $mahasiswa->foto) }}"
                                        class="rounded-circle img-fluid mb-2" style="max-width: 120px;">
                                @else
                                    <img src="{{ asset('assets/images/profile/user-1.jpg') }}"
                                        class="rounded-circle img-fluid mb-2" style="max-width: 120px;">
                                @endif
                                <p class="text-muted">Foto Mahasiswa</p>
                            </div>

                            {{-- Detail Mahasiswa --}}
                            <div class="col-md-8">
                                <div class="mb-2"><strong>Nama Lengkap:</strong> {{ $user->nama }}</div>
                                <div class="mb-2"><strong>Email:</strong> {{ $user->email }}</div>
                                <div class="mb-2"><strong>NIM:</strong> {{ $user->nim }}</div>
                                <div class="mb-2"><strong>Alamat:</strong> {{ $mahasiswa->alamat ?? '-' }}</div>
                                <div class="mb-2"><strong>No. HP:</strong> {{ $mahasiswa->phone ?? '-' }}</div>
                                <div class="mb-2"><strong>Harga Sewa per Bulan:</strong> Rp
                                    {{ number_format($harga, 0, ',', '.') }}</div>

                                {{-- Pilih Bulan --}}
                                <div class="mb-4 mt-3">
                                    <label for="bulan" class="form-label"><strong>Pilih Bulan
                                            Pembayaran:</strong></label>
                                    <select class="form-control" id="bulan" name="bulan" required>
                                        <option value="" disabled selected>-- Pilih Bulan --</option>
                                        @foreach ($bulanList as $bulan)
                                            <option value="{{ $bulan }}">{{ ucfirst($bulan) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Tombol Bayar --}}
                                <div class="text-end">
                                    <button type="submit" class="btn btn-dark">Bayar Sekarang</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                {{-- End Form --}}
            </div>
        </div>
    </div>

@endsection
