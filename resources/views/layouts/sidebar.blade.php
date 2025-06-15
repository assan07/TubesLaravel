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
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                {{-- Student Panel --}}
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request()->is('dataroom*') ? 'active bg-primary rounded' : '' }}"
                        href="#" aria-expanded="false" aria-current="page">
                        <span>
                            <i class="ti ti-bed"></i>
                        </span>
                        <span class="hide-menu">Data Kamar</span>
                    </a>
                </li>
                {{-- End Student Panel --}}

                {{-- Books Panel --}}
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request()->is('registrationroom*')  ? 'active bg-primary rounded' : '' }}" href="#" aria-expanded="false" aria-current="page">
                        <span>
                            <i class="ti ti-door-enter"></i>
                        </span>
                        <span class="hide-menu">Pendaftaran Kamar</span>
                    </a>
                </li>
                {{-- End Books Panel --}}

                {{-- Author Panel --}}
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request()->is('payment*')  ? 'active bg-primary rounded' : '' }}" href="#" aria-expanded="false" aria-current="page">
                        <span>
                            <i class="ti ti-cash"></i>
                        </span>
                        <span class="hide-menu">Pembayaran</span>
                    </a>
                </li>
                {{-- End Author Panel --}}

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->
