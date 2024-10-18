@extends('layouts.admin.app')

@section('title', 'Admin | Staff')

@section('content')

    {{-- CONTAINER --}}
    <div class="container py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.staffs.index') }}">
                        All Staff
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $staff->full_name }}
                </li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-md-12 d-flex align-self-stretch">
                <div class="card w-100">
                    <div class="card-body d-flex and flex-column">
                        <img class="img-fluid rounded-circle" src="{{ handleNullAvatar($staff->user->avatar_profile) }}"
                            width="130" alt="avatar">
                        <br>
                        <h3 class="font-weight-normal">First Name: {{ $staff->first_name }}</h3>
                        <h3 class="font-weight-normal">Middle Name: {{ $staff->middle_name }}</h3>
                        <h3 class="font-weight-normal">Last Name: {{ $staff->last_name }}</h3>
                        <h3 class="font-weight-normal">Sex: {{ $staff->sex }}</h3>
                        <h3 class="font-weight-normal">Email: {{ $staff->user->email }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- End CONTAINER --}}

@endsection
