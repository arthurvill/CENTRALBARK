@extends('layouts.admin.app')

@section('title', 'Admin | Add Vaccination History')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="font-weight-normal text-primary">
                            <a class="text-primary float-left" href="{{ route('admin.pets.show', $pet) }}">
                                <i class='fas fa-arrow-left'></i>
                            </a>
                            <span class="ml-3"> Add Vaccination History <i class="fas fa-plus-circle ml-1"></i></span>
                        </h2>
                        <div class="row">
                            <div class="col-md-8">
                                <br>
                                @include('layouts.includes.alert')
                                <form action="{{ route('admin.pets.vaccination_histories.store', $pet) }}" method="post"
                                    enctype="multipart/form-data" id="vaccination_history_form">
                                    @csrf

                                    <div class="form-group mb-2">
                                        <label class="form-label">Vaccine *</label>
                                        <input type="text" class="form-control" name="vaccine" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label">Vaccinated At *</label>
                                        <input type="date" class="form-control" name="vaccinated_at" required>
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary"
                                            onclick="promptStore(event, '#vaccination_history_form')">Submit</button>
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
