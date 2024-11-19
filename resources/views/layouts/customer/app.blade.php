<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', 'Dashboard')</title>
    @include('layouts.customer.styles')
    @yield('styles')

    {{-- 
    <style>
        .bg-primary,
        .btn-primary {
            background-color: <?php echo $settings->color_theme; ?> !important;
            border-color: <?php echo $settings->color_theme; ?> !important;
        }

        .active {
            background-color: <?php echo $settings->color_theme; ?> !important;
            border-color: <?php echo $settings->color_theme; ?> !important;
        }
    </style> --}}

</head>

<body class="g-sidenav-pinned">
    {{-- Side Nav --}}
    <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header d-flex align-items-center">
                <img class="mt-3 custom-avatar-md ml-4" src="{{ handleNullAvatar(auth()->user()->avatar_profile) }}"
                    width="115" alt="avatar" title="{{ auth()->user()->name }}">
                <div class="d-block d-lg-none">
                    <div class="sidenav-toggler" data-action="sidenav-unpin" data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <h5 class="font-weight-normal p-0 text-muted mt-2 mt-md-0 mb-1">
                        {{ auth()->user()->name }}
                    </h5>
                    <!-- Nav items -->
                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a class="nav-link @if (Route::is('customer.services.index') || Route::is('customer.services.schedules.*')) active @endif"
                                href="{{ route('customer.services.index') }}">
                                <i class="fas fa-clipboard"></i>
                                <span class="nav-link-text">Clinic Services</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (Route::is('customer.bookings.*')) active @endif"
                                href="{{ route('customer.bookings.index') }}">
                                <i class="fas fa-clipboard-list"></i>
                                <span class="nav-link-text">Booking</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (Route::is('customer.pets.*')) active @endif"
                                href="{{ route('customer.pets.index') }}">
                                <i class="fas fa-paw"></i>
                                <span class="nav-link-text">Pet Management</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Divider -->
                    <hr class="my-3">
                    <!-- Heading -->
                    <h6 class="navbar-heading p-0 text-muted">
                        <span class="docs-normal">Settings</span>
                    </h6>
                    <!-- Navigation -->
                    <ul class="navbar-nav mb-md-3">
                        <li class="nav-item">
                            <a class="nav-link @if (Route::is('profile.index')) active @endif"
                                href="{{ route('profile.index') }}">
                                <i class="ni ni-single-02"></i>
                                <span class="nav-link-text">Profile</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav> {{-- End Side Nav --}}

    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <h3 class="font-weight-normal text-white d-none d-md-block"><i class="fas fa-calendar mr-1"></i>
                        Today: {{ formatDate(now(), 'dateTime') }}
                    </h3>
                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center  ml-md-auto ">
                        <li class="nav-item">
                            <!-- Sidenav toggler -->
                            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin"
                                data-target="#sidenav-main">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </div>
                        </li>

                    </ul>
                    <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                    <li class="nav-item dropdown">
    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <div class="media align-items-center">
            <span class="avatar avatar-sm rounded-circle">
                <img src="{{ handleNullAvatar(auth()->user()->avatar_profile) }}"
                    class="avatar rounded-circle" alt="Image placeholder">
            </span>
        </div>
    </a>
    <div class="dropdown-menu  dropdown-menu-right ">
        <div class="dropdown-header noti-title">
            <h6 class="text-overflow m-0">Settings</h6>
        </div>
        <a href="{{ route('profile.index') }}" class="dropdown-item">
            <i class="ni ni-single-02"></i>
            <span>Profile</span>
        </a>
        <a href="{{ route('main.pages.home') }}" 
   class="dropdown-item @if (Route::is('main.pages.home')) active @endif">
   <i class="fas fa-home"></i>
   <span>Home</span>
</a>

        <div class="dropdown-divider"></div>
        <a href="javascript:void(0)" class="dropdown-item"
            onclick="confirm('Do you want to Logout?', '', 'Yes').then(res => res.isConfirmed ? $('#logout').submit() : false)">
            <i class="fas fa-power-off"></i>
            <span>Logout</span>
        </a>
        <form action="{{ route('auth.logout') }}" method="post" id="logout">@csrf</form>
    </div>
</li>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header -->
        @yield('content')
    </div>
    {{-- End Main Content --}}

    @include('layouts.customer.scripts')
    <script src="{{ asset('assets/js/customer/script.js') }}"></script>
    @yield('script')
    @routes

</body>

</html>
