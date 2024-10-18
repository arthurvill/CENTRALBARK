@extends('layouts.admin.app')

@section('title', 'Admin | Manage Clinic Schedules')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div>
                    <div class="input-group input-group-outline ">
                        <select class="form-control " onchange="filterScheduleByService(this)">
                            <option value="0">--- All Services---
                            </option>
                            @foreach ($services as $id => $service)
                                <option value="{{ $id }}">{{ $service }}</option>
                            @endforeach
                        </select>
                    </div>
                </div><br>
                <div class="card">
                    <div class="card-body">
                        <a class="float-right btn btn-sm btn-primary me-3"
                            href="{{ route('admin.schedules.create') }}">Create
                            Schedule +</a><br><br>
                        <div class="table-responsive">
                            <table class="table table-flush table-hover schedule_dt">
                                <caption>Clinic Schedules <i class="far fa-calendar-alt ml-1"></i></caption>
                                <thead class="thead-light">
                                    <tr>
                                        <th>Service</th>
                                        <th>Date Time Start</th>
                                        <th>Date Time End</th>
                                        <th>Day Type</th>
                                        <th>Created At</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Display Schedules --}}
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
