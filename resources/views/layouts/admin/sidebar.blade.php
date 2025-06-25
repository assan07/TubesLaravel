<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="/" class="text-nowrap logo-img d-flex justify-center align-content-center">
                <img src="{{ asset('assets/images/auth_img/hostel.png') }}" width="50" alt="" />
                <span class="fw-bolder fs-5 text-center mt-2">Si-Asrama UI</span>
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                {{-- Home Panel --}}
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                {{-- End Home Panel --}}

                {{-- Manage Room Data Panel --}}
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('kelola-data-kamar*') ? 'active' : '' }}"
                        href="/kelola-data-kamar" aria-expanded="false" aria-current="page">
                        <span>
                            <i class="ti ti-bed"></i>
                        </span>
                        <span class="hide-menu">Kelola Data Kamar</span>
                    </a>
                </li>
                {{-- End Manage Room Data Panel --}}

                {{-- Manage Residents Data Panel --}}
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request()->is('admin/registrasi-kamar*') ? 'active bg-primary rounded' : '' }}"
                        href="/admin/kelola-data-penghuni" aria-expanded="false" aria-current="page">
                        <span>
                            <i class="ti ti-door-enter"></i>
                        </span>
                        <span class="hide-menu">Kelola Data Penghuni</span>
                    </a>
                </li>
                {{-- End Manage Residents Data Panel --}}

                {{-- Manage Account Data Panel --}}
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request()->is('kelola-data-akun*') ? 'active bg-primary rounded' : '' }}"
                        href="/kelola-data-akun" aria-expanded="false" aria-current="page">
                        <span>
                            <i class="ti ti-user-exclamation"></i>
                        </span>
                        <span class="hide-menu">Kelola Data Akun</span>
                    </a>
                </li>
                {{-- End Manage Account Data Panel --}}

                {{-- Registration File Panel --}}
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request()->is('admin/kelola-berkas-pendaftaran*') ? 'active bg-primary rounded' : '' }}"
                        href="{{ url('/admin/kelola-berkas-pendaftaran') }}" aria-expanded="false" aria-current="page">
                        <span>
                            <i class="ti ti-pencil-plus"></i>
                        </span>
                        <span class="hide-menu">Cek Berkas Pendaftaran</span>
                    </a>
                </li>
                {{-- End Registration File Panel --}}

            </ul>

            <div class="card-sidebar-buttom d-flex flex-column flex-wrap-reverse p-lg-2 p-md-1 p-1">
                <div class="sub-card-buttom text-center m-lg-1 ">
                    <strong>Asrama UNIDAYAN</strong>
                    <p>Tempat nyaman untuk belajar dan berkembang menjadi pribadi tangguh!</p>

                    <div class="mt-1">
                        <i class="fas fa-graduation-cap me-3" style="font-size: 1rem;"></i>
                        <i class="fas fa-book me-3" style="font-size: 1rem;"></i>
                        <i class="fas fa-users" style="font-size: 1rem;"></i>
                    </div>

                </div>
            </div>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->
