<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- User -->
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('user') }}">
                <i class="fa-solid fa-user-pen"></i>
                <span>User</span>
            </a>
        </li>

        <!-- Other Menu Items -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('subscriber') }}">
                <i class="fa-solid fa-user-pen"></i>
                <span>Subscriber</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('service') }}">
                <i class="fa-solid fa-truck-fast"></i>
                <span>Service</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('billing') }}">
                <i class="fa-solid fa-file-invoice-dollar"></i>
                <span>Billing</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('payment') }}">
                <i class="fa-solid fa-money-bill"></i>
                <span>Payment</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('remittance') }}">
                <i class="fa-solid fa-money-bill"></i>
                <span>Remittance</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('report') }}">
                <i class="fa-solid fa-table-list"></i>
                <span>Report</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('announcement') }}">
                <i class="fa-solid fa-bullhorn"></i>
                <span>Announcement</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('complaints') }}">
                <i class="fa-solid fa-comments"></i>
                <span>Complaints</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</aside>
