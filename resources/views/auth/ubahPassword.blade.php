@extends('layouts.mahasiswa.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/mahasiswa/ubah_password.css') }}">
@section('main-content')
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-9 col-lg-10 col-xl-11">
                <div class="card password-header">
                    <h3><i class="fas fa-key me-2"></i>Ubah Password</h3>
                </div>
                <div class="password-container">
                    
                    <div class="security-tips">
                        <h6><i class="fas fa-shield-alt me-1"></i>Tips Keamanan Password:</h6>
                        <ul>
                            <li>Gunakan minimal 8 karakter</li>
                            <li>Kombinasikan huruf besar, kecil dan angka</li>
                            <li>Hindari informasi pribadi dalam password</li>
                            <li>Jangan gunakan password yang sama di tempat lain</li>
                        </ul>
                    </div>

                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope"></i>Email Anda
                            </label>
                            <div class="password-input-wrapper">
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', Auth::user()->email) }}" placeholder="Masukkan email Anda">

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="current_password" class="form-label">
                                <i class="fas fa-lock"></i>Password Lama
                            </label>
                            <div class="password-input-wrapper ">
                                <input type="password" name="current_password" id="current_password"
                                    class="form-control  @error('current_password') is-invalid @enderror"
                                    placeholder="Masukkan password lama">
                                <i class="fas fa-eye toggle-password" onclick="togglePassword('current_password')"></i>
                                @error('current_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="new_password" class="form-label">
                                <i class="fas fa-key"></i>Password Baru
                            </label>
                            <div class="password-input-wrapper">
                                <input type="password" name="new_password" id="new_password"
                                    class="form-control @error('new_password') is-invalid @enderror""
                                    placeholder="Masukkan password baru" onkeyup="checkPasswordStrength()">
                                <i class="fas fa-eye toggle-password" onclick="togglePassword('new_password')"></i>

                                @error('new_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="password-strength">
                                <div class="strength-bar" id="strengthBar"></div>
                            </div>
                            <div class="strength-text" id="strengthText"></div>
                        </div>

                        <div class="form-group">
                            <label for="new_password_confirmation" class="form-label">
                                <i class="fas fa-check-circle"></i>Konfirmasi Password
                            </label>
                            <div class="password-input-wrapper">
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                    class="form-control @error('new_password_confirmation') is-invalid @enderror""
                                    placeholder="Konfirmasi password baru">
                                @error('new_password_confirmation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <i class="fas fa-eye toggle-password"
                                    onclick="togglePassword('new_password_confirmation')"></i>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('assets/js/mahasiswa/ubahPassword.js') }}"></script>
    @endpush
@endsection
