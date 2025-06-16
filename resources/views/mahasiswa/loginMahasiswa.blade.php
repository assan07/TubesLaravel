<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mahasiswa - Sistem Asrama Unidayan</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/mahasiswa/login_mahasiswa.css') }}">
</head>

<body>
    <div class="login-container w-100 vh-100 d-flex align-items-center justify-content-center">
        <div class="container-fluid vh-100">
            <div class="row h-100 g-0 ">
                <!-- Left Side - Login Form -->
                <div class="col-lg-6 col-md-7 d-flex align-items-center justify-content-center p-4">
                    <div class="login-card-container w-100">
                        <!-- Logo & Title -->
                        <div class="text-center mb-4">
                            {{-- <div class="logo-container mb-3">
                                    <i class="fas fa-building fa-3x text-primary"></i>
                                </div> --}}
                            <h2 class="fw-bold text-dark mb-2">Selamat Datang</h2>
                            <p class="text-muted">Sistem Manajemen Asrama Mahasiswa Unidayan</p>
                        </div>

                        <!-- Login Card -->
                        <div class="card shadow-lg border-0 rounded-4">
                            <div class="card-body p-4">
                                <h4 class="card-title text-center mb-4 fw-semibold">Login Mahasiswa</h4>

                                <!-- Alert untuk Error Messages -->
                                {{-- @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        <ul class="mb-0 list-unstyled">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fas fa-check-circle me-2"></i>
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif --}}

                                <!-- Login Form -->
                                <form method="POST" action="/login/user" id="loginForm">
                                    @csrf

                                    <!-- Email/NIM Input -->
                                    <div class="mb-3">
                                        <label for="nim" class="form-label fw-medium">
                                            <i class="fas fa-user me-2 text-primary"></i>NIM atau Email
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text border-end-0 bg-light">
                                                <i class="fas fa-id-card text-muted"></i>
                                            </span>
                                            <input type="text"
                                                class="form-control border-start-0 @error('nim') is-invalid @enderror"
                                                id="nim" name="nim" value="{{ old('nim') }}"
                                                placeholder="Masukkan NIM atau Email Anda" required>
                                        </div>
                                        @error('nim')
                                            <div class="invalid-feedback d-block">
                                                <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Password Input -->
                                    <div class="mb-3">
                                        <label for="password" class="form-label fw-medium">
                                            <i class="fas fa-lock me-2 text-primary"></i>Password
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text border-end-0 bg-light">
                                                <i class="fas fa-key text-muted"></i>
                                            </span>
                                            <input type="password"
                                                class="form-control border-start-0 border-end-0  @error('password') is-invalid @enderror"
                                                id="password" name="password" placeholder="Masukkan Password Anda"
                                                required>
                                            <button class="btn btn-outline-secondary border-start-0" type="button"
                                                id="togglePassword">
                                                <i class="fas fa-eye" id="eyeIcon"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback d-block">
                                                {{-- <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }} --}}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Remember Me & Forgot Password -->
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                id="remember">
                                            <label class="form-check-label text-sm" for="remember">
                                                Ingat Saya
                                            </label>
                                        </div>
                                        {{-- <a href="{{ route('password.request') }}"
                                            class="text-decoration-none text-primary text-sm">
                                            Lupa Password?
                                        </a> --}}
                                    </div>

                                    <!-- Login Button -->
                                    <div class="d-grid mb-3">
                                        <button type="submit" class="btn btn-primary btn-lg fw-semibold py-3"
                                            id="loginBtn">
                                            <span class="btn-text">
                                                <i class="fas fa-sign-in-alt me-2"></i>Masuk
                                            </span>
                                            <span class="btn-loading d-none">
                                                <span class="spinner-border spinner-border-sm me-2"></span>
                                                Memproses...
                                            </span>
                                        </button>
                                    </div>

                                    <!-- Register Link -->
                                    <div class="text-center">
                                        <p class="text-muted mb-0">
                                            Belum punya akun?
                                            <a href='/register'
                                                class="text-primary text-decoration-none fw-medium">
                                                Daftar Sekarang
                                            </a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                            <!-- Additional Info -->
                            <div class="text-center mt-2 bottom-1">
                                <small class="text-muted">
                                    <i class="fas fa-shield-alt me-1"></i>
                                    Data Anda aman dan terenkripsi
                                </small>
                            </div>
                        </div>


                    </div>
                </div>

                <!-- Right Side - Image -->
                <div class="rigth-side col-lg-11 col-md-5 d-none d-md-block position-absolute ">
                    <div class="image-container col-lg-12 h-100 w-100 position-relative ">
                        <!-- Background Overlay -->
                        <div class="image-overlay position-absolute w-100 h-100"></div>

                        <!-- Background Image -->
                        <img src="{{ asset('assets/images/auth_img/hostel.png') }}" alt="Gedung Asrama Mahasiswa"
                            class=" object-fit-cover overflow-hidden">



                        <!-- Bottom Info -->
                        <div class="position-absolute bottom-0 start-0 w-100 p-2">
                            <div class="row text-dark">
                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small class="opacity-75">© 2024 Universitas Dayanu Ikhsanuddin</small>
                                        </div>
                                        <div>
                                            <small class="opacity-75">
                                                <i class="fas fa-phone me-1"></i>
                                                Hubungi: (021) 123-4567
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Costum JS -->
    <script src="{{ asset('assets/js/mahasiswa/loginMahasiswa.js') }}"></script>

</body>

</html>
