@extends('layouts.admin.app')

@section('title', 'Kelola Data Akun - Sistem Asrama Unidayan')
@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/mahasiswa/informasidatakamar.css') }}"> --}}

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Kelola Data Akun</h4>
                        <p class="card-subtitle">Berikut adalah data akun yang terdaftar di sistem asrama Unidayan</p>
                        <div class="table-responsive">
                            <table id="kelolaDataAkun" class="table table-striped table-bordered">
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
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                                </form>

                                                <form action="/akun/{{ $user->id }}/pending" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-warning btn-sm">Pending</button>
                                                </form>

                                                <form action="/akun/{{ $user->id }}" method="POST" class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus akun ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
