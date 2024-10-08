<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion transition" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-utensils"></i>
        </div>
        <div class="sidebar-brand-text mx-3" style="line-height: 1rem">RMS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @if (request()->routeIS('dashboard')) active @endif">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Nav Item - Account Management -->
    <li class="nav-item @if (request()->routeIS('account-management')) active @endif">
        <a class="nav-link" href="{{ route('account-management') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Account Management</span></a>
    </li>

    <!-- Nav Item - Menu Management -->
    <li class="nav-item @if (request()->routeIS('menu-management')) active @endif">
        <a class="nav-link" href="{{ route('menu-management') }}">
        <i class="fas fa-fw fa-utensil-spoon"></i>
        <span>Menu Management</span></a>
    </li>

    <!-- Nav Item - Table Management -->
    <li class="nav-item @if (request()->routeIS('table-management')) active @endif">
        <a class="nav-link" href="{{ route('table-management') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Table Management</span></a>
    </li>

    <!-- Nav Item - Bill Management -->
    <li class="nav-item @if (request()->routeIS('bill-management')) active @endif">
        <a class="nav-link" href="{{ route('bill-management') }}">
            <i class="fas fa-fw fa-money-bill-wave"></i>
            <span>Bill Management</span></a>
    </li>

    <!-- Nav Item - Point of Sale -->
    <li class="nav-item @if (request()->routeIS('pos')) active @endif">
        <a class="nav-link" href="{{ route('pos') }}">
            <i class="fas fa-fw fa-file-invoice"></i>
            <span>Point of Sale</span></a>
    </li>

    <!-- Nav Item - Orders View -->
    <li class="nav-item @if (request()->routeIS('ordersView')) active @endif">
        <a class="nav-link" href="{{ route('ordersView') }}">
            <i class="fas fa-fw fa-concierge-bell"></i>
            <span>Orders View</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->