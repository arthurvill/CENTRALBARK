@extends('layouts.staff.app')

@section('title', 'Staff | Pet Info')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('staff.pets.index') }}">
                        All Pets
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $pet->name }}
                </li>
            </ol>
        </nav>

        @include('layouts.includes.alert')
        <div class="row justify-content-center">
            <div class="col-md-4 d-flex align-self-stretch">
                <div class="card w-100">
                    <div class="card-body d-flex and flex-column">
                        <img class="img-fluid rounded-circle" src="{{ handleNullAvatarForPet($pet->avatar_profile) }}"
                            width="150" alt="avatar">
                        <br>
                        <h3 class="font-weight-normal">Name: {{ $pet->name }}</h3>
                        <h3 class="font-weight-normal">Breed: {{ $pet->breed }}</h3>
                        <h3 class="font-weight-normal">Sex: {{ $pet->sex }}</h3>
                        <h3 class="font-weight-normal">Weight(kgs): {{ $pet->weight }}</h3>
                        <h3 class="font-weight-normal">Color: {{ $pet->color }}</h3>
                        <h3 class="font-weight-normal">Birth Date: {{ formatDate($pet->birth_date) }}</h3>
                        <h3 class="font-weight-normal">Category: {{ $pet->category->name }}</h3>
                        <h3 class="font-weight-normal">Owner:
                            <a href="{{ route('staff.customers.show', $pet->customer) }}">{{ $pet->customer->full_name }}
                            </a>
                        </h3>

                    </div>
                </div>
            </div>
            <div class="col-md-8 d-flex align-self-stretch">
                <div class="card w-100">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0 text-gray font-weight-normal">Vaccination History <i
                                        class="fas fa-history ml-1"></i>

                                    <a class="float-right btn btn-sm btn-primary me-3"
                                        href="{{ route('staff.pets.vaccination_histories.create', $pet) }}">Add
                                        Vaccination History +</a><br><br>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex and flex-column">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Vaccine</th>
                                        <th scope="col">Vaccinated At</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($vaccination_histories as $vaccination_history)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $vaccination_history->vaccine }}</td>
                                            <td>{{ formatDate($vaccination_history->vaccinated_at) }}</td>
                                            <td>
                                                <div class='dropdown'>
                                                    <a class='btn btn-sm btn-icon-only text-light' href='#'
                                                        data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                        <i class='fas fa-ellipsis-v'></i>
                                                    </a>
                                                    <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>
                                                        <a class='dropdown-item'
                                                            href='{{ route('staff.pets.vaccination_histories.edit', [$pet, $vaccination_history]) }}'>Edit
                                                        </a>
                                                        <a class='dropdown-item' href='javascript:void(0)'
                                                            onclick="promptDestroy(event, '#remove_vaccination_history-{{ $vaccination_history->id }}')">Delete
                                                        </a>

                                                        <form
                                                            action="{{ route('staff.pets.vaccination_histories.destroy', [$pet, $vaccination_history]) }}"
                                                            method="POST"
                                                            id="remove_vaccination_history-{{ $vaccination_history->id }}">
                                                            @csrf @method('DELETE')
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2"> No Vaccine Taken</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="ml-3">
                                {{ $vaccination_histories->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex align-self-stretch">
                <div class="card w-100">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0 text-gray font-weight-normal">Recent Appointments <i
                                        class="fas fa-clipboard-list ml-1"></i>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex and flex-column">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Services</th>
                                        <th scope="col">Schedule</th>
                                        {{-- <th scope="col">Type</th> --}}
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($bookings as $booking)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $booking->schedule->service->name }}
                                            </td>

                                            <td><a href="{{ route('staff.bookings.show', $booking) }}">
                                                    {{ formatDate($booking->schedule->date_time_start) }} at
                                                    {{ formatDate($booking->schedule->date_time_start, 'time') }} -
                                                    {{ formatDate($booking->schedule->date_time_end, 'time') }}
                                                </a>
                                            </td>
                                            {{-- <td>{!! isOnline($booking->is_online) !!}</td> --}}
                                            <td>{!! handleBookingStatus($booking->status) !!}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2"> Record Not Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="ml-3">
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
