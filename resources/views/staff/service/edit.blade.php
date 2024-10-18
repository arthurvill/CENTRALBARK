@extends('layouts.staff.app')

@section('title', 'Staff | Edit Service')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('staff.services.index') }}">
                        All Services
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $service->name }}
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Edit
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
                                <form class="row" action="{{ route('staff.services.update', $service) }}" method="post"
                                    id="service_form">
                                    @csrf @method('PUT')
                                    <div class="col-md-10">
                                        <div class="form-group mb-2">
                                            <label class="form-label">Category *</label>
                                            <select class="form-control" name="service_category_id" required>
                                                <option value=""></option>
                                                @foreach ($service_categories as $id => $service_category)
                                                    <option value="{{ $id }}"
                                                        @if ($service->service_category_id == $id) selected @endif>
                                                        {{ $service_category }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label">Service *</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $service->name }}" required>
                                        </div>

                                        <div class="form-group mb-2">
                                            <label class="form-label">Description *</label>
                                            <textarea class="form-control" name="description" rows="5" placeholder="Add description about the service">{{ $service->description }}</textarea>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label">Fee *</label>
                                            <input type="text" class="form-control" name="fee"
                                                value="{{ $service->fee }}">
                                        </div>


                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary"
                                                onclick="promptUpdate(event,'#service_form')">
                                                Save
                                            </button>
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
