@extends('layouts.mahasiswa.app')

@section('title', 'Riwayat Pembayaran Kamar - Sistem Asrama Unidayan')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/admin/kelolaDataBerkas.css') }}">
@endsection

@section('main-content')
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Riwayat Pembayaran Kamar</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Kamar</th>
                            <th>Bulan</th>
                            <th>Tanggal Bayar</th>
                            <th>Nominal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($riwayat as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                {{-- Ambil nama kamar dari relasi --}}
                                <td>{{ $item->user->pendaftaranKamar->room->nama_kamar ?? '-' }}</td>

                                {{-- Bulan --}}
                                <td>{{ $bulanList[$item->bulan] ?? ucfirst($item->bulan) }} {{ $item->tahun }}</td>

                                {{-- Tanggal bayar --}}
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_bayar)->translatedFormat('d F Y') }}</td>

                                {{-- Harga --}}
                                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>

                                {{-- Status --}}
                                <td>
                                    @if ($item->status_pembayaran == 'lunas')
                                        <span class="badge bg-success">Lunas</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    @endif
                                </td>
                                <td class=" d-flex gap-2">
                                    <a href="{{ route('riwayat.download', $item->id) }}" class="btn btn-sm btn-success" title="Unduh Bukti"><i
                                            class="ti ti-file-download" ></i></a>

                                    <form action="{{ route('riwayat.destroy', $item->id) }}" method="POST"
                                        class="d-inline delete-form" title="Hapus">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" ><i class="ti ti-trash"
                                                style="font-size: 1rem"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada riwayat pembayaran.</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @push('scripts')
        {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
        <script src="{{ asset('assets/js/mahasiswa/riwayatPembayaran.js') }}"></script>
    @endpush
@endsection
