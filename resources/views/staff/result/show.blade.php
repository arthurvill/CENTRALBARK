@extends('layouts.staff.app')

@section('title', "Staff | $result->subject")

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('staff.bookings.show', $booking) }}">All
                        Results</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Date Schedule : <span class="fw-bold ">{{ formatDate($booking->schedule->date_time_start) }} at
                        {{ formatDate($booking->schedule->date_time_start, 'time') }}
                        - {{ formatDate($booking->schedule->date_time_end, 'time') }}</span>
                </li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <h2 class="font-weight-normal">Subject: {{ $result->subject }}</h2>

                        <h3 class="font-weight-normal">Date Schedule : <span
                                class="fw-bold ">{{ formatDate($booking->schedule->date_time_start) }} at
                                {{ formatDate($booking->schedule->date_time_start, 'time') }}
                                - {{ formatDate($booking->schedule->date_time_end, 'time') }}</span>
                        </h3>

                        <h3 class="font-weight-normal"> {{ $result->remark }}</h3>
                        <br>
                        <br>
                        <h4 class="text-muted" data-toggle="collapse" data-target="#view_photos" style="cursor: pointer"
                            title="click to view photos"><i class="fas fa-link mr-1"> </i>
                            View Photos
                        </h4>
                        <br>
                        <div class="collapse" id="view_photos">
                            @forelse ($result->getMedia('booking_result_images') as $image)
                                <a href="{{ $image->getUrl() }}" class="glightbox">
                                    <img class="img-fluid" src="{{ $image->getUrl() }}" width="100" alt="image">
                                </a>
                            @empty
                                <img class="img-fluid" src="{{ asset('img/nodata.svg') }}" width="100" alt="default">
                            @endforelse
                        </div>

                        <br>
                        <p class="card-text">
                            <small class="text-muted">Edited
                                {{ is_null($result->updated_at) ? $result->created_at->diffForHumans() : $result->updated_at->diffForHumans() }}
                                <i class="fas fa-clock ml-1"></i>
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End CONTAINER --}}

@endsection

@section('script')
    <script>
        const lightbox = GLightbox({
            selector: '.glightbox'
        });

        $('#appointment_nav').addClass('active')
        $('#booking_nav').addClass('text-primary')
    </script>
@endsection
