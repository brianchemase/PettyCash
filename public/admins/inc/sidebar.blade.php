<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('admindash') }}">
            <!-- <img src="{{ asset('logo/sisdologo.png') }}" alt="Ndururumo" width="50" height="60"> -->
            <span class="align-middle">UBS SYSTEM </span>
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
                Role Management
            </li>


            <li class="sidebar-item">
                <a class="sidebar-link" href="/role_management/roles/create">
                    <i class="align-middle"data-feather="user"></i> <span class="align-middle">Create role</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="/role_management/roles/">
                    <i class="align-middle" data-feather="airplay"></i> <span class="align-middle">Manage Roles</span>
                </a>
            </li>

            <li class="sidebar-header">
                Permissions Management
            </li>


            <li class="sidebar-item">
                <a class="sidebar-link" href="/role_management/permissions/create">
                    <i class="align-middle"data-feather="user"></i> <span class="align-middle">Create permissions</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="/role_management/permissions/">
                    <i class="align-middle" data-feather="airplay"></i> <span class="align-middle">Manage
                        permissions</span>
                </a>
            </li>

            <li class="sidebar-header">
                Bill Management
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
