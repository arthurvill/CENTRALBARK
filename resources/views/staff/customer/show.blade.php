@extends('layouts.staff.app')

@section('title', 'Staff | Customer')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('staff.customers.index') }}">
                        All Customers
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $customer->full_name }}
                </li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-md-4 d-flex align-self-stretch">
                <div class="card w-100">
                    <div class="card-body d-flex and flex-column">
                        <img class="img-fluid rounded-circle" src="{{ handleNullAvatar($customer->user->avatar_profile) }}"
                            width="150" alt="avatar">
                        <br>
                        <h3 class="font-weight-normal">First Name: {{ $customer->first_name }}</h3>
                        <h3 class="font-weight-normal">Middle Name: {{ $customer->middle_name }}</h3>
                        <h3 class="font-weight-normal">Last Name: {{ $customer->last_name }}</h3>
                        <h3 class="font-weight-normal">Sex: {{ $customer->sex }}</h3>
                        <h3 class="font-weight-normal">Birth Date: {{ formatDate($customer->birth_date) }}</h3>
                        <h3 class="font-weight-normal">Address: {{ $customer->address }}</h3>
                        <h3 class="font-weight-normal">Contact: {{ $customer->contact }}</h3>
                        <h3 class="font-weight-normal">Email: {{ $customer->user->email }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-8 d-flex align-self-stretch">
                <div class="card w-100">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0 text-gray font-weight-normal">Owned Pets <i
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
                                        <th>Avatar</th>
                                        <th scope="col">Pet</th>
                                        <th scope="col">Breed</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Sex</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pets as $pet)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td> <img class="img-fluid rounded-circle avatar"
                                                    src="{{ handleNullAvatarForPet($pet->avatar_profile) }}"
                                                    alt="avatar">
                                            </td>
                                            <td>{{ $pet->name }}</td>
                                            <td>{{ $pet->breed }}</td>
                                            <td>{{ $pet->category->name }}</td>
                                            <td>{{ $pet->sex }}</td>
                                            <td>
                                                <div class='dropdown'>
                                                    <a class='btn btn-sm btn-icon-only text-light' href='#'
                                                        data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                        <i class='fas fa-ellipsis-v'></i>
                                                    </a>
                                                    <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>
                                                        <a class='dropdown-item'
                                                            href='{{ route('staff.pets.show', $pet) }}'>View
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2"> Record Not Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="ml-3">
                                {{ $pets->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- End CONTAINER --}}

@endsection
