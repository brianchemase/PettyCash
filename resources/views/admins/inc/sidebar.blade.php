<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('admindash') }}">
            <!-- <img src="{{ asset('logo/sisdologo.png') }}" alt="Ndururumo" width="50" height="60"> -->
            <span class="align-middle" style="color: orange;">PettyCash SYSTEM </span>
        </a>
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Service Tabs
            </li>

            <li class="sidebar-item active" style="color: orange;">
                <a class="sidebar-link" href="{{ route('admindash') }}">
                    <i class="align-middle" data-feather="sliders" style="color: orange;"></i> <span class="align-middle" style="color: orange;">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-header">
                Staff Management
            </li>


            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('managestaff') }}">
                    <i class="align-middle"data-feather="user" style="color: orange;"></i> <span class="align-middle" style="color: orange;">Manage Staff</span>
                </a>
            </li>
            

            <li class="sidebar-header">
                Fund Management
            </li>


            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle"data-feather="user" style="color: orange;"></i> <span class="align-middle" style="color: orange;">Funding Allocation</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="airplay" style="color: orange;"></i> <span class="align-middle" style="color: orange;">Manage permissions</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="airplay" style="color: orange;"></i> <span class="align-middle" style="color: orange;">Manage Categories</span>
                </a>
            </li>

            <li class="sidebar-header">
                Reports
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admindash') }}">
                    <i class="align-middle" data-feather="grid" style="color: orange;"></i> <span class="align-middle" style="color: orange;">Billing</span>
                </a>
            </li>

            <li class="sidebar-header">
                Settings
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('transactionpurposecreate') }}">
                    <i class="align-middle" data-feather="grid" style="color: orange;"></i> <span class="align-middle" style="color: orange;">Transaction Purpose</span>
                </a>
            </li>

            <li class="sidebar-header">
                payment Management
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admindash') }}">
                    <i class="align-middle" data-feather="grid" style="color: orange;"></i> <span class="align-middle" style="color: orange;">Payment
                        Registration</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="align-left"></i> <span class="align-middle" style="color: orange;">Generate
                        Statement</span>
                </a>
            </li>



            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('blankpage') }}">
                    <i class="align-middle" data-feather="user" style="color: orange;"></i> <span class="align-middle" style="color: orange;">Blank Page</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('adminforms') }}">
                    <i class="align-middle" data-feather="user" style="color: orange;"></i> <span class="align-middle" style="color: orange;">Form Page</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('tablepage') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle" style="color: orange;">Table Page</span>
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
