@extends('layouts.admin.app')

@section('title', 'Admin | Staff')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4 d-flex justify-content-center align-items-center">
        {{-- Breadcrumb --}}
        <div class="w-100">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.staffs.index') }}" class="text-primary">
                            <i class="fas fa-users"></i> All Staff
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="fas fa-user"></i> {{ $staff->full_name }}
                    </li>
                </ol>
            </nav>

            <div class="row justify-content-center">
                {{-- Staff Information --}}
                <div class="col-lg-4">
                    <div class="card shadow border-0">
                        <div class="card-header text-center bg-primary text-white">
                            <h5 class="mb-0" style="color: white !important;">
                                <i class="fas fa-user-circle"></i> Staff Details
                            </h5>
                        </div>
                        <div class="card-body text-center">
                            <img class="img-fluid rounded-circle mb-3 shadow" 
                                 src="{{ handleNullAvatar($staff->user->avatar_profile) }}" 
                                 width="150" alt="avatar">
                            <h4 class="font-weight-bold" style="font-size: 25px !important; font-weight: 800 !important;">
                                {{ $staff->full_name }}
                            </h4>
                            <span class="badge badge-primary mb-2" 
                                  style="text-transform: none !important; font-size: 13px">
                                {{ $staff->user->email }}
                            </span>

                            <hr>
                            <div class="text-left">
                                <p><strong><i class="fas fa-venus-mars"></i> Sex:</strong> 
                                    <span style="color: #8898aa !important; font-weight: bold !important;">
                                        {{ $staff->sex }}
                                    </span>
                                </p>
                                <p><strong><i class="fas fa-id-badge"></i> First Name:</strong> 
                                    <span style="color: #8898aa !important; font-weight: bold !important;">
                                        {{ $staff->first_name }}
                                    </span>
                                </p>
                                <p><strong><i class="fas fa-id-badge"></i> Middle Name:</strong> 
                                    <span style="color: #8898aa !important; font-weight: bold !important;">
                                        {{ $staff->middle_name }}
                                    </span>
                                </p>
                                <p><strong><i class="fas fa-id-badge"></i> Last Name:</strong> 
                                    <span style="color: #8898aa !important; font-weight: bold !important;">
                                        {{ $staff->last_name }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- End CONTAINER --}}
@endsection
