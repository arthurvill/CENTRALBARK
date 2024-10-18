@extends('layouts.customer.app')

@section('title', "$app_name| Booking History")

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <h2 class="font-weight-normal text-primary">
            Appointment History <i class="fas fa-clipboard-list ml-1"></i>
        </h2>
        <br>

        @include('layouts.includes.alert')
        <div class="row justify-content-center ">
            @forelse ($bookings as $booking)
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="d-none d-md-block col-md-2">
                                <img class="card-img-top" src="{{ asset('img/auth/vet.svg') }}" id="show_img" alt="image">
                            </div>
                            <div class="col-md-10">
                                <div class="card-body">
                                    <div class='dropdown float-right'>
                                        <a class='btn btn-sm btn-icon-only text-light' href='#' role='button'
                                            data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                            <i class='fas fa-ellipsis-v'></i>
                                        </a>
                                        <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>
                                            <a class='dropdown-item'
                                                href="{{ route('customer.bookings.show', $booking->id) }}">View</a>
                                        </div>
                                    </div>
                                    <h2 class="fw-bold">
                                        {{ $booking->schedule->service->name }}
                                        </h3>
                                        <p class="me-1">
                                            {{ formatDate($booking->created_at) }} <i class="far fa-calendar ml-1"></i> |
                                            {{ $app_name }}
                                            <i class="fas fa-customer-md ml-1"></i>
                                        </p>
                                        <p class="card-text"><small class="text-muted">@
                                                {{ formatDate($booking->schedule->date_time_start, 'time') }} -
                                                {{ formatDate($booking->schedule->date_time_end, 'time') }}
                                                <i class="far fa-clock ms-1"></i></small>
                                        </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty

                <figure class="d-block mx-auto">
                    <img class="img-fluid" src="{{ asset('img/nodata.svg') }}" alt="no data">
                </figure>
            @endforelse
        </div>
        {{-- End CONTAINER --}}

    @endsection
