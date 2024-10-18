@extends('layouts.staff.app')

@section('title', 'Staff | Create Schedule')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> {{-- Datepicker --}}
@endsection

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('staff.schedules.index') }}">All Schedules</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Create Schedule</li>
            </ol>
        </nav>

        <div class="nav-wrapper">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">

                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab"
                        href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i
                            class="fas fa-calendar mr-2"></i>Manual Scheduling</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab"
                        href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i
                            class="far fa-calendar mr-2"></i>Bulk Scheduling</a>
                </li>
            </ul>
        </div>


        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel"
                aria-labelledby="tabs-icons-text-1-tab">
                <div class="card ">
                    <div class="card-body pt-3">
                        <div class="row">
                            <div class="col-md-6 d-none d-md-block">
                                <img src="{{ asset('img/schedule/create.svg') }}" class="img-fluid  d-block mx-auto"
                                    alt="schedule">
                            </div>
                            <div class="col-md-6">
                                <div class="row justify-content-center p-5">
                                    <form action="{{ route('staff.schedules.store') }}" method="post">
                                        @csrf
                                        <h1 class="font-weight-normal text-primary">Create Schedule
                                            <i class="fas fa-calendar ml-1"></i>
                                        </h1>
                                        @include('layouts.includes.alert')
                                        <br>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-text"><i class="fas fa-info-circle mr-1"></i>
                                                    You can
                                                    add
                                                    multiple date-time
                                                    schedule.</div> <br>
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Select Service *</label>
                                                    <select class="form-control" name="service_id">
                                                        <option value=""></option>
                                                        @foreach ($services as $id => $service)
                                                            <option value="{{ $id }}">
                                                                {{ $service }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div id="schedule_input">
                                                    <div class="row">

                                                        <div class="col-5">
                                                            <label>Date Time Start *</label>
                                                            <div class="input-group input-group-outline mb-3 ">
                                                                <input type="datetime-local"
                                                                    class="form-control date_time_start"
                                                                    name="date_time_start[]" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-5">
                                                            <label>Date Time End *</label>
                                                            <div class="input-group input-group-outline mb-3 ">
                                                                <input type="datetime-local"
                                                                    class="form-control date_time_end"
                                                                    name="date_time_end[]" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                            <br>
                                                            <button type="button" class="btn btn-primary rounded mt-2"
                                                                onclick="addScheduleInputField()"> <i
                                                                    class="fas fa-plus-circle fa-lg"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="type" value="manual">

                                        <div class="form-group mt-3">
                                            <button type="submit" class="btn btn-primary rounded">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('staff.schedules.store') }}" method="post">
                            @csrf
                            <h1 class="font-weight-normal text-primary">Create Schedule
                                <i class="fas fa-calendar ml-1"></i>
                            </h1>
                            @include('layouts.includes.alert')
                            <br>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Select Service *</label>
                                        <select class="form-control" name="service_id">
                                            <option value=""></option>
                                            @foreach ($services as $id => $service)
                                                <option value="{{ $id }}">
                                                    {{ $service }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div id="bulk_schedule_input">
                                        <div class="row">

                                            <div class="col-12 col-lg-2">
                                                <label>Day Type *</label>
                                                <div class="input-group input-group-outline mb-3 ">
                                                    <select class="form-control bulk_schedule_day_type" name="day_type[]"
                                                        required>
                                                        <option value=""></option>
                                                        <option value="Monday">Monday</option>
                                                        <option value="Tuesday">Tuesday</option>
                                                        <option value="Wednesday">Wednesday</option>
                                                        <option value="Thursday">Thursday</option>
                                                        <option value="Friday">Friday</option>
                                                        <option value="Saturday">Saturday</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-2">
                                                <label>Time Start *</label>
                                                <div class="input-group input-group-outline mb-3 ">
                                                    <input type="time" class="form-control bulk_schedule_time_start"
                                                        name="time_start[]" required>
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-2">
                                                <label>Time End *</label>
                                                <div class="input-group input-group-outline mb-3 ">
                                                    <input type="time" class="form-control bulk_schedule_time_end"
                                                        name="time_end[]" required>
                                                </div>
                                            </div>

                                            <div class="col-9 col-lg-2">
                                                <label>No. Of Days (Max 60) *</label>
                                                <div class="input-group input-group-outline mb-3 ">
                                                    <input type="number" min="0" max="60"
                                                        class="form-control bulk_schedule_no_of_days" name="no_of_days[]"
                                                        required>
                                                </div>
                                            </div>

                                            <div class="col-3 col-lg-2">
                                                <br>
                                                <button type="button" class="btn btn-primary rounded mt-2"
                                                    onclick="addBulkScheduleInputField()"> <i
                                                        class="fas fa-plus-circle fa-lg"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="type" value="bulk">

                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary rounded">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <br>
    </div>
    {{-- End CONTAINER --}}

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> {{-- Datepicker --}}
    <script>
        initiateDatePicker(".date_time_start", ".date_time_end");


        function addScheduleInputField() {
            let id = Math.floor((Math.random() * 100) + 1);
            let output = `
    
                    <div class="row" id='row_input-${id}'>
                                    <div class="col-5">
                                        <label>Date Time Start *</label>
                                        <div class="input-group input-group-outline mb-3 ">
                                            <input type="datetime-local" class="form-control date_time_start" name="date_time_start[]" required>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <label>Date Time End *</label>
                                        <div class="input-group input-group-outline mb-3 ">
                                            <input type="datetime-local" class="form-control date_time_end" name="date_time_end[]" required>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <br>
                                        <button type='button' class="btn btn-danger rounded mt-2" onclick="removeScheduleInputField(${id})"> <i class="fas fa-minus-circle fa-lg"></i> </button>
                                    </div>
                    </div>
    
    `
            $('#schedule_input').append(output)

            initiateDatePicker(".date_time_start", ".date_time_end");
        }

        function removeScheduleInputField(id) {
            $('#row_input-' + id).remove()
        }


        function initiateDatePicker(date_time_start, date_time_end) {
            const config = {
                minDate: "today",
                "disable": [
                    function(date) {
                        // return true to disable
                        return (date.getDay() === 0 || date.getDay() === 6);

                    }
                ],
                "locale": {
                    "firstDayOfWeek": 1 // start week on Monday
                },
                // dateFormat: "M d,Y h:i",
                enableTime: true,
                minTime: "08:00",
                maxTime: "17:00",
            };

            $(date_time_start).flatpickr(config);
            $(date_time_end).flatpickr(config);
        }



        // ======================== Bulk Input ==================


        function addBulkScheduleInputField() {
            let id = Math.floor((Math.random() * 100) + 1);
            let output = `
                <div class="row" id='bulk_schedule_row_input-${id}'>
                            <div class="col-12 col-lg-2">
                                <label>Day Type *</label>
                                <div class="input-group input-group-outline mb-3 ">
                                    <select class="form-control bulk_schedule_date_day_type"
                                        name="day_type[]" required>
                                        <option value=""></option>
                                        <option value="Monday">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Friday">Friday</option>
                                        <option value="Saturday">Saturday</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-lg-2">
                                <label>Time Start *</label>
                                <div class="input-group input-group-outline mb-3 ">
                                    <input type="time"
                                        class="form-control bulk_schedule_time_start"
                                        name="time_start[]" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-2">
                                <label>Time End *</label>
                                <div class="input-group input-group-outline mb-3 ">
                                    <input type="time" class="form-control bulk_schedule_time_end"
                                        name="time_end[]" required>
                                </div>
                            </div>

                            <div class="col-9 col-lg-2">
                                <label>No. Of Days *</label>
                                <div class="input-group input-group-outline mb-3 ">
                                    <input type="number" min="0"
                                        class="form-control bulk_schedule_no_of_days"
                                        name="no_of_days[]" required>
                                </div>
                            </div>
                            <div class="col-3 col-lg-2">
                                <br>
                                <button type='button' class="btn btn-danger rounded mt-2" onclick="removeBulkScheduleInputField(${id})"> <i class="fas fa-minus-circle fa-lg"></i> </button>
                            </div>
                </div>
        `
            $('#bulk_schedule_input').append(output)

        }


        function removeBulkScheduleInputField(id) {
            $('#bulk_schedule_row_input-' + id).remove()
        }
    </script>

@endsection
