@extends('layouts.staff.app')

@section('title', 'Staff | Manage Booking')

@section('styles')
<style>
    /* Adjust image size */
    /* Adjust image size and alignment */
     /* Adjust image size and alignment to complement pet details */
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
    /* Card styling */
    .card {
        border: 1px solid #ddd !important;
        border-radius: 8px !important;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;
        overflow: hidden !important;
    }

    .card-body {
        padding: 1.5rem !important;
    }

    /* Typography */
    h4 {
        /* font-size: 1.2rem !important; */
        line-height: 1.5 !important;
    }

    .font-weight-bold {
        color: #333 !important;
    }

    /* Status badge styling */
    .badge {
        /* font-size: 0.85rem !important; */
        border-radius: 12px !important;
    }

    .badge.bg-primary {
        background-color: #007bff !important;
    }

    .badge.bg-success {
        background-color: #28a745 !important;
    }

    .badge.bg-danger {
        background-color: #dc3545 !important;
    }

    /* Buttons */
    .btn-primary {
        background-color: #007bff !important;
        border-color: #007bff !important;
        transition: background-color 0.3s ease, transform 0.2s ease !important;
    }

    .btn-primary:hover {
        background-color: #0056b3 !important;
        transform: scale(1.05) !important;
    }
    
</style>
@endsection


@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('staff.bookings.index') }}">All
                        Bookings</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Date Schedule : <span class="fw-bold ">{{ formatDate($booking->schedule->date_time_start) }} at
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
                            <div class="col-md-8">
                                <div class="row text-md-start py-3 details-section">
                                    <div class="col-md-4">
                                        <img class="img-avatar rounded-circle mx-1"
                                            src="{{ handleNullAvatarForPet($booking->pet?->avatar_profile) }}"
                                            alt="avatar">
                                    </div>
                                    <div class="col-md-8">
                                        <h4 class="font-weight-normal">Pet: <span class="font-weight-bold">{{ $booking->pet->name }}</span></h4>
                                        <h4 class="font-weight-normal">Breed: <span class="font-weight-bold">{{ $booking->pet->breed }}</span></h4>
                                        <h4 class="font-weight-normal">Sex: <span class="font-weight-bold">{{ $booking->pet->sex }}</span></h4>
                                        <h4 class="font-weight-normal">Owner: <span class="font-weight-bold">{{ $booking->pet->customer->full_name }}</span></h4>
                                        <h4 class="font-weight-normal">Service: <span class="font-weight-bold">{{ $booking->schedule->service->name }}</span></h4>
                                        <h4 class="font-weight-normal">Date Schedule: <span class="font-weight-bold">{{ formatDate($booking->schedule->date_time_start) }} <i class="far fa-calendar ms-1"></i></span></h4>
                                        <h4 class="font-weight-normal">At: <span class="font-weight-bold">{{ formatDate($booking->schedule->date_time_start, 'time') }} - {{ formatDate($booking->schedule->date_time_end, 'time') }} <i class="far fa-clock ms-1"></i></span></h4>
                                        <h4 class="font-weight-normal">Customer's Note: <span class="font-weight-bold">{{ $booking->note ?? 'N/A' }}</span></h4>

                                        {{-- Status --}}
                                        <h4 class="font-weight-normal">Status: {!! handleBookingStatus($booking->status) !!}</h4>

                                        @if ($booking->remark)
                                            <h4 class="font-weight-normal">Remark: {{ $booking->remark }}</h4>
                                        @endif

                                        {{-- Payment Information Below the Status --}}
                                        @if ($booking->is_online)
                                            <h4 class="font-weight-normal">Control No: <span class="font-weight-bold">{{ $booking->reference_no }}</span></h4>
                                            <h4 class="font-weight-normal">Paid Via: <span class="badge bg-primary p-2 text-white">{{ $booking->payment_method->type }}</span></h4>

                                            <a class="text-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                View Payment Receipt
                                            </a>

                                            <div class="collapse mt-3" id="collapseExample">
                                                <a class="glightbox" href="{{ handleNullImage($booking->payment_receipt) }}">
                                                    <img class="img-thumbnail" src="{{ handleNullImage($booking->payment_receipt) }}" width="100" alt="payment receipt">
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- Right Section for Manage Booking and Move Schedule --}}
                            <div class="col-md-4 info-section">
                                {{-- Check for Approval --}}
                                {{-- @if ($booking->status == 0) --}}
                                <div class="nav-wrapper">
                                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text"
                                        role="tablist">

                                        <li class="nav-item">
                                            <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab"
                                                data-toggle="tab" href="#tabs-icons-text-1" role="tab"
                                                aria-controls="tabs-icons-text-1" aria-selected="true"><i
                                                    class="fas fa-cog mr-2"></i>Manage Booking</a>
                                        </li>

                                        @if ($booking->status !== 2)
                                            <li class="nav-item">
                                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab"
                                                    data-toggle="tab" href="#tabs-icons-text-2" role="tab"
                                                    aria-controls="tabs-icons-text-2" aria-selected="false"><i
                                                        class="far fa-calendar mr-2"></i>Move Schedule</a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="card shadow">
                                    <div class="card-body">
                                        <div class="tab-content" id="myTabContent">

                                            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel"
                                                aria-labelledby="tabs-icons-text-1-tab">
                                                <form action="{{ route('staff.bookings.update', $booking) }}"
                                                    method="post" id="booking_form">
                                                    @csrf @method('PUT')
                                                    {{-- @include('layouts.includes.alert') <br> --}}


                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Select Status *</label>
                                                        <select class="form-control" name="status" required>
                                                            <option value=""></option>
                                                            <option value="1"
                                                                @if ($booking->status == 1) selected @endif>Approve
                                                                Request</option>
                                                            <option value="2"
                                                                @if ($booking->status == 2) selected @endif>Cancel
                                                                Request</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <textarea class="form-control" name="remark" rows="5" placeholder="Add Remark (Optional)">{{ $booking->remark }}</textarea>
                                                    </div>

                                                    <button class="btn btn-primary float-end" type="button"
                                                        onclick="event.preventDefault();confirm('Do you want to Update Booking?', '', 'Yes').then(res => res.isConfirmed ? $('#booking_form').submit() : false )">
                                                        Save
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel"
                                                aria-labelledby="tabs-icons-text-2-tab">
                                                <form action="{{ route('staff.bookings.update', $booking->id) }}"
                                                    method="post" id="move_schedule">
                                                    @csrf @method('PUT')
                                                    @include('layouts.includes.alert') <br>

                                                    <div class="form-group mb-3">
                                                        <select class="form-control" name="schedule_id" required>
                                                            <option value=""> ----Select Schedule ----</option>
                                                            @foreach ($schedules as $schedule)
                                                                <option value="{{ $schedule->id }}">
                                                                    {{ formatDate($schedule->date_time_start) }} at
                                                                    {{ formatDate($schedule->date_time_start, 'time') }}
                                                                    -
                                                                    {{ formatDate($schedule->date_time_end, 'time') }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <textarea class="form-control" name="remark" rows="5" placeholder="Add Remark (Optional)">{{ $booking->remark }}</textarea>
                                                    </div>

                                                    <input type="hidden" name="old_schedule"
                                                        value="{{ $booking->schedule_id }}">
                                                    <button class="btn btn-primary float-end" type="button"
                                                        onclick="event.preventDefault();confirm('Do you want to Move Schedule?', '', 'Yes').then(res => res.isConfirmed ? $('#move_schedule').submit() : false )">
                                                        Save
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- @endif --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card card-body">
                    <h3>Appointment Results <i class="fas fa-clipboard-list ml-1"></i>
                        <div class="float-right">
                            <a class="btn btn-sm btn-primary me-3"
                                href="{{ route('staff.bookings.results.create', $booking) }}">Create
                                Result +
                            </a>

                            <a class="btn btn-sm btn-primary"
                                href="{{ route('staff.print.handle') }}?records=result&booking={{ $booking->id }}">Print
                                Result <i class="fas fa-print ml-1"></i>
                            </a>
                        </div>

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
                                                        href='{{ route('staff.bookings.results.show', [$booking, $result]) }}'>View
                                                    </a>
                                                    <a class='dropdown-item'
                                                        href='{{ route('staff.bookings.results.edit', [$booking, $result]) }}'>Edit
                                                    </a>
                                                    {{-- <a class='dropdown-item' href='javascript:void(0)'
                                                        onclick="promptDestroy(event, '#remove_result-{{ $result->id }}')">Delete
                                                    </a>

                                                    <form
                                                        action="{{ route('staff.bookings.results.destroy', [$booking, $result]) }}"
                                                        method="POST" id="remove_result-{{ $result->id }}">
                                                        @csrf @method('DELETE')
                                                    </form> --}}
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

            {{-- Prescriptions --}}
            <div class="col-md-12">
                <div class="card card-body">
                    <h3>Prescriptions <i class="fas fa-prescription ml-1"></i>
                        <div class="float-right">
                            <a class="btn btn-sm btn-primary me-3"
                                href="{{ route('staff.bookings.prescriptions.create', $booking) }}">Create
                                Prescription +
                            </a>

                            @if ($prescriptions->isNotEmpty())
                                <a class=" btn btn-sm btn-primary me-3"
                                    href="{{ route('staff.print.handle') }}?records=prescription&booking={{ $booking->id }}">Print
                                    Prescription <i class="fas fa-print ml-1"></i>
                                </a>
                            @endif
                        </div>
                    </h3>
                    <br><br>
                    @if ($prescriptions->isNotEmpty())
                        <div class="table-responsive">
                            <table class="table table-hover booking_dt">
                                <thead>
                                    <tr>
                                        <th>Drug</th>
                                        <th>Description</th>
                                        <th>Dosage</th>
                                        <th>Qty</th>
                                        <th>Directions</th>
                                        <th>Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prescriptions as $prescription)
                                        <tr>
                                            <td>
                                                {{ $prescription->drug }}
                                            </td>
                                            <td>
                                                {{ $prescription->description }}
                                            </td>
                                            <td>
                                                {{ $prescription->preparation }}
                                            </td>
                                            <td>
                                                {{ $prescription->qty }}
                                            </td>
                                            <td>
                                                {{ $prescription->direction }}
                                            </td>
                                            <td>{{ formatDate($prescription->created_at) }}</td>
                                            <td>
                                                <div class='dropdown'>
                                                    <a class='btn btn-sm btn-icon-only text-light' href='#'
                                                        data-toggle='dropdown' aria-haspopup='true'
                                                        aria-expanded='false'>
                                                        <i class='fas fa-ellipsis-v'></i>
                                                    </a>
                                                    <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>
                                                        <a class='dropdown-item'
                                                            href='{{ route('staff.bookings.prescriptions.edit', [$booking, $prescription]) }}'>Edit
                                                        </a>
                                                        {{-- <a class='dropdown-item' href='javascript:void(0)'
                                                            onclick="promptDestroy(event, '#remove_prescription-{{ $prescription->id }}')">Delete
                                                        </a>

                                                        <form
                                                            action="{{ route('staff.bookings.prescriptions.destroy', [$booking, $prescription]) }}"
                                                            method="POST"
                                                            id="remove_prescription-{{ $prescription->id }}">
                                                            @csrf @method('DELETE')
                                                        </form> --}}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                        </div>
                    @else
                        <img class="img-fluid d-block mx-auto" src="{{ asset('img/nodata.svg') }}" alt="">
                    @endif
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
