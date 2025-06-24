<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Mahasiswa - Sistem Asrama Unidayan</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main/styles.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/mahasiswa/register_mahasiswa.css') }}">
</head>

<body>

    <div class="container-fluid register-container">
        <div class="row w-100">
            <!-- Left Section - Image -->
            <div class="col-lg-6 col-md-6 d-none d-md-block p-0">
                <div class="left-section">
                    <div class="left-content col-lg-11 col-md-5 d-none d-md-block position-absolute ">
                        <div class="image-container col-lg-12 h-100 w-100 position-relative ">
                            <div class="overlay"></div>
                            <div class="content-welcome">
                                <div class="university-icon">
                                    <i class="fas fa-university"></i>
                                </div>
                                <h1>Selamat Datang</h1>

                            </div>
                            <img src="{{ asset('assets/images/auth_img/hostel.png') }}" alt="Background Image"
                                class="img-fluid h-50 w-50 object-fit-cover">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Section - Registration Form -->
            <div class="col-lg-6 col-md-6 col-12">
                <div class="right-section">
                    <div class="card register-card">
                        <div class="register-header">
                            <h2>Daftar Mahasiswa</h2>
                            <p>Lengkapi data diri Anda untuk membuat akun</p>
                        </div>

                        <form id="registerForm" action="{{ route('register.submit') }}" method="POST">
                            @csrf

                            {{-- Nama --}}
                            <div class="form-group">
                                <label for="nama"><i class="fas fa-user me-2"></i>Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" value="{{ old('nama') }}">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback js-error" id="nama-error"></div>
                            </div>

                            {{-- NIM --}}
                            <div class="form-group">
                                <label for="nim"><i class="fas fa-id-card me-2"></i>NIM</label>
                                <input type="text" class="form-control @error('nim') is-invalid @enderror"
                                    id="nim" name="nim" value="{{ old('nim') }}">
                                @error('nim')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback js-error" id="nim-error"></div>
                            </div>

                            {{-- Email --}}
                            <div class="form-group">
                                <label for="email"><i class="fas fa-envelope me-2"></i>Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback js-error" id="email-error"></div>
                            </div>

                            {{-- Password --}}

                            <div class="form-group">
                                <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                                <div class="position-relative w-100">

                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="invalid-feedback js-error" id="password-error"></div>
                                    <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                        <i class="fas fa-eye" id="password-icon"></i>
                                    </button>
                                </div>
                            </div>

                            {{-- Konfirmasi Password --}}
                            <div class="form-group">
                                <label for="password_confirmation"><i class="fas fa-lock me-2"></i>Konfirmasi
                                    Password</label>

                                <div class="position-relative w-100">

                                    <input type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        id="password_confirmation" name="password_confirmation"
                                        autocomplete="new-password">
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="invalid-feedback js-error" id="password_confirmation-error"></div>
                                    <button type="button" class="password-toggle"
                                        onclick="togglePassword('password_confirmation')">
                                        <i class="fas fa-eye" id="password_confirmation-icon"></i>
                                    </button>
                                </div>
                            </div>

                            {{-- Terms --}}
                            <div class="form-check my-3">
                                <input class="form-check-input" type="checkbox" name="terms" id="terms" required
                                    {{ old('terms') ? 'checked' : '' }}>
                                <label class="form-check-label" for="terms">
                                    Saya setuju dengan <a href="#">Syarat dan Ketentuan</a>
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary btn-register" id="submitBtn">
                                <span class="btn-text">Daftar Sekarang</span>
                                <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                            </button>

                            <!-- Login Link -->
                            <div class="login-link">
                                <p>Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Costum JS -->
    <script src="{{ asset('assets/js/mahasiswa/registerMahasiswa.js') }}"></script>

</body>

</html>
