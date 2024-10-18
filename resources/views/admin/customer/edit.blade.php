@extends('layouts.admin.app')

@section('title', 'Admin | Edit Customer')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="font-weight-normal text-primary">
                            <a class="text-primary float-left" href="{{ route('admin.customers.index') }}">
                                <i class='fas fa-arrow-left'></i>
                            </a>
                            <span class="ml-3"> Edit Customer <i class="fas fa-edit ml-1"></i></span>
                        </h2>
                        <div class="row">
                            <div class="col-md-8">
                                <br>
                                @include('layouts.includes.alert')
                                <form class="row" action="{{ route('admin.customers.update', $customer) }}"
                                    method="post" id="customer_form">
                                    @csrf @method('PUT')
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label class="form-label">First Name *</label>
                                            <input type="text" class="form-control" name="first_name"
                                                value="{{ $customer->first_name }}" required>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label">Middle Name *</label>
                                            <input type="text" class="form-control" name="middle_name"
                                                value="{{ $customer->middle_name }}" required>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label">Last Name *</label>
                                            <input type="text" class="form-control" name="last_name"
                                                value="{{ $customer->last_name }}" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label">Sex *</label>
                                            <select class="form-control" name="sex">
                                                <option value=""></option>
                                                <option value="male" @if ($customer->sex === 'male') selected @endif>
                                                    Male</option>
                                                <option value="female" @if ($customer->sex === 'female') selected @endif>
                                                    Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary"
                                                onclick="promptUpdate(event, '#customer_form')">Save</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label class="form-label">Birth Date *</label>
                                            <input type="date" max="2008-01-01" class="form-control" name="birth_date"
                                                value="{{ formatDate($customer->birth_date, 'dateInput') }}" required>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label">Address *</label>
                                            <input type="text" class="form-control" name="address"
                                                value="{{ $customer->address }}" required>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label">Contact *</label>
                                            <input type="number" class="form-control" min="0" name="contact"
                                                value="{{ $customer->contact }}" required>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label">Email *</label>
                                            <input type="email" class="form-control" name="email"
                                                value="email@email.com" required>
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

@section('script')
    <script>
        $("#appointment_nav").addClass("active");
        $("#customer_nav").addClass("text-primary");
    @endsection
