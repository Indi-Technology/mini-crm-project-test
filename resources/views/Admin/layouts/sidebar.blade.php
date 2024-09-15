<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/admin" class="app-brand-link">
            <h1>ADMIN</h1>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        <!-- Dashboard -->
        <li class="menu-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Tickets -->
        {{-- <li class="menu-item {{ Request::is('admin/tickets/create') ? 'active' : '' }}">
            <a href="{{ route('tickets.create') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="tickets">Tickets</div>
            </a>
        </li> --}}

        <!-- Ticket Log -->
        <li class="menu-item {{ Request::is('admin/tickets/') ? 'active' : '' }}">
            <a href="/admin/tickets" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="tickets">Tickets Log</div>
            </a>
        </li>



        <!-- span -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Manage</span></li>

        <!-- Users -->
        <li class="menu-item {{ Request::is('admin/RegistUser/') ? 'active' : '' }}">
            <a href="/admin/RegistUser" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Pendaftaran">User</div>
            </a>
        </li>

        <!-- Labels-->
        <li class="menu-item {{ Request::is('admin/labels/') ? 'active' : '' }}">
            <a href="{{ route('labels.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Pendaftaran">Labels</div>
            </a>
        </li>

        <!-- Categories -->
        <li class="menu-item {{ Request::is('admin/categories/') ? 'active' : '' }}">
            <a href="{{ route('categories.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Pendaftaran">Categories</div>
            </a>
        </li>

        <!-- Priorities -->
        <li class="menu-item {{ Request::is('admin/priorities/') ? 'active' : '' }}">
            <a href="{{ route('priorities.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Pendaftaran">Priorities</div>
            </a>
        </li>

    </ul>
</aside>
