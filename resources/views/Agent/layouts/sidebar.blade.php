<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/admin" class="app-brand-link">
            <h1>AGENT</h1>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        <!-- Dashboard -->
        {{-- <li class="menu-item {{ Request::is('regular/home*') ? 'active' : '' }}">
            <a href="/regular/home" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li> --}}

        <!-- Tickets -->
<!-- Create Ticket (for Agent) -->
{{-- <li class="menu-item {{ Request::is('agent/tickets/create') ? 'active' : '' }}">
    <a href="{{ route('agent.tickets.create') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="create-ticket">Create Ticket</div>
    </a>
</li> --}}

<!-- Ticket Log (for Agent) -->
<li class="menu-item {{ Request::is('agent/ticket') ? 'active' : '' }}">
    <a href="{{ route('agent.tickets.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="tickets-log">Tickets Log</div>
    </a>
</li>


    </ul>
</aside>
