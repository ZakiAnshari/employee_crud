<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand justify-content-center">
        <a href="/dashboard" class="app-brand-link gap-2">
            <div style="display: flex; justify-content: center; align-items: center; width: 100px; height: 88px;">
                <span style="font-weight: 700; font-size: 20px;">Employee</span>
            </div>
        </a>
    </div>
    <!-- Digital Clock -->
    <div id="digital-clock" class="text-center"></div>
    <br>
    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        {{-- Dashboard --}}
        <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('karyawan*') ? 'active' : '' }}">
            <a href="/karyawan" class="menu-link">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div data-i18n="Karyawan">Manajemen Karyawan</div>
            </a>
        </li>
        @if (Auth::user()->role_id == 1)
            <li class="menu-item {{ Request::is('akses*') ? 'active' : '' }}">
                <a href="/akses" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-key"></i>
                    <div data-i18n="Akses">Manajemen Akses</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('log-aktivitas*') ? 'active' : '' }}">
                <a href="/log-aktivitas" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-history"></i>
                    <div data-i18n="LogAktivitas">Log Aktivitas</div>
                </a>
            </li>
        @endif
    </ul>
</aside>
