<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('admindash') }}">
            <!-- <img src="{{ asset('logo/sisdologo.png') }}" alt="Ndururumo" width="50" height="60"> -->
            <span class="align-middle">PettyCash SYSTEM </span>
        </a>
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Service Tabs
            </li>

            <li class="sidebar-item active">
                <a class="sidebar-link" href="{{ route('admindash') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-header">
                Staff Management
            </li>


            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('managestaff') }}">
                    <i class="align-middle"data-feather="user"></i> <span class="align-middle">Manage Staff</span>
                </a>
            </li>
            

            <li class="sidebar-header">
                Fund Management
            </li>


            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle"data-feather="user"></i> <span class="align-middle">Funding Allocation</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="airplay"></i> <span class="align-middle">Manage permissions</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="airplay"></i> <span class="align-middle">Manage Categories</span>
                </a>
            </li>

            <li class="sidebar-header">
                Reports
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admindash') }}">
                    <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Billing</span>
                </a>
            </li>

            <li class="sidebar-header">
                payment Management
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admindash') }}">
                    <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Payment
                        Registration</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="align-left"></i> <span class="align-middle">Generate
                        Statement</span>
                </a>
            </li>



            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('blankpage') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Blank Page</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('adminforms') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Form Page</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('tablepage') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Table Page</span>
                </a>
            </li>


            <li class="sidebar-header">
                Plugins & Addons
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="charts-chartjs.html">
                    <i class="align-middle" data-feather="aperture"></i> <span class="align-middle">Support</span>
                </a>
            </li>



        </ul>


    </div>
</nav>
