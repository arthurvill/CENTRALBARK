@extends('layouts.admin.app')

@section('title', 'Admin | Create Service')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.services.index') }}">
                        All Services
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Create Service
                </li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <br>
                                @include('layouts.includes.alert')
                                <form class="row" action="{{ route('admin.services.store') }}" method="post"
                                    id="service_form">
                                    @csrf
                                    <div class="col-md-10">
                                        <div class="form-group mb-2">
                                            <label class="form-label">Category *</label>
                                            <select class="form-control" name="service_category_id" required>
                                                <option value=""></option>
                                                @foreach ($service_categories as $id => $service_category)
                                                    <option value="{{ $id }}">{{ $service_category }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label">Service *</label>
                                            <input type="text" class="form-control" name="name" required>
                                        </div>

                                        <div class="form-group mb-2">
                                            <label class="form-label">Description *</label>
                                            <textarea class="form-control" name="description" rows="5" placeholder="Add description about the service"></textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Fee *</label>
                                            <input type="text" class="form-control" name="fee"
                                                placeholder="Eg. ₱500">
                                        </div>

                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary"
                                                onclick="promptStore(event, '#service_form')">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <img class="img-fluid" src="{{ asset('img/crud/default.svg') }}" alt="manage">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- End CONTAINER --}}

@endsection
