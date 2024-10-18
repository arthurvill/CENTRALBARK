@extends('layouts.staff.app')

@section('title', 'Staff | Prescription')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('staff.bookings.show', $booking) }}">All
                        Prescriptions</a>
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

                        <h2 class="font-weight-normal">Prescriptions * </h2>

                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Drug</th>
                                    <th>Description</th>
                                    <th>Preparation</th>
                                    <th>Qty</th>
                                    <th>Directions</th>

                                </tr>
                            </thead>
                            <tbody>
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
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End CONTAINER --}}

@endsection

@section('script')
    <script>
        $('#appointment_nav').addClass('active')
        $('#booking_nav').addClass('text-primary')
    </script>
@endsection
