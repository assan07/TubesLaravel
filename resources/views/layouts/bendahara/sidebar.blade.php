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
        <nav class="sidebar-nav scroll-sidebar " data-simplebar="">
            <div class="sidebar-item h-100 d-flex flex-column justify-content-between">
                <div class="sidebar-menu-link">
                    <ul id="sidebarnav">
                        {{-- Home Panel --}}
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Home</span>
                        </li>
                        {{-- End Home Panel --}}

                        {{-- Manage Room Data Panel --}}
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ request()->routeIs('bendahara.*') ? 'active' : '' }}"
                                href="{{ route('bendahara.pembayaran.index') }}" aria-expanded="false" aria-current="page">
                                <span>
                                    <i class="ti ti-credit-card"></i>
                                </span>
                                <span class="hide-menu">Cek Pembayaran</span>
                            </a>
                        </li>
                        {{-- End Manage Room Data Panel --}}

                    </ul>
                </div>

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
            </div>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->
