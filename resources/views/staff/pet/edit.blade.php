@extends('layouts.staff.app')

@section('title', 'Staff | Edit Pet')

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
                <li class="breadcrumb-item active" aria-current="page">
                    Edit
                </li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <br>
                                @include('layouts.includes.alert')
                                <form class="row" action="{{ route('staff.pets.update', $pet) }}" method="post"
                                    id="pet_form">
                                    @csrf @method('PUT')
                                    <div class="col-md-10">

                                        <div class="form-group mb-2">
                                            <label class="form-label">Category *</label>
                                            <select class="form-control" name="category_id" required>
                                                <option value=""></option>
                                                @foreach ($categories as $id => $category)
                                                    <option value="{{ $id }}"
                                                        @if ($pet->category_id == $id) selected @endif>
                                                        {{ $category }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group mb-2">
                                            <label class="form-label">Owner *</label>
                                            <select class="form-control" name="customer_id" required>
                                                <option value=""></option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}"
                                                        @if ($pet->customer_id == $customer->id) selected @endif>
                                                        {{ $customer->full_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group mb-2">
                                            <label class="form-label">Pet Name *</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $pet->name }}" required>
                                        </div>

                                        <div class="form-group mb-2">
                                            <label class="form-label">Breed *</label>
                                            <input type="text" class="form-control" name="breed"
                                                value="{{ $pet->breed }}" required>
                                        </div>

                                        <div class="form-outline mb-2">
                                            <label class="form-label">Sex</label>
                                            <select class="form-control" name="sex">
                                                <option value=""></option>
                                                <option value="male" @if ($pet->sex == 'male') selected @endif>
                                                    Male
                                                </option>
                                                <option value="female" @if ($pet->sex == 'female') selected @endif>
                                                    Female
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group mb-2">
                                            <label class="form-label">Birth Date *</label>
                                            <input type="date" class="form-control" name="birth_date"
                                                value="{{ formatDate($pet->birth_date, 'dateInput') }}" required>
                                        </div>


                                        <div class="form-group mb-2">
                                            <label class="form-label">Color *</label>
                                            <input type="text" class="form-control" name="color"
                                                value="{{ $pet->color }}" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label">Weight (kgs) *</label>
                                            <input type="number" min="0" class="form-control" name="weight"
                                                value="{{ $pet->weight }}" required>
                                        </div>

                                        <div>
                                            <input type="file" class="pet_image" name="image">
                                        </div>

                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary"
                                                onclick="promptUpdate(event, '#pet_form')">Save</button>
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
        initiateFilePond('.pet_image', ["image/png", "image/jpeg", "image/jpg", "image/webp"],
            'Drag & Drop or <span class="filepond--label-action"> Browse Avatar (Optional)</span>')
    </script>
@endsection
