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

                {{-- Data Room Panel --}}
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('data-kamar*') ? 'active' : '' }}" href="/data-kamar"
                        aria-expanded="false" aria-current="page">
                        <span>
                            <i class="ti ti-bed"></i>
                        </span>
                        <span class="hide-menu">Data Kamar</span>
                    </a>
                </li>
                {{-- End Data Room Panel --}}

                {{-- Registration Room Panel --}}
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request()->is('registrasi-kamar*') ? 'active bg-primary rounded' : '' }}"
                        href="/registrasi-kamar" aria-expanded="false" aria-current="page">
                        <span>
                            <i class="ti ti-door-enter"></i>
                        </span>
                        <span class="hide-menu">Pendaftaran Kamar</span>
                    </a>
                </li>
                {{-- End Registration Room Panel --}}

                {{-- Paymen Panel --}}
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request()->is('payment*') ? 'active bg-primary rounded' : '' }}"
                        href="#" aria-expanded="false" aria-current="page">
                        <span>
                            <i class="ti ti-cash"></i>
                        </span>
                        <span class="hide-menu">Pembayaran</span>
                    </a>
                </li>
                {{-- End Payment Panel --}}

                <<<<<<< HEAD:resources/views/layouts/mahasiswa/sidebar.blade.php======={{-- Account Panel --}} <li
                    class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Account</span>
                    </li>
                    {{-- End Account Panel --}}

                    {{-- My Account Panel --}}
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request()->is('informasi-akun*') ? 'active bg-primary rounded' : '' }}"
                            href="/informasi-akun" aria-expanded="false" aria-current="page">
                            <span>
                                <i class="ti ti-user-check"></i>
                            </span>
                            <span class="hide-menu">My Account</span>
                        </a>
                    </li>
                    {{-- End My Account Panel --}}

                    {{-- Logout Panel --}}
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request()->is('logout*') ? 'active bg-primary rounded' : '' }}"
                            href="/logout" aria-expanded="false" aria-current="page">
                            <span>
                                <i class="ti ti-logout"></i>
                            </span>
                            <span class="hide-menu">Logout</span>
                        </a>
                    </li>
                    {{-- End Logout Panel --}}


                    >>>>>>> ae9435211a9d1a7973473b966169643180e0b88e:resources/views/layouts/sidebar.blade.php
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
