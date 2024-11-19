@extends('layouts.customer.app')

@section('title', "$app_name | Booking")

@section('styles')
    <script src="https://www.google.com/recaptcha/enterprise.js" async defer></script>
@endsection

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid pl-4 pl-md-0 py-3">
        @include('layouts.includes.alert')

        <nav aria-label="breadcrumb mb-1">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="{{ route('customer.services.schedules.index', [$service]) }}">All
                        Schedules</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $service->name }}</li>
            </ol>
        </nav>


        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            We kindly request a P50 convenience charge to secure your slot. Please understand that this fee is
            non-refundable if you miss your appointment.If you need to reschedule, feel free to contact our friendly customer support at 0922 451 3582. Your cooperation and support help us maintain an efficient
            appointment system to serve you and all our customers better. Thank you for choosing our services!

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        {{-- payment_method --}}
        <div class="modal fade" id="m_payment_method" tabindex="-1" role="dialog" aria-labelledby="m_payment_method_label"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h6 class="modal-title text-white"><i class="fas fa-info-circle me-1"></i> List of Available Payment
                            Options </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body py-5">
                        <table class="table table-sm table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Account Name</th>
                                    <th>Account No.</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payment_methods as $pm)
                                    <tr>
                                        <td>{{ $pm->type }}</td>
                                        <td>{{ $pm->account_name }}</td>
                                        <td>{{ $pm->account_no }}</td>
                                        <td>{!! isPaymentMethodOnline($pm->is_online) !!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        {{-- End payment_method --}}

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body pt-3">
                        <div class="row">
                            {{-- reserved --}}
                            @if (!is_null($schedule->booking))

                                {{-- check if its approved or canceled --}}
                                @if ($schedule->booking->is_approved == \App\Models\Booking::APPROVED)
                                    <div class="col-md-12">
                                        <img class="img-fluid d-block mx-auto" src="{{ asset('img/booking/canceled.png') }}"
                                            width="500" alt="available">
                                        <figcaption>
                                            <p class="text-center text-primary lead">Reserved Schedule<i
                                                    class="fas fa-check-circle ms-1"></i></p>
                                        </figcaption>
                                    </div>
                                @endif

                                @if ($schedule->booking->is_approved == \App\Models\Booking::CANCELED)
                                    {{-- available --}}
                                    <div class="col-md-7">
                                        <img class="img-fluid d-none d-lg-block mx-md-auto"
                                            src="{{ asset('img/booking/create.svg') }}" alt="book_schedule">

                                    </div>
                                    <div class="col-md-4">
                                        <h2 class="text-primary fw-bold">{{ $app_name }}
                                        </h2>
                                        <h3 class="font-weight-normal">{{ formatDate($schedule->date_time_start) }} <i
                                                class="far fa-calendar-alt ms-1"></i></h3>
                                        <h3 class="font-weight-normal">@
                                            {{ formatDate($schedule->date_time_start, 'time') }} -
                                            {{ formatDate($schedule->date_time_end, 'time') }} <i
                                                class="far fa-clock ms-1"></i> </h3>
                                        <a href="javascript:void(0)" onclick="$('#m_payment_method').modal('show')">
                                            <small>View Payment Options
                                                <i class="fas fa-info-circle ms-1"></i>
                                            </small>
                                        </a>
                                        <br>
                                        <br>
                                        <form
                                            action="{{ route('customer.services.medical_staffs.schedules.bookings.store', [$service, $medical_staff, $schedule->id]) }}"
                                            method="post" enctype="multipart/form-data" id="booking_form">
                                            @csrf

                                            @include('layouts.includes.alert')

                                            <div class="form-group mb-2 ">
                                                <label class="form-label">Name</label>
                                                <input class="form-control" type="text"
                                                    value="{{ auth()->user()->customer->full_name }}" readonly>
                                            </div>

                                            <div class="form-group mb-2 ">
                                                <label class="form-label">Service</label>
                                                <input class="form-control" type="text" name="service_id"
                                                    value="{{ $service->name }}" readonly>
                                            </div>
                                            <div class="form-group mb-2 ">
                                                <label class="form-label">Doctor</label>
                                                <input class="form-control" type="text" name="medical_staff_id"
                                                    value="{{ $medical_staff->full_name }}" readonly>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label class="form-label">Select Payment Method *</label>
                                                <select class="form-control" name="payment_method_id">
                                                    <option value=""></option>
                                                    @foreach ($payment_methods as $payment_method)
                                                        <option value="{{ $payment_method->id }}">
                                                            {{ $payment_method->type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label class="form-label">Reference No. *</label>
                                                <input class="form-control" type="text" name="reference_no"
                                                    placeholder="Enter the reference / control no." required>
                                            </div>


                                            <div class="form-group mb-2">
                                                <label class="form-label">Add Note (Optional)</label>
                                                <input class="form-control" type="text" name="note">
                                            </div>


                                            <div class="form-group mb-2">
                                                <input class="valid_id" type="file" name="image">
                                            </div>

                                            <div class="form-text">Note* To process your request, we require you to submit
                                                your valid ID.</div>

                                            <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">

                                        </form>

                                        <div>
                                            <button class="btn btn-sm btn-primary float-end" type="button"
                                                onclick="event.preventDefault();confirm('Do you want to submit?','Double check your provided credentials before proceeding 💭.', 'Yes').then(res => res.isConfirmed ? $('#booking_form').submit() : false)">
                                                Submit
                                            </button>
                                        </div>
                                @endif
                                <div class="col-md-12">
                                    <img class="img-fluid d-block mx-auto" src="{{ asset('img/booking/canceled.png') }}"
                                        width="500" alt="reserved"> <br>
                                    <h3 class="text-center font-weight-normal text-muted">Reserved Schedule</h3>
                                </div>
                            @else
                                @if (date('Y-m-d') > $schedule->date_time_start)
                                    {{-- not available --}}
                                    <div class="col-md-12">
                                        <img class="img-fluid d-block mx-auto"
                                            src="{{ asset('img/booking/canceled.png') }}" width="500" alt="closed">
                                        <br>
                                        <h3 class="text-center text-danger font-weight-normal">Schedule has been
                                            closed
                                        </h3>
                                    </div>
                                @else
                                    {{-- available --}}
                                    <div class="col-md-7">
                                        <div class="alert alert-warning" role="alert">
                                            Reminder: {{ $app_name }} does not accept emergency requests via this
                                            web-app.

                                            Please note that our web-app is intended for non-emergency appointments only. If
                                            you require urgent medical attention, please call your local emergency services
                                            or go to your nearest emergency room.
                                            <br>
                                            Contact Us - 0922 451 3582
                                            <br>
                                            Located at, Tungkop, Minglanilla, Cebu, Philippines
                                            <br>
                                        </div>

                                        <img class="img-fluid d-none d-lg-block mx-md-auto"
                                            src="{{ asset('img/booking/create.svg') }}" alt="book_schedule">

                                    </div>
                                    <div class="col-md-4">
                                        <h2 class="text-primary fw-bold">{{ $app_name }}
                                        </h2>
                                        <h3 class="font-weight-normal">{{ formatDate($schedule->date_time_start) }} <i
                                                class="far fa-calendar-alt ms-1"></i></h3>
                                        <h3 class="font-weight-normal">@
                                            {{ formatDate($schedule->date_time_start, 'time') }} -
                                            {{ formatDate($schedule->date_time_end, 'time') }} <i
                                                class="far fa-clock ms-1"></i>
                                        </h3>
                                        <a href="javascript:void(0)" onclick="$('#m_payment_method').modal('show')">
                                            <small>View Payment Options
                                                <i class="fas fa-info-circle ms-1"></i>
                                            </small>
                                        </a>
                                        <br><br>
                                        <form
                                            action="{{ route('customer.services.schedules.bookings.store', [$service, $schedule->id]) }}"
                                            method="post" enctype="multipart/form-data" id="booking_form">
                                            @csrf


                                            <div class="form-group mb-2 ">
                                                <label class="form-label">Owner</label>
                                                <input class="form-control" type="text"
                                                    value="{{ auth()->user()->customer->full_name }}" readonly>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label class="form-label">Select Pet *</label>
                                                <select class="form-control" name="pet_id" required>
                                                    <option value=""></option>
                                                    @foreach ($pets as $id => $pet)
                                                        <option value="{{ $id }}">{{ $pet }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group mb-2 ">
                                                <label class="form-label">Service</label>
                                                <input class="form-control" type="text" name="service_id"
                                                    value="{{ $service->name }}" readonly>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label class="form-label">Select Payment Method *</label>
                                                <select class="form-control" name="payment_method_id">
                                                    <option value=""></option>
                                                    @foreach ($payment_methods as $payment_method)
                                                        <option value="{{ $payment_method->id }}">
                                                            {{ $payment_method->type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label class="form-label">Reference No. *</label>
                                                <input class="form-control" type="text" name="reference_no"
                                                    placeholder="Enter the reference / control no." required>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label class="form-label">Add Note (Optional)</label>
                                                <input class="form-control" type="text" name="note">
                                            </div>

                                            <div class="form-group mb-2">
                                                <input class="payment_receipt" type="file" name="image">
                                            </div>

                                            <div class="form-text">Note* Attach a screenshot of your Payment
                                                Transaction</div><br>

                                            <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">

                                            <div class="g-recaptcha"
                                                data-sitekey="6LcIZPclAAAAAPFFV8DDOhJiAyma_73wiFe0uPuc"
                                                data-action="LOGIN"></div>
                                            <br />

                                        </form>

                                        <div class="mt-1">
                                            <button class="btn btn-primary float-end" type="button"
                                                onclick="event.preventDefault();confirm('Do you want to book this schedule?','Double check your provided credentials before proceeding 💭.', 'Yes').then(res => res.isConfirmed ? $('#booking_form').submit() : false)">
                                                Book Now
                                            </button>
                                        </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- End CONTAINER --}}
@endsection

@section('script')
    <script>
        initiateFilePond('.payment_receipt', ["image/png", "image/jpeg", "image/jpg", "image/webp"],
            'Drag & Drop or <b>Browse Payment Screenshot</b>')
    </script>
@endsection
