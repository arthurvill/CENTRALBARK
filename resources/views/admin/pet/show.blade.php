@extends('layouts.admin.app')

@section('title', 'Admin | Pet Info')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-light rounded shadow-sm px-3 py-2">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.pets.index') }}" class="text-decoration-none">
                        All Pets
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $pet->name }}
                </li>
            </ol>
        </nav>

        @include('layouts.includes.alert')

        <div class="row g-4">
            {{-- Pet Information --}}
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <img class="img-fluid rounded-circle mb-3" src="{{ handleNullAvatarForPet($pet->avatar_profile) }}" width="150" alt="avatar">
                        <h3 class="font-weight-bold text-primary">{{ $pet->name }}</h3>
                        <p class="text-muted">{{ $pet->breed }}</p>
                        <div class="text-left mt-4">
                            <p><strong>Sex:</strong> {{ $pet->sex }}</p>
                            <p><strong>Weight:</strong> {{ $pet->weight }} kg</p>
                            <p><strong>Color:</strong> {{ $pet->color }}</p>
                            <p><strong>Birth Date:</strong> {{ formatDate($pet->birth_date) }}</p>
                            <p><strong>Category:</strong> {{ $pet->category->name }}</p>
                            <p><strong>Owner:</strong> 
                                <a href="{{ route('admin.customers.show', $pet->customer) }}" class="text-decoration-none">{{ $pet->customer->full_name }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Vaccination History --}}
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0" style="color: white; font-weight: bold;">Vaccination History <i class="fas fa-history ml-2"></i></h4>
                        <a href="{{ route('admin.pets.vaccination_histories.create', $pet) }}" class="btn btn-sm btn-light float-right">
                            Add Vaccination History +
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Vaccine</th>
                                        <th>Vaccinated At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($vaccination_histories as $vaccination_history)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $vaccination_history->vaccine }}</td>
                                            <td>{{ formatDate($vaccination_history->vaccinated_at) }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-secondary" href="#" data-toggle="dropdown">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="{{ route('admin.pets.vaccination_histories.edit', [$pet, $vaccination_history]) }}">Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="promptDestroy(event, '#remove_vaccination_history-{{ $vaccination_history->id }}')">Delete</a>
                                                        <form id="remove_vaccination_history-{{ $vaccination_history->id }}" action="{{ route('admin.pets.vaccination_histories.destroy', [$pet, $vaccination_history]) }}" method="POST" class="d-none">
                                                            @csrf @method('DELETE')
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">No Vaccine Taken</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $vaccination_histories->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Recent Appointments --}}
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0" style="color: white; font-weight: bold;">Recent Appointments <i class="fas fa-clipboard-list ml-2"></i></h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Service</th>
                                        <th>Schedule</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($bookings as $booking)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $booking->schedule->service->name }}</td>
                                            <td>
                                                <a href="{{ route('admin.bookings.show', $booking) }}" class="text-decoration-none">
                                                    {{ formatDate($booking->schedule->date_time_start) }} at 
                                                    {{ formatDate($booking->schedule->date_time_start, 'time') }} - 
                                                    {{ formatDate($booking->schedule->date_time_end, 'time') }}
                                                </a>
                                            </td>
                                            <td>{!! handleBookingStatus($booking->status) !!}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">No Recent Appointments</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $bookings->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- End CONTAINER --}}
@endsection
