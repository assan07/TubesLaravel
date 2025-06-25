@extends('layouts.admin.app')

@section('title', 'Data Berkas Laki-Laki - Sistem Asrama Unidayan')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/admin/kelolaDataBerkasLakilaki.css') }}">

@section('main-content')
    <div class="container-fluid">
        <div class="col-12 col-md-10 col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Detail Berkas Pendaftaran Laki-Laki</h4>

                    <div class="info-row">
                        <div class="info-label">Nama Lengkap</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">{{ $data->nama }}</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">NIM</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">{{ $data->nim }}</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Jenis Kelamin</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">{{ $data->jenis_kelamin }}</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">No. Handphone</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">{{ $data->no_hp }}</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Email</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">{{ $data->email }}</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Nama Kamar</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">{{ $data->room->nama_kamar ?? '-' }}</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Tanggal Pendaftaran</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">{{ $data->tanggal_pendaftaran }}</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Total Bayar</div>
                        <div class="info-separator">:</div>
                        <div class="info-value text-success">Rp.250.000</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Status Berkas</div>
                        <div class="info-separator">:</div>

                        @if ($data->status_berkas == 'approved')
                            <div class="info-value text-success">{{ $data->status_berkas }}</div>
                        @elseif ($data->status_berkas == 'pending')
                            <div class="info-value text-warning">{{ $data->status_berkas }}</div>
                        @else
                            <div class="info-value text-danger">{{ $data->status_berkas }}</div>
                        @endif
                    </div>

                    <div class="btn-action d-flex justify-content-between">
                        <div class="mt-4 d-flex flex-wrap gap-2">
                            <form action="{{ route('admin.berkas.update-status', $data->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status_berkas" value="approved">
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                            </form>

                            <form action="{{ route('admin.berkas.update-status', $data->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status_berkas" value="pending">
                                <button type="submit" class="btn btn-warning btn-sm">Pending</button>
                            </form>

                            <form action="{{ route('admin.berkas.update-status', $data->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status_berkas" value="rejected">
                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        </div>

                        <div class="mt-4 d-flex flex-wrap gap-2">
                            {{-- Btn Back --}}
                            <a href="{{ route('admin.berkas.byGender', ['gender' => $gender]) }}"
                                class="btn btn-info btn-sm">
                                <i class="ti ti-logout fw-bold" style="font-size:1rem "></i>
                            </a>
                            {{-- End Btn Back --}}

                            {{-- Btn Download --}}
                            <a href="{{ route('admin.berkas.download', $data->id) }}" class="btn btn-secondary btn-sm">
                                <i class="ti ti-download fw-bold" style="font-size:1rem "></i>
                            </a>
                            {{-- End Btn Download --}}

                            {{-- Btn Delete --}}
                            <form action="{{ route('admin.berkas.delete', $data->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus berkas ini?')" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="btn btn-danger btn-sm {{ $data->status_berkas == 'rejected' ? '' : 'd-none' }}">
                                    <i class="ti ti-trash fw-bold" style="font-size:1rem"></i>
                                </button>
                            </form>

                            {{-- EndBtn Delete --}}

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    {{-- Push JS --}}
    @push('scripts')
        {{-- <script src="{{ asset('assets/js/mahasiswa/login_mahasiswa.js') }}"></script> --}}
    @endpush

@endsection
