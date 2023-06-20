<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">e SPPD</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-legacy" data-widget="treeview" role="menu"
                data-accordion="false">
               
                <li class="nav-item mt-3">
                    <a href="{{ url('dashboard/dashboard-v1') }}" class="nav-link {{ request()->is('dashboard/dashboard-v1') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-header mt-3">DEVELOPMENT</li>
                <li class="nav-item {{ request()->segment(3) == 'sppd' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            SPPD
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('dashboard/admin/sppd/create') }}"
                                class="nav-link {{ request()->is('dashboard/admin/sppd/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Form SPPD</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('dashboard/admin/sppd') }}"
                                class="nav-link {{ request()->is('dashboard/admin/sppd') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>SPPD Aktif</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header mt-3">REPORT</li>
                <li class="nav-item">
                    <a href="{{ url('dashboard/admin/biaya-sppd') }}" class="nav-link {{ request()->is('dashboard/admin/biaya-sppd') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Biaya SPPD
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('dashboard/admin/pelaksana-sppd') }}" class="nav-link {{ request()->is('dashboard/admin/biaya-sppd') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Pelaksana SPPD
                        </p>
                    </a>
                </li>

                <li class="nav-header mt-3">SETTINGS</li>
                <li class="nav-item {{ request()->segment(3) == 'pegawai' ? 'menu-open' : '' }}">
                    <a href="{{ url('dashboard/admin/pegawai') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Master Pegawai
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ request()->segment(3) == 'admin' ? 'menu-open' : '' }}">
                    <a href="{{ url('dashboard/admin/user') }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p class="text">Master Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../calendar.html" class="nav-link">
                        <i class="nav-icon fas fa-star"></i>
                        <p>
                            Master Gol Pegawai
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../calendar.html" class="nav-link">
                        <i class="nav-icon fas fa-thumbtack"></i>
                        <p>
                            Master Instalasi
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../calendar.html" class="nav-link">
                        <i class="nav-icon fas fa-user-secret"></i>
                        <p>
                            Master Jabatan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../calendar.html" class="nav-link">
                        <i class="nav-icon fas fa-scroll"></i>
                        <p>
                            Master Kel. Pegawai
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../calendar.html" class="nav-link">
                        <i class="nav-icon fas fa-check"></i>
                        <p>
                            Master Kel. TTD
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../calendar.html" class="nav-link">
                        <i class="nav-icon fas fa-file-contract"></i>
                        <p>
                            Master Pangkat
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../calendar.html" class="nav-link">
                        <i class="nav-icon fas fa-id-badge"></i>
                        <p>
                            Master Pendidikan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../calendar.html" class="nav-link">
                        <i class="nav-icon fas fa-id-card"></i>
                        <p>
                            Master Pend. Kualifikasi
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../calendar.html" class="nav-link">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>
                            Master Unit Kerja
                        </p>
                    </a>
                </li>
                
                <br>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); ocument.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-window-close"></i>
                        <p>
                            {{ __('Logout') }}
                        </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>
