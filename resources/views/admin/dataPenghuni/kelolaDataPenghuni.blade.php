@extends('layouts.admin.app')

@section('title', 'Kelola Data Penghuni - Sistem Asrama Unidayan')

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        {{-- Header + Search --}}
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h4 class="card-title mb-0">Kelola Data Penghuni</h4>
                                <small class="text-muted">
                                    Berikut adalah data Penghuni yang terdaftar di sistem asrama Unidayan
                                </small>
                            </div>

                            <form action="{{ url('/search-akun') }}" method="GET" class="d-flex align-items-center"
                                id="searchForm">
                                <label for="search">Search</label>
                                <input type="text" class="form-control mx-2" placeholder="Cari Nama atau nim"
                                    value="{{ request('search') }}">
                            </form>
                        </div>

                        {{-- Tabel --}}
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIM</th>
                                        <th>Email</th>
                                        <th>Nama Kamar</th>
                                        <th>No Kamar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($users->count() > 0)
                                        @foreach ($users as $index => $user)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $user->nama }}</td>
                                                <td>{{ $user->nim }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ optional($user->pendaftaranKamar->room)->nama_kamar ?? '-' }}</td>
                                                <td>{{ optional($user->pendaftaranKamar->room)->no_kamar ?? '-' }}</td>
                                                <td class="d-flex gap-1">
                                                    {{-- Tombol Edit --}}
                                                    <a href="{{ url('/penghuni/' . $user->id . '/edit') }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="ti ti-edit" style="font-size: 1rem"></i>
                                                    </a>

                                                    {{-- Tombol Hapus --}}
                                                    <form action="{{ url('/penghuni/' . $user->id) }}" method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus penghuni ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="ti ti-trash" style="font-size: 1rem"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">
                                                Akun yang Anda cari tidak ditemukan.
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div> {{-- table-responsive --}}
                    </div> {{-- card-body --}}

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const searchInput = document.querySelector('input[name="search"]');
        const form = document.getElementById('searchForm');

        searchInput.addEventListener('input', () => {
            clearTimeout(window._searchTimer);
            window._searchTimer = setTimeout(() => {
                form.submit();
            }, 500);
        });
    </script>
@endpush
