@extends('layouts.main.app')

@section('title', "$app_name | Register")

@section('content')
<style>/* Add active color to navbar links when active */
.navbar-nav .nav-item .nav-link.active {
    color: #ffbb00; /* Your desired active link color */
    font-weight: bold;
}
</style>
<header>
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
                                <!-- <li class="nav-item">
                                    <a href="{{ route('admin.bookings.index') }}" class="nav-link">
                                        <span class="nav-link-inner--text"> Appointment</span>
                                    </a>
                                </li> -->
                            @else
                                <!-- <li class="nav-item">
                                    <a href="{{ route('customer.services.index') }}" class="nav-link">
                                        <span class="nav-link-inner--text"> Appointment</span>
                                    </a>
                                </li> -->
                            @endif

                        @endauth

                        @guest
                            <li class="nav-item">
                                <a href="{{ route('customer.services.index') }}" class="nav-link" id="main_services">
                                    <span class="nav-link-inner--text">Services</span>
                                </a>
                            </li>
                            <!-- <a href="{{ route('customer.services.index') }}" class="nav-link">
                                <span class="nav-link-inner--text"> Appointment</span>
                            </a> -->
                            </li>
                        @endguest

                        <li class="nav-item">
                            <a href="{{ route('main.pages.faqs') }}"
                                class="nav-link @if (Route::is('main.pages.faqs')) active @endif">
                                <span class="nav-link-inner--text">Contact Us</span>
                            </a>
                        </li>


                    </ul>
                <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                @guest
    <li class="nav-item">
        <a href="{{ route('auth.login') }}" class="nav-link @if (Route::is('auth.login')) active @endif">Login</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('auth.register') }}" class="nav-link @if (Route::is('auth.register')) active @endif">Register</a>
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

<div class="container">
    <div class="row gx-lg-5 align-items-center d-flex align-items-center vh-100">
        <div class="col-lg-6 mb-5 mb-lg-0">
            <h1 class="display-3 font-weight-bold ls-tight">
                <span class="text-primary">{{ config('app.name') }}</span>
            </h1>
            <p style="color: hsl(217, 10%, 50.8%)">
                Is your furry friend ready to experience top-notch veterinary care like never before? 
                Look no further than Central Bark Veterinary Clinic! We're not just a clinic – we're 
                a dedicated team of animal lovers committed to ensuring your pet's health and happiness.
            </p>
            <img class="img-fluid" src="{{ asset('img/auth/register.svg') }}" alt="">
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="card">
                <div class="card-body py-5 px-md-5">
                    <form action="{{ route('auth.attempt_register') }}" method="post">
                        @csrf
                        @include('layouts.includes.alert')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-outline mb-2">
                                    <label class="form-label">First Name</label>
                                    <input class="form-control" type="text" name="first_name" onkeyup="capitalizeInput(event)" value="{{ old('first_name') }}">
                                </div>
                                <div class="form-outline mb-2">
                                    <label class="form-label">Middle Name</label>
                                    <input class="form-control" type="text" name="middle_name" onkeyup="capitalizeInput(event)" value="{{ old('middle_name') }}">
                                </div>
                                <div class="form-outline mb-2">
                                    <label class="form-label">Last Name</label>
                                    <input class="form-control" type="text" name="last_name" onkeyup="capitalizeInput(event)" value="{{ old('last_name') }}">
                                </div>
                                <div class="form-outline mb-2">
                                    <label class="form-label">Sex</label>
                                    <select class="form-control" name="sex">
                                        <option value=""></option>
                                        <option value="male" @if (old('sex') == 'male') selected @endif>Male</option>
                                        <option value="female" @if (old('sex') == 'female') selected @endif>Female</option>
                                    </select>
                                </div>
                                <div class="form-outline mb-2">
                                    <label class="form-label">Birth Date</label>
                                    <input class="form-control" type="date" max="2012-01-01" name="birth_date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-outline mb-2">
                                    <label class="form-label">Address</label>
                                    <input class="form-control" type="text" name="address" placeholder="Complete Address" onkeyup="capitalizeInput(event)" value="{{ old('address') }}">
                                </div>
                                <div class="form-outline mb-2">
                                    <label class="form-label">Contact</label>
                                    <input class="form-control" type="number" min="0" name="contact" placeholder="Ex. 09659312005" value="{{ old('contact') }}">
                                </div>
                                <div class="form-outline mb-2">
                                    <label class="form-label">Email</label>
                                    <input class="form-control" type="email" name="email" placeholder="you@email.com" value="{{ old('email') }}">
                                </div>
                                <div class="form-outline mb-2">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="form-outline mb-2">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>
                        </div>

                        <!-- Checkbox -->
                        <div class="form-check mb-4 text-center">
                            <input class="form-check-input mr-2" type="checkbox" name="terms_of_service" id="terms_of_service" required>
                            <label class="form-check-label text-sm" for="terms_of_service">
                                I have read the Terms of Service
                            </label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-block mb-4">
                            Sign up
                        </button>

                        <div class="text-center">
                            <a class="text-sm" href="{{ route('auth.login') }}">Already have an account?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('#main_register_nav').addClass('active')
</script>
@endsection
