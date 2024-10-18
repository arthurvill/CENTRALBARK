@extends('layouts.staff.app')

@section('title', 'General Overview')

@section('styles')
    <style>
        td {
            word-wrap: break-word;
            word-break: break-all;
            white-space: normal !important;
            text-align: justify;
        }
    </style>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="container-fluid mt-3">

        <ul class="nav nav-pills nav-fill flex-row" id="tabs-icons-text" role="tablist">
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0 @if (!request()->query('tab') || request()->query('tab') == 'graphs') active @endif" id="tabs-icons-text-0-tab"
                    data-toggle="tab" href="#tabs-icons-text-0" role="tab" aria-controls="tabs-icons-text-0"
                    aria-selected="true"><i class="fas fa-project-diagram mr-2"></i>Graphs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0 @if (request()->query('tab') == 'tables') active @endif"
                    id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab"
                    aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fas fa-table mr-2"></i>Tables</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            {{-- Tab 0 --}}
            <div class="tab-pane fade @if (!request()->query('tab') || request()->query('tab') == 'graphs') show active @endif" id="tabs-icons-text-0"
                role="tabpanel" aria-labelledby="tabs-icons-text-0-tab">
                <br>
                <form class action="{{ route('staff.general_reports.index') }}" method="get">
                    <div class="input-group">
                        <input class="form-control form-control-sm" type="text" name="date_started_at"
                            placeholder="Date Started" onfocus="(this.type = 'date')"
                            value="{{ request('date_started_at') ? formatDate(request('date_started_at'), 'dateInput') : '' }}">
                        <input class="form-control form-control-sm" type="text" name="date_ended_at"
                            placeholder="Date Ended" onfocus="(this.type = 'date')"
                            value="{{ request('date_ended_at') ? formatDate(request('date_ended_at'), 'dateInput') : '' }}">
                        <div class="input-group-append">
                            <select class="form-control form-control-sm" name="service">
                                <option value="">-- Select Service --</option>
                                @foreach ($available_service_categories as $available_service_category)
                                    <optgroup label="{{ $available_service_category->name }}">
                                        @foreach ($available_service_category->services as $service)
                                            <option value="{{ $service->id }}"
                                                @if (filled(request('service')) && request('service') == $service->id) selected @endif>
                                                {{ $service->name }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            <input type="hidden" name="tab" value="graphs">
                            <button class="btn btn-sm btn-success">Filter</button>

                        </div>
                    </div>
                </form>
                <br>

                {{-- Start Row --}}
                <div class="row">
                    <div class="col-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">
                                            Total Bookings By
                                            Date Range
                                            and Service -
                                            {{ request('service') ? \App\Models\Service::find(request('service'))->name : '' }}
                                        </h6>
                                    </div>
                                    <div class="col-4">
                                        <a class="btn btn-sm btn-outline-primary float-right" href="javascript:void(0)"
                                            onclick='downloadChart("chart_total_patient_by_date_range_and_service", "Total Bookings By Date Range and Service")'>Download
                                            <i class="fas fa-image ml-1"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <!-- Chart -->
                                <div>
                                    <canvas id="chart_total_patient_by_date_range_and_service"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">

                                            Total
                                            Monthly Customer

                                        </h6>
                                    </div>
                                    <div class="col-4">
                                        <a class="btn btn-sm btn-outline-primary float-right" href="javascript:void(0)"
                                            onclick='downloadChart("chart_total_monthly_customer", "Total Monthly Customer")'>Download
                                            <i class="fas fa-image ml-1"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <!-- Chart -->
                                <div>
                                    <canvas id="chart_total_monthly_customer"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">

                                            Total
                                            Monthly Booking


                                        </h6>
                                    </div>
                                    <div class="col-4">
                                        <a class="btn btn-sm btn-outline-primary float-right" href="javascript:void(0)"
                                            onclick='downloadChart("chart_total_monthly_booking", "Total Monthly Booking")'>Download
                                            <i class="fas fa-image ml-1"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <!-- Chart -->
                                <div>
                                    <canvas id="chart_total_monthly_booking"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">

                                            Total
                                            Schedule By Service


                                        </h6>
                                    </div>
                                    <div class="col-4">
                                        <a class="btn btn-sm btn-outline-primary float-right" href="javascript:void(0)"
                                            onclick='downloadChart("chart_total_schedule_by_service", "Total Schedule By Service")'>Download
                                            <i class="fas fa-image ml-1"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <!-- Chart -->
                                <div>
                                    <canvas id="chart_total_schedule_by_service"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Row --}}

            </div>

            {{-- Tab 1 --}}
            <div class="tab-pane fade @if (request()->query('tab') == 'tables') show active @endif" id="tabs-icons-text-1"
                role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                <br>

                <form class action="{{ route('staff.general_reports.index') }}" method="get">
                    <div class="input-group">
                        <input class="form-control form-control-sm" type="text" name="date_started_at"
                            placeholder="Date Started" onfocus="(this.type = 'date')"
                            value="{{ request('date_started_at') ? formatDate(request('date_started_at'), 'dateInput') : '' }}">
                        <input class="form-control form-control-sm" type="text" name="date_ended_at"
                            placeholder="Date Ended" onfocus="(this.type = 'date')"
                            value="{{ request('date_ended_at') ? formatDate(request('date_ended_at'), 'dateInput') : '' }}">
                        <div class="input-group-append">
                            <select class="form-control form-control-sm" name="service">
                                <option value="">-- Select Service --</option>
                                @foreach ($available_service_categories as $available_service_category)
                                    <optgroup label="{{ $available_service_category->name }}">
                                        @foreach ($available_service_category->services as $service)
                                            <option value="{{ $service->id }}"
                                                @if (filled(request('service')) && request('service') == $service->id) selected @endif>
                                                {{ $service->name }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            <input type="hidden" name="tab" value="tables">
                            <button class="btn btn-sm btn-primary">Filter</button>
                            <a href="{{ route('staff.print.handle') }}?records=general_report"
                                class="btn btn-sm btn-success">Print
                            </a>

                        </div>
                    </div>
                </form>
                <br>
                {{-- Start Row --}}
                <div class="row">
                    <div class="col-12 col-md-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">
                                            List of Patients By Date Range and Service -
                                            {{ request('service') ? \App\Models\Service::find(request('service'))->name : '' }}
                                        </h6>
                                    </div>
                                    <div class="col-md-5">

                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-sm table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Patient</th>
                                                        <th>Services</th>
                                                        <th>Date Schedule</th>
                                                        <th>Reserved At</th>
                                                        {{-- <th>Type</th> --}}
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($patients_by_date_range_and_service as $booking)
                                                        <tr>
                                                            <td>{{ $loop->index + 1 }}</td>
                                                            <td>
                                                                {{ $booking->pet->name }}
                                                            </td>
                                                            <td>
                                                                {{ $booking->schedule->service->name }}
                                                            </td>

                                                            <td>
                                                                {{ formatDate($booking->schedule->date_time_start) . ' at ' . formatDate($booking->schedule->date_time_start, 'time') . ' - ' . formatDate($booking->schedule->date_time_end, 'time') }}
                                                            </td>

                                                            <td>
                                                                {{ formatDate($booking->created_at) }}
                                                            </td>
                                                            {{-- <td>
                                                                {{ strip_tags(isOnline($booking->is_online)) }}

                                                            </td> --}}
                                                            <td>
                                                                {{ strip_tags(handleBookingStatus($booking->status)) }}
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td>Records Not Found</td>
                                                        </tr>
                                                    @endforelse

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                {{-- End Row --}}

                <br>

                {{-- Start Row --}}
                <div class="row">
                    <div class="col-12 col-md-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">
                                            Report Summary
                                            {{ request('service') ? 'for ' . \App\Models\Service::find(request('service'))->name : '' }}
                                        </h6>
                                    </div>
                                    <div class="col-md-5">
                                        <a href="{{ route('staff.print.handle') }}?records=patients_report_summary"
                                            class="btn btn-sm btn-success float-right">Print
                                        </a>

                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Patient</th>
                                                        <th>Service</th>
                                                        <th>Date Schedule</th>
                                                        <th>Reserved At</th>
                                                        <th>Status</th>
                                                        <th>Results</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($patients_report_summary as  $booking)
                                                        <tr>
                                                            <td>{{ $loop->index + 1 }}</td>
                                                            <td>
                                                                {{ $booking->pet->name }}
                                                            </td>
                                                            <td>
                                                                {{ $booking->schedule->service->name }}
                                                            </td>

                                                            <td>
                                                                {{ formatDate($booking->schedule->date_time_start) . ' at ' . formatDate($booking->schedule->date_time_start, 'time') . ' - ' . formatDate($booking->schedule->date_time_end, 'time') }}
                                                            </td>
                                                            <td>
                                                                {{ formatDate($booking->created_at) }}
                                                            </td>

                                                            <td>
                                                                {{ strip_tags(handleBookingStatus($booking->status)) }}
                                                            </td>
                                                            <td>
                                                                @if ($booking->results->isNotEmpty())
                                                                    <table class="table table-sm table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Subject</th>
                                                                                <th>Remark</th>
                                                                                <th>Uploads</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($booking->results as $result)
                                                                                <tr>
                                                                                    <td>{{ $result->subject }}</td>
                                                                                    <td>{{ $result->remark }}</td>
                                                                                    <td>
                                                                                        @if ($result->media->isNotEmpty())
                                                                                            <a
                                                                                                href="{{ route('results.download', $result) }}">Download
                                                                                                File</a>
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach

                                                                        </tbody>
                                                                    </table>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td>Records Not Found</td>
                                                        </tr>
                                                    @endforelse

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Row --}}
            </div>


        </div>
        <!-- End Page Content -->
    @endsection

    @section('script')

        <script>
            const bgc = ['#3498db', '#00cc99', '#ecf0f1', '#2c3e50', '#f1c40f', '#95a5a6', '#ecf0f1'];
            const services = @json($chart_total_patient_by_date_range_and_service[0]);
            const total_bookings = @json($chart_total_patient_by_date_range_and_service[1]);

            const chart_total_patient_by_date_range_and_service = document.getElementById(
                'chart_total_patient_by_date_range_and_service');
            const a = new Chart(chart_total_patient_by_date_range_and_service, {
                type: 'bar', // bar , horizontal, line ,doughnut ,radar , polarArea
                data: {
                    labels: services,
                    datasets: [{
                        label: 'Total Bookings',
                        data: total_bookings,
                        backgroundColor: bgc
                    }],

                },
                options: {
                    title: {
                        display: true,
                        text: 'Total Bookings'
                    }
                }
            });


            const months = @json($chart_total_monthly_customer[0]);
            const total_patients = @json($chart_total_monthly_customer[1]);

            const chart_total_monthly_customer = document.getElementById(
                'chart_total_monthly_customer');
            const b = new Chart(chart_total_monthly_customer, {
                type: 'bar', // bar , horizontal, line ,doughnut ,radar , polarArea
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Total Monthly Patients',
                        data: total_patients,
                        backgroundColor: bgc
                    }],

                },
                options: {
                    title: {
                        display: true,
                        text: 'Total Monthly Patients'
                    }
                }
            });

            const chart_c_months = @json($chart_total_monthly_booking[0]);
            const chart_c_total_bookings = @json($chart_total_monthly_booking[1]);
            const chart_total_monthly_booking = document.getElementById('chart_total_monthly_booking');
            const c = new Chart(chart_total_monthly_booking, {
                type: 'bar', // bar , horizontal, line ,doughnut ,radar , polarArea
                data: {
                    labels: chart_c_months,
                    datasets: [{
                        label: 'Total Monthly Bookings',
                        data: chart_c_total_bookings,
                        backgroundColor: bgc
                    }],

                },
                options: {
                    title: {
                        display: true,
                        text: 'Total Monthly Bookings'
                    }
                }
            });


            const chart_d_services = @json($chart_total_schedule_by_service[0]);
            const total_medical_staffs = @json($chart_total_schedule_by_service[1]);

            const chart_total_schedule_by_service = document.getElementById(
                'chart_total_schedule_by_service');
            const d = new Chart(chart_total_schedule_by_service, {
                type: 'bar', // bar , horizontal, line ,doughnut ,radar , polarArea
                data: {
                    labels: chart_d_services,
                    datasets: [{
                        label: 'Total Schedule By Service',
                        data: total_medical_staffs,
                        backgroundColor: bgc
                    }],

                },
                options: {
                    title: {
                        display: true,
                        text: 'Total Schedule By Service'
                    }
                }
            });
        </script>
    @endsection
