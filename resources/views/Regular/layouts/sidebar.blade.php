<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/admin" class="app-brand-link">
            <h1>REGULAR</h1>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        <!-- Tickets -->
        <li class="menu-item {{ Request::is('regular/tickets/create') ? 'active' : '' }}">
            <a href="{{ route('regular.tickets.create') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="tickets">Create Tickets</div>
            </a>
        </li>

        <!-- Ticket Log -->
        <li class="menu-item {{ Request::is('regular/ticket/') ? 'active' : '' }}">
            <a href="{{ route('regular.tickets.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="tickets">Tickets Log</div>
            </a>
        </li>

    </ul>
</aside>
