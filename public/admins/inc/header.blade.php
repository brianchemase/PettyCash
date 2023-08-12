<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">

            <!-- <center> <img src="{{ asset('logo/sisdologo.png') }}" alt="logo" width="50" height="60"></center> -->

            <li class="dropdown dropdown-user nav-item">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link"
                    href="#" data-toggle="dropdown"> <span class="avatar img-fluid rounded me-1"><img src="{{ asset('adminsdash/img/avatars/avatar.jpg') }}" class="avatar img-fluid rounded me-1"
                        alt="profile" /> <span class="text-dark">Username</span>
                </a>
                <!-- <div class="dropdown-menu dropdown-menu-end">
                    <form class="inline" method="POST" action="{{ route('logoutUser') }}">
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="ft-power"></i> Logout</button>
                    </form>
                    <!--
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.html"><i class="align-middle me-1" data-feather="settings"></i>
                        Settings & Privacy</a>
                    <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i>
                        Help Center
                    </a>
              
                </div> -->
            </li>
        </ul>
    </div>
</nav>
