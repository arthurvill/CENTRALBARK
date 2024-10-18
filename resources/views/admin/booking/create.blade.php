@extends('layouts.admin.app')

@section('title', 'Admin | Create Booking')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid pl-4 pl-md-0 py-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-0">
                        <a class="text-primary" href="{{ route('admin.bookings.index') }}"><i
                                class="fas fa-arrow-left fa-lg"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <img class="img-fluid d-none d-lg-block mx-md-auto"
                                    src="{{ asset('img/booking/create.svg') }}" alt="book_schedule">
                            </div>
                            <div class="col-md-4">
                                <h1 class="text-primary font-weight-normal">Create Appointment for Walk-in <i
                                        class="fas fa-clipboard-list ml-1"></i>
                                </h1>
                                <form action="{{ route('admin.bookings.store') }}" method="post"
                                    enctype="multipart/form-data" id="booking_form">
                                    @csrf

                                    @include('layouts.includes.alert')
                                    <br>
                                    <div class="form-group mb-3">
                                        <label class="form-label">Select Pet *</label>
                                        <select class="form-control" name="pet_id">
                                            <option value=""></option>
                                            @foreach ($pets as $pet)
                                                <option value="{{ $pet->id }}">
                                                    {{ $pet->id }} - {{ $pet->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label">Select Schedule *</label>
                                        <select class="form-control" name="schedule_id" required>
                                            <option value=""> ----Select Schedule ----</option>
                                            @foreach ($schedules as $schedule)
                                                <option value="{{ $schedule->id }}">
                                                    {{ formatDate($schedule->date_time_start) }} at
                                                    {{ formatDate($schedule->date_time_start, 'time') }}
                                                    -
                                                    {{ formatDate($schedule->date_time_end, 'time') }}
                                                    -
                                                    ({{ $schedule->service->name }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label">Add Note (Optional)</label>
                                        <input class="form-control" type="text" name="note">
                                    </div>

                                </form>

                                <div class="mt-3">
                                    <button class="btn btn-primary float-end" type="button"
                                        onclick="event.preventDefault();confirm('Do you want to set this appointment schedule?','Double check your selected inputs.', 'Yes').then(res => res.isConfirmed ? $('#booking_form').submit() : false)">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End CONTAINER --}}
@endsection
