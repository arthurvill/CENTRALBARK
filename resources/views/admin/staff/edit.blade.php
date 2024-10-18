@extends('layouts.admin.app')

@section('title', 'Admin | Create Staff')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="font-weight-normal text-primary">
                            <a class="text-primary float-left" href="{{ route('admin.staffs.index') }}">
                                <i class='fas fa-arrow-left'></i>
                            </a>
                            <span class="ml-3"> Create Staff <i class="fas fa-user ml-1"></i></span>
                        </h2>
                        <div class="row">
                            <div class="col-md-8">
                                <br>
                                @include('layouts.includes.alert')
                                <form action="{{ route('admin.staffs.update', $staff) }}" method="post" id="staff_form">
                                    @csrf @method('PUT')

                                    <div class="form-group mb-2">
                                        <label class="form-label">First Name *</label>
                                        <input type="text" class="form-control" name="first_name"
                                            value="{{ $staff->first_name }}" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="form-label">Middle Name *</label>
                                        <input type="text" class="form-control" name="middle_name"
                                            value="{{ $staff->middle_name }}" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="form-label">Last Name *</label>
                                        <input type="text" class="form-control" name="last_name"
                                            value="{{ $staff->last_name }}" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="form-label">Sex *</label>
                                        <select class="form-control" name="sex">
                                            <option value=""></option>
                                            <option value="male" @if ($staff->sex === 'male') selected @endif>
                                                Male</option>
                                            <option value="female" @if ($staff->sex === 'female') selected @endif>
                                                Female</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label">Email *</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ $staff->user->email }}" required>
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary"
                                            onclick="promptUpdate(event, '#staff_form')">Save</button>
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
        $("#customer_nav").addClass("active");
    </script>
@endsection
