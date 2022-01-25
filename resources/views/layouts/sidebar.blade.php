<aside class="main-sidebar sidebar-dark-info elevation-4 ">
    <!-- Brand Logo -->
    <a href="#" class="brand-link navbar-cyan">
        <h3>E-KINERJA</h3>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">{{ ( Session::get('user') == true ? Session::get('user')->nama : Session::get('karyawan')->nama ) }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if(Session::get('user') == true)
                    <li class="nav-item">
                        <a class="nav-link {{ !empty($activeTab) && $activeTab == 'data-dashboard' ? 'active' : '' }}" href="{{ url('/admin/dashboard_admin') }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ !empty($activeTab) && $activeTab == 'data-jabatan' ? 'active' : '' }}" href="{{ url('/admin/jabatan') }}">
                            <i class="nav-icon fas ">JB</i>
                            <p>Data Jabatan</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ !empty($activeTab) && $activeTab == 'data-unitkerja' ? 'active' : '' }}" href="{{ url('/admin/unitkerja') }}">
                            <i class="nav-icon fas ">UK</i>
                            <p>Data Unit Kerja</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ !empty($activeTab) && $activeTab == 'data-karyawan' ? 'active' : '' }}" href="{{ url('/admin/karyawan') }}">
                            <i class="nav-icon fas ">KR</i>
                            <p>Data Karyawan</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ !empty($activeTab) && $activeTab == 'data-user' ? 'active' : '' }}" href="{{ url('/admin/user') }}">
                            <i class="nav-icon fas ">US</i>
                            <p>Data User</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ !empty($activeTab) && $activeTab == 'data-laporan' ? 'active' : '' }}" href="{{ url('/admin/riwayat-laporan-admin') }}">
                            <i class="nav-icon fas fa-file "></i>
                            <p>Laporan</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ !empty($activeTab) && $activeTab == 'data-password' ? 'active' : '' }}" href="{{ url('/admin/password') }}">
                            <i class="nav-icon fas fa-key "></i>
                            <p>Ganti Password</p>
                        </a>
                    </li>

                @elseif(Session::get('karyawan')->role == 2)
                    <li class="nav-item">
                        <a class="nav-link {{ !empty($activeTab) && $activeTab == 'data-dashboard' ? 'active' : '' }}" href="{{ url('/karyawan/dashboard_karyawan') }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview {{ (!empty($activeTab) && $activeTab == 'data-laporan-harian') || !empty($activeTab) && $activeTab == 'data-riwayat-laporan' ? 'menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ (!empty($activeTab) && $activeTab == 'data-laporan-harian') || !empty($activeTab) && $activeTab == 'data-riwayat-laporan'  ? 'active' : '' }}">
                            <i class="fas fa-file nav-icon"></i>
                            <p>Laporan Saya
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item ">
                                <a class="nav-link {{ !empty($activeTab) && $activeTab == 'data-laporan-harian' ? 'active' : '' }}"
                                    href="{{ url('/karyawan/laporan-harian') }}">
                                    &emsp;<i class="nav-icon fas fa-file"></i>
                                    <p>Laporan Harian</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ !empty($activeTab) && $activeTab == 'data-riwayat-laporan' ? 'active' : '' }}"
                                    href="{{ url('/karyawan/riwayat-laporan') }}">
                                    &emsp;<i class="nav-icon fas fa-file"></i>
                                    <p>Riwayat Laporan</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview {{ !empty($activeTab) && $activeTab == 'data-laporan-harian-bawahan' ? 'menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ !empty($activeTab) && $activeTab == 'data-laporan-harian-bawahan'  ? 'active' : '' }}">
                            <i class="fas fa-file nav-icon"></i>
                            <p>Laporan Bawahan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item ">
                                <a class="nav-link {{ !empty($activeTab) && $activeTab == 'data-laporan-harian-bawahan' ? 'active' : '' }}"
                                    href="{{ url('/karyawan/laporan-harian-bawahan') }}">
                                    &emsp;<i class="nav-icon fas fa-file"></i>
                                    <p>Laporan Harian</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ !empty($activeTab) && $activeTab == 'data-password' ? 'active' : '' }}" href="{{ url('/karyawan/password') }}">
                            <i class="nav-icon fas fa-key "></i>
                            <p>Ganti Password</p>
                        </a>
                    </li>

                @else
                @endif
            </ul>
        </nav>
    </div>
</aside>