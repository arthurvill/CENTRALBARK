@extends('layouts.admin.app')

@section('title', 'Admin | Add Prescription')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="font-weight-normal text-primary">
                            <a class="text-primary float-left" href="{{ route('admin.bookings.show', $booking) }}">
                                <i class='fas fa-arrow-left'></i>
                            </a>
                            <span class="ml-3"> Add Prescription <i class="fas fa-plus-circle ml-1"></i></span>
                        </h2>
                        <div class="row">
                            <div class="col-md-8">
                                <br>
                                @include('layouts.includes.alert')
                                <form action="{{ route('admin.bookings.prescriptions.store', $booking) }}" method="post"
                                    enctype="multipart/form-data" id="prescription_form">
                                    @csrf

                                    <div class="form-group mb-2">
                                        <label class="form-label">Drug</label>
                                        <input class="form-control" type="text" name="drug">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="form-label">Description</label>
                                        <input class="form-control" type="text" name="description">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="form-label">Prep</label>
                                        <input class="form-control" type="text" name="preparation">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="form-label">Qty</label>
                                        <input class="form-control" type="number" min="1" name="qty">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="form-label">Direction</label>
                                        <textarea class="form-control" name="direction" rows="5"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary"
                                            onclick="promptStore(event, '#prescription_form')">Submit</button>
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
    <script src="https://cdn.tiny.cloud/1/yiv2clsvcw9c4q7y2h8t92t4cuaia1l3383axmfdgovo3kft/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        $('#appointment_nav').addClass('active')
        $('#booking_nav').addClass('text-primary')

        //initiateEditor('textarea', 'Explain us about the prescriptions')
    </script>
@endsection
