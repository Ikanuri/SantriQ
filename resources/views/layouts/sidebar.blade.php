<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="home" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-dark-sm.png') }}" alt="" height="26">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-dark-sm.png') }}" alt="" height="26">
            </span>
        </a>

        <a href="home" class="logo logo-light">
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="30">
            </span>
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-light-sm.png') }}" alt="" height="26">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn">
        <i class="bx bx-menu align-middle"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{ route('home') }}">
                        <i class="bx bx-home-alt icon nav-icon"></i>
                        <span class="menu-item" data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li class="menu-title" data-key="t-master">Master</li>
                <li>
                    <a href="{{ route('rayon-kamar.index') }}">
                        <i class="bx bx-calendar-event icon nav-icon"></i>
                        <span class="menu-item" data-key="t-rayon-kamar">Rayon Kamar</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('kamar.index') }}">
                        <i class="bx bx-home-alt icon nav-icon"></i>
                        <span class="menu-item" data-key="t-kamar">Kamar</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('santri.index') }}">
                        <i class='bx bx-user-pin icon nav-icon'></i>
                        <span class="menu-item" data-key="t-santri">Santri</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pelanggaran.index') }}">
                        <i class="bx bx-dislike icon nav-icon"></i>
                        <span class="menu-item" data-key="t-pelanggaran">Pelanggaran</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('surat.index') }}">
                        <i class="bx bx-envelope icon nav-icon"></i>
                        <span class="menu-item" data-key="t-surat-izin">Surat Izin</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('tahun.index') }}">
                        <i class="bx bx-calendar icon nav-icon"></i>
                        <span class="menu-item" data-key="t-tahun-akademik">Tahun Akademik</span>
                    </a>
                </li>

                {{-- applications --}}
                <li class="menu-title" data-key="t-applications">Applications</li>
                <li>
                    <a href="{{ route('absensi.diniyah.index') }}">
                        <i class="bx bx-notepad icon nav-icon"></i>
                        <span class="menu-item" data-key="t-surat-izin">Absensi Diniyah</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('absensi.pengajian.index') }}">
                        <i class="bx bxs-notepad icon nav-icon"></i>
                        <span class="menu-item" data-key="t-surat-izin">Absensi Pengajian</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bx bx-dislike icon nav-icon"></i>
                        <span class="menu-item" data-key="t-surat-izin">Pelanggaran Santri</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bx bx-envelope icon nav-icon"></i>
                        <span class="menu-item" data-key="t-surat-izin">Izin Santri</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
