  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">


        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                <i class="bx bx-home"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- User -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('user') }}">
                <i class="bx bx-user"></i>
                <span>User</span>
            </a>
        </li>

        <!-- Other Menu Items -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('subscriber') }}">
                <i class="bx bx-user-check"></i>
                <span>Subscriber</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('service') }}">
                <i class="bx bx-truck"></i>
                <span>Service</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('billing') }}">
                <i class="bx bx-receipt"></i>
                <span>Billing</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('payment') }}">
                <i class="bx bx-money"></i>
                <span>Payment</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('remittance') }}">
                <i class="bx bx-credit-card"></i>
                <span>Remittance</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('report') }}">
                <i class="bx bx-table"></i>
                <span>Report</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('announcement') }}">
                <i class="bx bx-megaphone"></i>
                <span>Announcement</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('complaints') }}">
                <i class="bx bx-message-square-dots"></i>
                <span>Complaints</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('logout') }}">
                <i class="bx bx-log-out"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</aside>
