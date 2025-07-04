<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="/" class="text-nowrap logo-img d-flex justify-center align-content-center">
                <img src="{{ asset('assets/images/auth_img/hostel.png') }}" width="50" alt="" />
                <span class="fw-bolder fs-5 text-center mt-2">Si-Asrama</span>
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
                    <a class="sidebar-link {{ Request()->is('pendaftaran-kamar*') ? 'active bg-primary rounded' : '' }}"
                        href="{{ route('pendaftaran-kamar.create') }}" aria-expanded="false" aria-current="page">
                        <span>
                            <i class="ti ti-door-enter"></i>
                        </span>
                        <span class="hide-menu">Pendaftaran Kamar</span>
                    </a>
                </li>
                {{-- End Registration Room Panel --}}

                {{-- Payment Panel --}}
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request()->is('pembayaran-kamar*') ? 'active bg-primary rounded' : '' }}"
                        href="/pembayaran-kamar" aria-expanded="false" aria-current="page">
                        <span>
                            <i class="ti ti-cash"></i>
                        </span>
                        <span class="hide-menu">Pembayaran</span>
                    </a>
                </li>
                {{-- End Payment Panel --}}

                {{-- Payment history --}}
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request()->is('riwayat-pembayaran*') ? 'active bg-primary rounded' : '' }}"
                        href="{{ url('/riwayat-pembayaran') }}" aria-expanded="false" aria-current="page">
                        <span>
                            <i class="ti ti-cash"></i>
                        </span>
                        <span class="hide-menu">Riwayar Pembayaran</span>
                    </a>
                </li>
                {{-- End Payment history --}}


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
