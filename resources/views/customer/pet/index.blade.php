@extends('layouts.customer.app')

@section('title', "$app_name | My Pet")

@section('content')

    {{-- CONTAINER --}}
    <div class="container py-4">
        <h1 class="font-weight-normal text-primary">
            My Pet <i class="fas fa-paw ml-1"></i>
            <a class="float-right btn btn-sm btn-primary me-3" href="{{ route('customer.pets.create') }}">Create
                Pet +
            </a>
        </h1>
        <br>

        @include('layouts.includes.alert')
        <div class="row ">
            @forelse ($pets as $pet)
                <div class="col-6 col-md-4 d-flex services align-self-stretch">
                    <div class="card w-100 card-shadow-none hoverable rounded">
                        <div class="card-body d-flex and flex-column text-center text-small p-0">
                            <img class="img-fluid d-block mx-auto rounded-circle"
                                src="{{ handleNullAvatarForPet($pet->avatar_profile) }}" width="100" alt="pet">

                            <h3 class="text-primary font-weight-bold">
                                <a href="{{ route('customer.pets.show', $pet) }}">Pet: {{ $pet->name }}
                                </a>
                            </h3>
                            <h4 class="font-weight-normal text-muted">
                                Category: {{ $pet->category->name }}
                            </h4>
                            <h4 class="font-weight-normal text-muted">
                                Breed: {{ $pet->breed }}
                            </h4>
                            <h4 class="font-weight-normal text-muted">
                                Sex: {{ $pet->sex }}
                            </h4>
                        </div>
                        <div class="card-footer border-0 pt-1 pb-2 text-right">
                            <div class="btn-group">
                                <a class="btn btn-sm btn-success" href="{{ route('customer.pets.edit', $pet) }}">
                                    <i class="fas fa-edit ml-1"></i>
                                </a>
                                <a class="btn btn-sm btn-danger" href='javascript:void(0)'
                                    onclick="promptDestroy(event, '#remove_pet-{{ $pet->id }}')">
                                    <i class="fas fa-trash ml-1"></i>
                                </a>


                                <form action="{{ route('customer.pets.destroy', $pet) }}" method="POST"
                                    id="remove_pet-{{ $pet->id }}">
                                    @csrf @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            @empty

                <figure class="d-block mx-auto">
                    <img class="img-fluid" src="{{ asset('img/nodata.svg') }}" width="75%" alt="no data">
                    <p class="font-weight-normal text-center">Record Not Found</p>
                </figure>
            @endforelse


        </div>


        <div>
            {{ $pets->isNotEmpty() ? $pets->links() : '' }}
        </div>

        {{-- End CONTAINER --}}

    @endsection
