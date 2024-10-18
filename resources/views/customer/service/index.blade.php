@extends('layouts.customer.app')

@section('title', "$app_name | Services")


@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page">
                    {{ $app_name }}
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    Services
                </li>
            </ol>
        </nav>

        @foreach ($service_categories as $service_category)
            <h3 class="font-weight-normal text-muted mb-5"><i class="fas fa-paperclip"></i>
                {{ ucfirst($service_category->name) }}
            </h3>
            <div class="row">
                {{-- LOOP THROUGH EACH Service Category > Services --}}
                @foreach ($service_category->services as $service)
                    <div class="col-md-4 col-lg-3 d-flex services align-self-stretch">
                        <div class="card w-100 card-shadow-none hoverable rounded">
                            <div class="card-body d-flex and flex-column text-center text-small p-0">
                                <img class="img-fluid d-block mx-auto " src="{{ asset('img/service/paw.png') }}"
                                    width="100" alt="service">

                            </div>
                            <div class="card-footer border-0 pt-1 pb-2 text-center">
                                <h3 class="text-primary font-weight-bold">
                                    <a href="{{ route('customer.services.schedules.index', $service) }}">{{ $service->name }}
                                        <i class="fas fa-clipboard ml-1"></i></a>
                                </h3>
                                <h4 class="font-weight-normal text-muted" data-toggle="tooltip" data-placement="right"
                                    title="{{ $service->description }}">
                                    {{ textTruncate($service->description) }}
                                </h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if (!$loop->last)
                <hr>
            @endif
        @endforeach {{-- END BRAND LOOP --}}

    </div>
    {{-- End CONTAINER --}}

@endsection
@section('script')
    <script>
        $('#clinic_nav').addClass('active')
    </script>
@endsection
