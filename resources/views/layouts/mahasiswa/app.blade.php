<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Asrama Unidayan')</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main/styles.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/sidebarmenu.css') }}">
    <link rel="stylesheet" href="@yield('css')">
</head>

<body>
   <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        {{-- Sidebar Start --}}
        @include('layouts.mahasiswa.sidebar')
        {{-- Sidebar End --}}

        <!--  Page Wrapper -->
        {{-- Header Start --}}
        <div class="body-wrapper">
            @include('layouts.mahasiswa.header')
            {{-- Header End --}}
            <div class="container-fluid">
                @yield('main-content')
            </div>
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>

    <!-- Custom JS -->
    @stack('scripts')

</body>

</html>
