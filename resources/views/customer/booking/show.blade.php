@extends('layouts.customer.app')

@section('title', "$app_name | Booking History")

@section('styles')
    <style>
        td {
            white-space: normal !important;
            text-align: justify;
        }

        /* Style for avatar image */
        .img-avatar {
            width: 100% !important; /* Make image responsive to container width */
            max-width: 500px !important; /* Set max width to fit nicely with the text */
            height: auto !important; /* Maintain aspect ratio */
            object-fit: cover !important; /* Ensure the image fills the container */
            border-radius: 8px !important; /* Rounded corners to match design */
            border: 2px solid #ddd !important; /* Light border for separation */
            margin-bottom: 1rem !important; /* Space below the image */
        }

        /* Align pet details text to complement image */
        .details-section .col-md-8 {
            display: flex !important;
            flex-direction: column !important;
            justify-content: flex-start !important; /* Align text to the top */
            padding-left: 20px !important; /* Add padding to space the text */
        }

        /* Align the image and pet details side by side */
        .details-section .col-md-4 {
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important; /* Center image horizontally */
            justify-content: flex-start !important; /* Align image at the top */
        }
    </style>
@endsection

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('customer.bookings.index') }}">All Bookings</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Date Schedule: <span class="font-weight-bold">{{ formatDate($booking->schedule->date_time_start) }} at
                        {{ formatDate($booking->schedule->date_time_start, 'time') }} -
                        {{ formatDate($booking->schedule->date_time_end, 'time') }}</span>
                </li>
            </ol>
        </nav>

        @include('layouts.includes.alert')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body pt-3">
                        <div class="row details-section align-items-start">
                            <!-- Image Section -->
                            <div class="col-md-4">
                                <img class="img-avatar" src="{{ handleNullAvatarForPet($booking->pet?->avatar_profile) }}" alt="avatar">
                            </div>

                            <!-- Pet Details Section -->
                            <div class="col-md-8"style= "font-size: 20px;!important">
                                <h4 class="font-weight-normal" style= "font-size: 18px;!important">Pet: <span class="font-weight-bold">{{ $booking->pet->name }}</span></h4>
                                <h4 class="font-weight-normal"style= "font-size: 18px;!important">Breed: <span class="font-weight-bold">{{ $booking->pet->breed }}</span></h4>
                                <h4 class="font-weight-normal"style= "font-size: 18px;!important">Sex: <span class="font-weight-bold">{{ $booking->pet->sex }}</span></h4>
                                <h4 class="font-weight-normal"style= "font-size: 18px;!important">Owner: <span class="font-weight-bold">{{ $booking->pet->customer->full_name }}</span></h4>
                                <h4 class="font-weight-normal"style= "font-size: 18px;!important">Service: <span class="font-weight-bold">{{ $booking->schedule->service->name }}</span></h4>
                                <h4 class="font-weight-normal"style= "font-size: 18px;!important">Date Schedule:
                                    <span class="font-weight-bold">{{ formatDate($booking->schedule->date_time_start) }} at
                                        {{ formatDate($booking->schedule->date_time_start, 'time') }} -
                                        {{ formatDate($booking->schedule->date_time_end, 'time') }}</span>
                                </h4>
                                <h4 class="font-weight-normal"style= "font-size: 18px;!important">Customer's Note: <span class="font-weight-bold">{{ $booking->note ?? 'N/A' }}</span></h4>
                                <h4 class="font-weight-normal"style= "font-size: 18px;!important">Status: {!! handleBookingStatus($booking->status) !!}</h4>
                                @if ($booking->remark)
                                    <h4 class="font-weight-normal"style= "font-size: 18px;!important">Remark: <span class="font-weight-bold">{{ $booking->remark }}</span></h4>
                                @endif
                                <h4 class="mt-2 font-weight-light"style= "font-size: 18px;!important">Control No: <span class="font-weight-bold">{{ $booking->reference_no }}</span></h4>
                                <h4 class="mt-2 font-weight-light"style= "font-size: 18px;!important">Paid Via:
                                    <span class="badge bg-primary p-2 text-white">{{ $booking->payment_method->type }}</span>
                                </h4>
                                <a class="text-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">View Payment Receipt</a>
                                <div class="collapse mt-3" id="collapseExample">
                                    <a class="glightbox" href="{{ handleNullImage($booking->payment_receipt) }}">
                                        <img class="img-thumbnail" src="{{ handleNullImage($booking->payment_receipt) }}" width="100" alt="payment receipt">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card card-body">
                    <h3>Appointment Results <i class="fas fa-clipboard-list ml-1"></i></h3>
                    <br><br>
                    <div class="table-responsive">
                        <table class="table table-hover booking_dt">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Subject</th>
                                    <th>Remark</th>
                                    <th>Uploads</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Display Booking Results --}}
                                @forelse ($results as $result)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $result->subject }}</td>
                                        <td>{{ $result->remark }}</td>
                                        <td>
                                            @if ($result->media->isNotEmpty())
                                                <a href="{{ route('results.download', $result) }}">Download</a>
                                            @endif
                                        </td>
                                        <td>{{ formatDate($result->created_at) }}</td>
                                        <td>
                                            <div class='dropdown'>
                                                <a class='btn btn-sm btn-icon-only text-light' href='#' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    <i class='fas fa-ellipsis-v'></i>
                                                </a>
                                                <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>
                                                    <a class='dropdown-item' href='{{ route('customer.bookings.results.show', [$booking, $result]) }}'>View</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">Results Not Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <br>
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

        $('#booking_nav').addClass('active')
    </script>
@endsection
