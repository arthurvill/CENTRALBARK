@extends('layouts.main.app')

@section('title', "$app_name | Login")

@section('content')
<header>
    <!-- Navbar -->
    <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg bg-primary py-2">
        <div class="container">
            <a class="navbar-brand text-white" href="/">
                {{ config('app.name') }} <i class="fas fa-paw ml-1"></i>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbar-collapse" aria-controls="navbar-collapse"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
            <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a href="{{ route('main.pages.home') }}"
                                class="nav-link @if (Route::is('main.pages.home')) active @endif">
                                <span class="nav-link-inner--text">Home</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('main.pages.about') }}"
                                class="nav-link @if (Route::is('main.pages.about')) active @endif">
                                <span class="nav-link-inner--text">About Us</span>
                            </a>
                        </li>


                        @auth
                            @if (auth()->user()->hasRole('admin'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.services.index') }}" class="nav-link" id="main_services">
                                        <span class="nav-link-inner--text">Services</span>
                                    </a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a href="{{ route('customer.services.index') }}" class="nav-link" id="main_services">
                                        <span class="nav-link-inner--text">Services</span>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->hasRole('admin'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.bookings.index') }}" class="nav-link">
                                        <span class="nav-link-inner--text"> Appointment</span>
                                    </a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a href="{{ route('customer.services.index') }}" class="nav-link">
                                        <span class="nav-link-inner--text"> Appointment</span>
                                    </a>
                                </li>
                            @endif

                        @endauth

                        @guest
                            <li class="nav-item">
                                <a href="{{ route('customer.services.index') }}" class="nav-link" id="main_services">
                                    <span class="nav-link-inner--text">Services</span>
                                </a>
                            </li>
                            <a href="{{ route('customer.services.index') }}" class="nav-link">
                                <span class="nav-link-inner--text"> Appointment</span>
                            </a>
                            </li>
                        @endguest

                        <li class="nav-item">
                            <a href="{{ route('main.pages.faqs') }}"
                                class="nav-link @if (Route::is('main.pages.faqs')) active @endif">
                                <span class="nav-link-inner--text">FAQS</span>
                            </a>
                        </li>


                    </ul>

                <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                    @guest
                        <li class="nav-item">
                            <a href="{{ route('auth.login') }}" class="nav-link">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('auth.register') }}" class="nav-link">Register</a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <img src="{{ handleNullAvatar(auth()->user()->avatar_profile) }}" 
                                             class="avatar rounded-circle" alt="Image placeholder">
                                    </span>
                                    <div class="media-body ml-2 d-none d-lg-block">
                                        <span class="mb-0 text-sm font-weight-bold">{{ auth()->user()->name }}</span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Settings</h6>
                                </div>
                                @if (auth()->user()->hasRole('admin'))
                                    <a href="{{ route('admin.dashboard.index') }}" class="dropdown-item">
                                        <i class="ni ni-tv-2"></i>
                                        <span>Dashboard</span>
                                    </a>
                                @else
                                    <a href="{{ route('customer.services.index') }}" class="dropdown-item">
                                        <i class="ni ni-tv-2"></i>
                                        <span>Services</span>
                                    </a>
                                @endif
                                <a href="{{ route('profile.index') }}" class="dropdown-item">
                                    <i class="ni ni-single-02"></i>
                                    <span>Profile</span>
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
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>

<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-12">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-6 d-none d-md-block my-auto">
                            <img src="{{ asset('img/auth/vet.svg') }}" alt="login" class="img-fluid"
                                style="border-radius: 1rem 0 0 1rem;" />
                        </div>
                        <div class="col-md-6 col-lg-6 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">
                                <form action="{{ route('auth.login') }}" method="POST">
                                    @csrf
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <img class="img-fluid rounded-circle mr-3"
                                            src="{{ asset('img/logo/logo.png') }}" width="75" alt="logo">
                                        <span class="h2 fw-bold mb-0 text-primary">{{ config('app.name') }}</span>
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">
                                        Sign in to your account
                                    </h5>
                                    @include('layouts.includes.alert')

                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                            </div>
                                            <input class="form-control" type="email" name="email"
                                                placeholder="Email" autocomplete="email" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend" id="password">
                                                <span class="input-group-text"><i class="fas fa-eye"></i></span>
                                            </div>
                                            <input class="form-control" type="password" name="password"
                                                placeholder="Password" autocomplete="new-password" id="password_field" required>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <a class="text-sm text-primary" href="{{ route('password.request') }}">
                                            Forgot Password?
                                        </a>
                                    </div>

                                    <div class="mt-3 mb-4">
                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                                    </div>

                                    <div class="text-sm text-muted text-center">
                                        Not yet registered?
                                        <a href="{{ route('auth.register') }}" style="text-decoration: underline; color: #3498db">
                                            Register
                                        </a>
                                    </div><br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
