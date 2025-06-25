@extends('layouts.admin.app')

@section('title', 'Kelola Data Akun - Sistem Asrama Unidayan')

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        {{-- Header + Search --}}
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h4 class="card-title mb-0">Kelola Data Akun</h4>
                                <small class="text-muted">
                                    Berikut adalah data akun yang terdaftar di sistem asrama Unidayan
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
                                        <th>Role</th>
                                        <th>Status</th>
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
                                                <td>{{ ucfirst($user->role) }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $user->is_approved ? 'success' : 'warning' }}">
                                                        {{ $user->is_approved ? 'Approve' : 'Pending' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <form action="/akun/{{ $user->id }}/approve" method="POST"
                                                        class="d-inline">
                                                        @csrf @method('PUT')
                                                        <button type="submit"
                                                            class="btn btn-success btn-sm">Approve</button>
                                                    </form>
                                                    <form action="/akun/{{ $user->id }}/pending" method="POST"
                                                        class="d-inline">
                                                        @csrf @method('PUT')
                                                        <button type="submit"
                                                            class="btn btn-warning btn-sm">Pending</button>
                                                    </form>
                                                    <form action="/akun/{{ $user->id }}" method="POST"
                                                        class="d-inline"
                                                        onsubmit="return confirm('Yakin ingin menghapus akun ini?');">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">Akun yang Anda cari tidak
                                                ditemukan.</td>
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

    {{-- Auto Search JS --}}
    @push('scripts')
        <script>
            const searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('input', function() {
                clearTimeout(this.delay);
                this.delay = setTimeout(() => {
                    document.getElementById('searchForm').submit();
                }, 500); // delay agar tidak terlalu sering reload
            });
        </script>
    @endpush
@endsection
