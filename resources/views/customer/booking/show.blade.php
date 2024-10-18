@extends('layouts.customer.app')

@section('title', "$app_name | Booking History")

@section('styles')
    <style>
        td {
            white-space: normal !important;
            text-align: justify;
        }
    </style>
@endsection

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('customer.bookings.index') }}">All
                        Bookings</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Date Schedule : <span class="font-weight-bold ">{{ formatDate($booking->schedule->date_time_start) }} at
                        {{ formatDate($booking->schedule->date_time_start, 'time') }}
                        - {{ formatDate($booking->schedule->date_time_end, 'time') }}</span>
                </li>
            </ol>
        </nav>

        @include('layouts.includes.alert')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body pt-3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row text-md-start py-3">
                                    <div class="col-md-8 font-weight-normal">
                                        <img class="img-fluid rounded-circle mx-1"
                                            src="{{ handleNullAvatarForPet($booking->pet?->avatar_profile) }}"
                                            width="75" alt="avatar"> <br><br>

                                        <h4 class="font-weight-normal">Pet :
                                            <span class="font-weight-bold ">{{ $booking->pet->name }}</span>
                                        </h4>

                                        <h4 class="font-weight-normal">Breed :
                                            <span class="font-weight-bold ">{{ $booking->pet->breed }}</span>
                                        </h4>

                                        <h4 class="font-weight-normal">Sex :
                                            <span class="font-weight-bold ">{{ $booking->pet->sex }}</span>
                                        </h4>


                                        <h4 class="font-weight-normal">Owner :
                                            <span class="font-weight-bold ">{{ $booking->pet->customer->full_name }}</span>
                                        </h4>

                                        <h4 class="font-weight-normal">Service :
                                            <span class="font-weight-bold ">{{ $booking->schedule->service->name }}</span>
                                        </h4>

                                        <h4 class="font-weight-normal">Date Schedule : <span
                                                class="font-weight-bold ">{{ formatDate($booking->schedule->date_time_start) }}
                                                <i class="far fa-calendar ms-1"></i></span> </h4>
                                        <h4 class="font-weight-normal">at <span
                                                class="font-weight-bold ">{{ formatDate($booking->schedule->date_time_start, 'time') }}
                                                - {{ formatDate($booking->schedule->date_time_end, 'time') }}
                                                <i class="far fa-clock ms-1"></i>
                                            </span>
                                        </h4>

                                        <h4 class="font-weight-normal">Customer's Note :
                                            <span class="font-weight-bold ">{{ $booking->note ?? 'N/A' }}</span>
                                        </h4>

                                        {{-- Status --}}
                                        <h4 class=" font-weight-normal">Status - {!! handleBookingStatus($booking->status) !!}</h4>
                                        @if ($booking->remark)
                                            <h4 class="font-weight-normal">
                                                Remark: {{ $booking->remark }}
                                            </h4>
                                        @endif

                                        <h4 class="mt-2 font-weight-light">Control No : <span
                                                class="font-weight-bold">{{ $booking->reference_no }}</span>
                                        </h4>
                                        <h4 class="mt-2 font-weight-light">Paid Via : <span
                                                class="badge bg-primary p-2 text-white">{{ $booking->payment_method->type }}</span>
                                        </h4>

                                        <a class="text-primary" data-toggle="collapse" href="#collapseExample"
                                            role="button" aria-expanded="false" aria-controls="collapseExample">
                                            View Payment Receipt
                                        </a>

                                        <div class="collapse mt-3" id="collapseExample">
                                            <a class="glightbox" href="{{ handleNullImage($booking->payment_receipt) }}">
                                                <img class="img-thumbnail"
                                                    src="{{ handleNullImage($booking->payment_receipt) }}" width="100"
                                                    alt="payment receipt">
                                            </a>
                                        </div>

                                        <br>
                                    </div>
                                    {{-- Only show if booking is thru online --}}
                                    {{-- @if ($booking->is_online)
                                        <div class="col-md-4">
                                            <figure class="d-md-block d-none">
                                                <a class="glightbox" href="{{ $booking->patient_id }}">
                                                    <img class="img-fluid"
                                                        src="{{ handleNullImage($booking->patient_id) }}" width="150"
                                                        alt="patient_id">
                                                </a>
                                            </figure>
                                            <div class="d-block d-md-none">

                                                <a class="font-weight-bold " href="{{ handleNullImage($booking->patient_id) }}"
                                                    download>Download
                                                    ID <i class="fas fa-download"></i></a>
                                            </div>
                                            <hr class="d-block d-md-none">
                                        </div>
                                    @endif --}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-body">
                    <h3>Appointment Results <i class="fas fa-clipboard-list ml-1"></i>

                    </h3>
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
                                        {{-- {{ dd($result->media) }} --}}
                                        <td>
                                            @if ($result->media->isNotEmpty())
                                                <a href="{{ route('results.download', $result) }}">Download</a>
                                            @endif
                                        </td>
                                        <td>{{ formatDate($result->created_at) }}</td>
                                        <td>
                                            <div class='dropdown'>
                                                <a class='btn btn-sm btn-icon-only text-light' href='#'
                                                    data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    <i class='fas fa-ellipsis-v'></i>
                                                </a>
                                                <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>
                                                    <a class='dropdown-item'
                                                        href='{{ route('customer.bookings.results.show', [$booking, $result]) }}'>View
                                                    </a>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>Results Not Found</td>
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
