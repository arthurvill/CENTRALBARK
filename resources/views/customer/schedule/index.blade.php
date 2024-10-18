@extends('layouts.customer.app')

@section('title', "$app_name | Schedules")

@section('styles')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/main.min.css' rel='stylesheet' />
@endsection

@section('content')
    {{-- CONTAINER --}}
    <div class="container-fluid py-4">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('customer.services.index') }}">
                        All Services
                    </a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    {{ $service->name }}
                </li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-4">
                <div class="card card-body">
                    <h3> Service: {{ $service->name }}</h3>
                    <h3> Description: {{ $service->description }}</h3>
                    <h3> Fee (₱): {{ $service->fee }}</h3>
                    <img class="img-fluid" src="{{ asset('img/auth/vet.svg') }}" alt="vet">

                </div>
            </div>
            <div class="col-md-12 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row text-center">
                            <div class="col-md-4 bg-success p-2">
                                <span class="text-white">Available <i class="fas fa-check-circle ml-1"> </i></span>
                            </div>
                            <div class="col-md-4 bg-danger p-2">
                                <span class="text-white">Reserved <i class="fas fa-check-circle ml-1"> </i></span>
                            </div>
                            <div class="col-md-4 bg-gray p-2">
                                <span class="text-white">Unavailable <i class="fas fa-times-circle ml-1"> </i></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End CONTAINER --}}

@endsection

@section('script')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/main.min.js'></script>
    <script>
        const events = @json($schedules)

        document.addEventListener('DOMContentLoaded', function() {
            const myCalendar = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(myCalendar, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                height: 900,
                //initialView: 'dayGridMonth',
                initialView: 'timeGridWeek',
                // eventColor: '#1c9285',
                //eventBackgroundColor:'#1c9285',
                eventMaxStack: 1,
                expandRows: true,
                eventMouseEnter: function(info) {
                    $(info.el).tooltip({
                        title: info.event.type
                    });
                },
                businessHours: {
                    // days of week. an array of zero-based day of week integers (0=Sunday)
                    daysOfWeek: [1, 2, 3, 4, 5], // Monday - Friday

                    startTime: '08:00', // a start time (10am in this example)
                    endTime: '18:00', // an end time (6pm in this example)
                },
                events
                // eventSources: [
                //    {
                //     events,
                //     defaultAllDay : true,
                //     display: 'list-item',
                //     backgroundColor: '#5db75a'
                //    }
                // ]
            });
            calendar.render();
        });

        $('#clinic_nav').addClass('active')
    </script>
@endsection
