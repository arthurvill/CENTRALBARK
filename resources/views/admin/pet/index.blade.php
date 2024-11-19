@extends('layouts.admin.app')

@section('title', 'Admin | Manage Pet')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        @include('layouts.includes.alert')

        <!-- <form>
            <div class="form-group">
                <select class="form-control form-control-sm">
                    <option>--- All Category --- </option>
                    @foreach ($categories as $id => $category)
                        <option value="{{ $id }}">{{ $category }}</option>
                    @endforeach
                </select>
            </div>
        </form> -->

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a class="float-right btn btn-sm btn-primary me-3" href="{{ route('admin.pets.create') }}">Create
                            Pet +</a><br><br>
                        <div class="table-responsive">
                            <table class="table table-flush table-hover pet_dt">
                                <caption>List of Registered Pet</caption>
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Avatar</th>
                                        <th>Pet Name</th>
                                        <th>Breed</th>
                                        <th>Category</th>
                                        <th>Owner</th>
                                        <th>Registered At</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Display patients --}}
                                </tbody>
                            </table>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End CONTAINER --}}

@endsection
