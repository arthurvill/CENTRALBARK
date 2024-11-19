@extends('layouts.staff.app')

@section('styles')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/main.min.css' rel='stylesheet' />
@endsection

@section('content')
    <!-- Header -->
    <div class="header pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Start Appointments Counts -->
                <div class="row mt-3">
                <div class="col-xl-3 col-md-6 d-flex align-self-stretch" style="flex: 0 0 50%; max-width: 50%;">
                        <div class="card card-stats w-100">
                            <!-- Card body -->
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col" style=text-align:center;!important>
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Appointment</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $total_booking }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                            <i class="fas fa-clipboard-list"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 d-flex align-self-stretch" style="flex: 0 0 50%; max-width: 50%;">
                        <div class="card card-stats w-100">
                            <!-- Card body -->
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col"style=text-align:center;!important>
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Pending Appointment</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $total_pending_booking }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                            <i class="fas fa-clipboard"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-xl-3 col-md-6 d-flex align-self-stretch">
                        <div class="card card-stats w-100"> -->
                            <!-- Card body -->
                            <!-- <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Approved Appointment
                                        </h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $total_approved_booking }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                            <i class="fas fa-clipboard-check"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 d-flex align-self-stretch">
                        <div class="card card-stats w-100"> -->
                            <!-- Card body -->
                            <!-- <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Canceled Appointment
                                        </h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $total_canceled_booking }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                            <i class="fas fa-clipboard"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div> -->
                </div>
                <!--End Appointment Count-->

            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-md-6 d-flex align-self-stretch">
                <div class="card w-100">
                    <div class="card-body d-flex and flex-column">
                        <!-- Chart Monthly User-->
                        <canvas id="chart_monthly_customers"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex align-self-stretch">
                <div class="card w-100">
                    <div class="card-body d-flex and flex-column">
                        <!-- Chart Monthly Booking-->
                        <canvas id="chart_monthly_bookings"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 d-flex align-self-stretch">
                <div class="card w-100 border-0">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0 text-gray font-weight-normal">Registered Customer <i
                                        class="fas fa-user-shield ml-1"></i>
                                </h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('staff.customers.index') }}" class="btn btn-sm btn-success">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Avatar</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Registered At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($customers as $customer)
                                        <tr>
                                            <td><img class="avatar avatar-sm rounded-circle"
                                                    src="{{ handleNullAvatar($customer->avatar_thumbnail) }}"
                                                    alt="avatar">
                                            </td>
                                            <td>{{ $customer->customer->full_name }}</td>
                                            <td>{{ formatDate($customer->created_at, 'dateTime') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2">Customer Record Not Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 d-flex align-self-stretch">
                <div class="card w-100">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0 text-gray font-weight-normal">Recent Appointments <i
                                        class="fas fa-clipboard-list ml-1"></i>
                                </h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('staff.bookings.index') }}" class="btn btn-sm btn-success">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex and flex-column">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Patient</th>
                                        <th scope="col">Owner</th>
                                        <th scope="col">Services</th>
                                        <th scope="col">Schedule</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recent_bookings as $booking)
                                        <tr>
                                            <td>
                                                <img class="img-fluid rounded-circle mr-1"
                                                    src="{{ handleNullAvatar($booking->pet->avatar_profile) }}"
                                                    width="25" alt="avatar">
                                                {{ $booking->pet->name }}
                                            </td>
                                            <td>
                                                {{ $booking->pet->customer->full_name }}
                                            </td>
                                            <td>{{ $booking->schedule->service->name }}
                                            </td>
                                            <td>{{ formatDate($booking->schedule->date_time_start) }} at
                                                {{ formatDate($booking->schedule->date_time_start, 'time') }} -
                                                {{ formatDate($booking->schedule->date_time_end, 'time') }}
                                            </td>
                                            <td>{!! isOnline($booking->is_online) !!}</td>
                                            <td>{!! handleBookingStatus($booking->status) !!}</td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td colspan="2">Post Record Not Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="ml-3">
                                {{-- pagination --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xl-8 d-flex align-self-stretch">
                <div class="card w-100">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0 text-gray font-weight-normal">Calendar <i
                                        class="fas fa-calendar ml-1"></i>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex and flex-column">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 d-flex align-self-stretch">
                <div class="card w-100">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0 text-primary font-weight-normal">Activity Logs <i
                                        class="fas fa-history ml-1"></i></h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('staff.activity_logs.index') }}"
                                    class="btn btn-sm btn-outline-primary">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex and flex-column">
                        @foreach ($activities as $al)
                            @php
                                $exploaded = explode('-', $al->description);
                            @endphp
                            <div class='border-left border-primary'>
                                <p class="m-0 pl-2">{{ $exploaded[0] }} - <span class='txt-lightblue'>
                                        {{ $exploaded[1] }} </span> </p>
                                <p class='pl-2'> {{ $al->created_at->diffForHumans() }} </p>
                            </div>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.includes.footer')
    </div>
    <!-- End Page Content -->
@endsection
@section('script')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/main.min.js'></script>
    <script>
        $("#dashboard_nav").addClass("active bg-secondary");

        const bgc = ['#3498db', '#00cc99', '#95a5a6', '#2c3e50', '#f1c40f', '#95a5a6', '#ecf0f1'];
        const months = @json($chart_monthly_customers[0]);
        const total_users = @json($chart_monthly_customers[1]);

        const chart_monthly_customers = document.getElementById('chart_monthly_customers');
        const a = new Chart(chart_monthly_customers, {
            type: 'bar', // bar , horizontal, line ,doughnut ,radar , polarArea
            data: {
                labels: months,
                datasets: [{
                    label: 'Monthly Customer',
                    data: total_users,
                    backgroundColor: bgc
                }],

            },
            options: {
                title: {
                    display: true,
                    text: 'Total Monthly Customer'
                }
            }
        });

        const monthly_bookings_months = @json($chart_monthly_bookings[0]);
        const total_bookings = @json($chart_monthly_bookings[1]);
        const chart_monthly_bookings = document.getElementById('chart_monthly_bookings');
        const b = new Chart(chart_monthly_bookings, {
            type: 'bar', // bar , horizontal, line ,doughnut ,radar , polarArea
            data: {
                labels: monthly_bookings_months,
                datasets: [{
                    label: 'Monthly Bookings',
                    data: total_bookings,
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

        document.addEventListener('DOMContentLoaded', function() {
            var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                initialView: 'dayGridMonth'
            });
            calendar.render();
        });
    </script>
@endsection
