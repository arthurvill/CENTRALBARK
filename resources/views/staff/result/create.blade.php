@extends('layouts.staff.app')

@section('title', 'Staff | Add Result')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="font-weight-normal text-primary">
                            <a class="text-primary float-left" href="{{ route('staff.bookings.show', $booking) }}">
                                <i class='fas fa-arrow-left'></i>
                            </a>
                            <span class="ml-3"> Add Result <i class="fas fa-plus-circle ml-1"></i></span>
                        </h2>
                        <div class="row">
                            <div class="col-md-8">
                                <br>
                                @include('layouts.includes.alert')
                                <form action="{{ route('staff.bookings.results.store', $booking) }}" method="post"
                                    enctype="multipart/form-data" id="result_form">
                                    @csrf

                                    <div class="form-group mb-2">
                                        <label class="form-label">Subject *</label>
                                        <input type="text" class="form-control" name="subject"
                                            placeholder="Eg. X-RAY / CBC / ECG" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="form-label">Add Remark (Optional) </label>
                                        <textarea class="form-control" name="remark" rows="5" placeholder=""></textarea>
                                    </div>

                                    <div>
                                        <input class="result_images" type="file" name="image[]" multiple
                                            data-allow-reorder="true" data-max-file-size="3MB" data-max-files="3">
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary"
                                            onclick="promptStore(event, '#result_form')">Submit</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <img class="img-fluid" src="{{ asset('img/result/default.svg') }}" alt="manage">
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
        initiateFilePond('.result_images')

        $('#appointment_nav').addClass('active')
        $('#booking_nav').addClass('text-primary')
    </script>
@endsection
