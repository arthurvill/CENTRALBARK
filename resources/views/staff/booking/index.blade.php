@extends('layouts.staff.app')

@section('title', 'Staff | Manage Bookings')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        @include('layouts.includes.alert')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a class="float-right btn btn-sm btn-primary me-3" href="{{ route('staff.bookings.create') }}">Create
                            Walk-In +
                        </a><br><br>
                        <div class="table-responsive">
                            <table class="table table-hover booking_dt">
                                <caption> List of Bookings <i class="far fa-calendar ml-1"></i></caption>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Owner</th>
                                        <th>Pet</th>
                                        <th>Service</th>
                                        <th>Date Schedule</th>
                                        <th>Reserved At</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Display Bookings --}}
                                </tbody>
                            </table>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End CONTAINER --}}

@endsection
