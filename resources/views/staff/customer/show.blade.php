@extends('layouts.staff.app')

@section('title', 'Staff | Customer')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('staff.customers.index') }}" class="text-primary">
                        <i class="fas fa-users"></i> All Customers
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-user"></i> {{ $customer->full_name }}
                </li>
            </ol>
        </nav>

        <div class="row">
            {{-- Customer Information --}}
            <div class="col-lg-4">
                <div class="card shadow border-0">
                    <div class="card-header text-center bg-primary text-white">
                    <h5 class="mb-0" style="color: white !important;">
    <i class="fas fa-user-circle"></i> Customer Details
</h5>

                    </div>
                    <div class="card-body text-center">
                        <img class="img-fluid rounded-circle mb-3 shadow" 
                             src="{{ handleNullAvatar($customer->user->avatar_profile) }}" 
                             width="150" alt="avatar">
                             <h4 class="font-weight-bold" style="font-size: 25px !important; font-weight: 800 !important;">{{ $customer->full_name }}</h4>


                        <span class="badge badge-primary mb-2" style="text-transform: none !important; font-size: 13px">{{ $customer->user->email }}</span>

                        <p class="text-muted">
                            <i class="fas fa-phone-alt"></i> {{ $customer->contact }}
                        </p>
                        <hr>
                        <div class="text-left">
    <p><strong><i class="fas fa-venus-mars"></i> Sex:</strong> <span style="color: #8898aa !important; font-weight: bold !important;">{{ $customer->sex }}</span></p>
    <p><strong><i class="fas fa-calendar-alt"></i> Birth Date:</strong> <span style="color: #8898aa !important; font-weight: bold !important;">{{ formatDate($customer->birth_date) }}</span></p>
    <p><strong><i class="fas fa-map-marker-alt"></i> Address:</strong> <span style="color: #8898aa !important; font-weight: bold !important;">{{ $customer->address }}</span></p>
</div>

                    </div>
                </div>
            </div>

            {{-- Owned Pets --}}
            <div class="col-lg-8">
                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0" style="color: white !important;">
                            <i class="fas fa-paw"></i> Owned Pets
                        </h5>
                        <a href="{{ route('staff.pets.create') }}" class="btn btn-sm btn-light">
                            <i class="fas fa-plus"></i> Add Pet
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-items-center">
                                <thead class="bg-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Avatar</th>
                                        <th>Pet Name</th>
                                        <th>Breed</th>
                                        <th>Category</th>
                                        <th>Sex</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pets as $pet)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                <img class="img-fluid rounded-circle shadow-sm" 
                                                     src="{{ handleNullAvatarForPet($pet->avatar_profile) }}" 
                                                     width="40" alt="pet-avatar">
                                            </td>
                                            <td>{{ $pet->name }}</td>
                                            <td>{{ $pet->breed }}</td>
                                            <td>
                                                <span class="badge badge-info">{{ $pet->category->name }}</span>
                                            </td>
                                            <td>{{ $pet->sex }}</td>
                                            <td>
                                                <a href="{{ route('staff.pets.show', $pet) }}" 
                                                   class="btn btn-sm btn-primary">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">
                                                <i class="fas fa-paw"></i> No pets found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $pets->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
