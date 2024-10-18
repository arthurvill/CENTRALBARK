@extends('layouts.staff.app')

@section('title', 'Staff | Edit Vaccination History')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="font-weight-normal text-primary">
                            <a class="text-primary float-left" href="{{ route('staff.pets.show', $pet) }}">
                                <i class='fas fa-arrow-left'></i>
                            </a>
                            <span class="ml-3"> Edit Vaccination History <i class="fas fa-edit ml-1"></i></span>
                        </h2>
                        <div class="row">
                            <div class="col-md-8">
                                <br>
                                @include('layouts.includes.alert')
                                <form
                                    action="{{ route('staff.pets.vaccination_histories.update', [$pet, $vaccination_history]) }}"
                                    method="post" enctype="multipart/form-data" id="vaccination_history_form">
                                    @csrf @method('PUT')

                                    <div class="form-group mb-2">
                                        <label class="form-label">Vaccine *</label>
                                        <input type="text" class="form-control" name="vaccine"
                                            value="{{ $vaccination_history->vaccine }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label">Vaccinated At *</label>
                                        <input type="date" class="form-control" name="vaccinated_at"
                                            value="{{ $vaccination_history->vaccinated_at }}" required>
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary"
                                            onclick="promptUpdate(event, '#vaccination_history_form')">Save</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <img class="img-fluid" src="{{ asset('img/vaccine/default.svg') }}" alt="manage">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- End CONTAINER --}}

@endsection
