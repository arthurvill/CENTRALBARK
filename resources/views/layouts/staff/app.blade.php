<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', 'Staff | Dashboard')</title>
    @include('layouts.staff.styles')
    @yield('styles')

    {{-- <style>
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

    @include('layouts.staff.modal')
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
                <h5 class="font-weight-bold p-0 text-muted mt-2 mt-md-0 mb-1" 
                style="font-size: 14px !important; color: black !important; margin-bottom: 20px !important;">
                        {{ auth()->user()->name }}
                    </h5>
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link @if (Route::is('staff.dashboard.index')) active @endif"
                                href="{{ route('staff.dashboard.index') }}">
                                <i class="ni ni-tv-2"></i>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link @if (Route::is('staff.schedules.*') || Route::is('staff.bookings.*')) active @endif" href="#to_appointment"
                                data-toggle="collapse" role="button" aria-expanded="false"
                                aria-controls="navbar-tables" id="appointment_nav">
                                <i class="fas fa-clipboard-list"></i>
                                <span class="nav-link-text">
                                    Appointments
                                </span>
                            </a>
                            <div class="collapse @if (Route::is('staff.schedules.*')) show @endif" id="to_appointment">
                                <ul class="nav nav-sm flex-column">

                                    <li class="nav-item">
                                        <a href="{{ route('staff.schedules.index') }}"
                                            class="nav-link @if (Route::is('staff.schedules.*')) text-primary @endif"
                                            id="schedule_nav">
                                            Schedule
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('staff.bookings.index') }}"
                                            class="nav-link @if (Route::is('staff.bookings.*')) text-primary @endif"
                                            id="booking_nav">
                                            Booking
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link @if (Route::is('staff.service_categories.index') || Route::is('staff.services.*')) active @endif"
                                href="#to_service_management" data-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="navbar-tables">
                                <i class="fas fa-clipboard"></i>
                                <span class="nav-link-text">
                                    Service Management
                                </span>
                            </a>
                            <div class="collapse @if (Route::is('staff.service_categories.index') || Route::is('staff.services.*')) show @endif"
                                id="to_service_management">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('staff.service_categories.index') }}"
                                            class="nav-link @if (Route::is('staff.service_categories.index')) text-primary @endif">
                                            Category
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('staff.services.index') }}"
                                            class="nav-link @if (Route::is('staff.services.*')) text-primary @endif">
                                            Service
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>



                        <li class="nav-item">
                            <a class="nav-link @if (Route::is('staff.categories.index') || Route::is('staff.pets.*') || Route::is('staff.pets.vaccination_hitories.*')) active @endif"
                                href="#to_pet_management" data-toggle="collapse" role="button" aria-expanded="false"
                                aria-controls="navbar-tables">
                                <i class="fas fa-paw"></i>
                                <span class="nav-link-text">
                                    Pet Management
                                </span>
                            </a>
                            <div class="collapse @if (Route::is('staff.categories.index') || Route::is('staff.pets.*')) show @endif"
                                id="to_pet_management">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('staff.categories.index') }}"
                                            class="nav-link @if (Route::is('staff.categories.index')) text-primary @endif">
                                            Category
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('staff.pets.index') }}"
                                            class="nav-link @if (Route::is('staff.pets.*')) text-primary @endif">
                                            Pet
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>



                        <li class="nav-item">
                            <a class="nav-link @if (Route::is('staff.customers.*')) active @endif"
                                href="{{ route('staff.customers.index') }}">
                                <i class="fas fa-user"></i>
                                <span class="nav-link-text">Customer Management</span>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link @if (Route::is('staff.users.index')) active @endif"
                                href="{{ route('staff.users.index') }}">
                                <i class="fas fa-user-cog"></i>
                                <span class="nav-link-text">Auth Management</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link @if (Route::is('staff.activity_logs.index')) active @endif"
                                href="{{ route('staff.activity_logs.index') }}">
                                <i class="fas fa-history"></i>
                                <span class="nav-link-text">Activity Logs</span>
                            </a>
                        </li>

                    </ul>

                    <!-- Divider -->
                    <hr class="my-3">
                    <!-- Heading -->
                    <h6 class="navbar-heading p-0 text-muted">
                        <span class="docs-normal">Analysis</span>
                    </h6>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link @if (Route::is('staff.general_reports.index')) active @endif"
                                href="{{ route('staff.general_reports.index') }}">
                                <i class="fas fa-project-diagram"></i>
                                <span class="nav-link-text">General Report</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Divider -->
                    <hr class="my-3">
                    <!-- Heading -->
                    <h6 class="navbar-heading p-0 text-muted">
                        <span class="docs-normal">Others</span>
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
                <h3 class="font-weight-normal text-white d-none d-md-block"><i class="fas fa-calendar mr-1"></i>
                    Today: {{ formatDate(now(), 'dateTime') }}
                </h3>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="ni ni-bell-55"></i>
                                @if ($pending_bookings->count() > 0)
                                    <span
                                        class="badge badge-success badge-pill">{{ $pending_bookings->count() }}</span>
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">
                                <!-- Dropdown header -->
                                <div class="px-3 py-3">
                                    <h6 class="text-sm text-muted m-0">You have
                                        <strong>{{ $pending_bookings->count() }}</strong>
                                        notification/s.
                                    </h6>
                                </div>
                                <!-- List group -->
                                @forelse ($pending_bookings as $pending_booking)
                                    <div class="list-group list-group-flush">
                                        <a href="{{ route('staff.bookings.show', $pending_booking) }}"
                                            class="list-group-item list-group-item-action">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <!-- Avatar -->
                                                    <img src="{{ handleNullAvatar($pending_booking->pet->customer->user->avatar_profile) }}"
                                                        class="avatar rounded-circle" alt="avatar">
                                                </div>
                                                <div class="col ml--2">
                                                    <p class="text-sm mb-0">
                                                        {{ $pending_booking->pet->customer->full_name }} has requested
                                                        an appointment.
                                                    </p>
                                                    <small>{{ $pending_booking->created_at->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                        </a>

                                    </div>
                                @empty
                                    <div class="list-group list-group-flush">
                                        <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                            <div class="row align-items-center">
                                                <img class="img-fluid d-block mx-auto"
                                                    src="{{ asset('img/nodata.svg') }}" width="100"
                                                    alt="empty">
                                            </div>
                                        </a>

                                    </div>
                                @endforelse
                                <!-- View all -->
                                <a href="{{ route('staff.bookings.index') }}"
                                    class="dropdown-item text-center font-weight-bold py-3">View all</a>
                            </div>
                        </li> --}}

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
        <!-- <a href="{{ route('main.pages.home') }}" 
   class="dropdown-item @if (Route::is('main.pages.home')) active @endif">
   <i class="fas fa-home"></i>
   <span>Home</span>
</a> -->

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

    @include('layouts.staff.scripts')
    <script src="{{ asset('assets/js/staff/script.js') }}"></script>
    @yield('script')
    @routes

</body>

</html>
