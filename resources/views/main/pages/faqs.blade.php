@extends('layouts.main.app')

@section('title', "$app_name | FAQS")

@section('content')
    <div class="container my-auto"><br><br><br><br>
        <div class="card card-body">
            <div class="row justify-content-center">
                <div class="col-md-6 order-0 order-lg-1">
                    <img class="img-fluid d-block mx-auto" src="{{ asset('img/main/faqs.svg') }}" alt="faqs">
                </div>
                <div class="col-md-6 order-1 order-lg-0">
                    <!-- FAQ 1 -->
                    <button class="btn btn-link p-0 text-left w-100" type="button" data-toggle="collapse" data-target="#faq1" aria-expanded="false" aria-controls="faq1">
                        <h3 class="font-weight-normal">Where is your clinic located?</h3>
                    </button>
                    <div id="faq1" class="collapse">
                        <p class="text-muted">We’re located at Tungkop, Minglanilla, Cebu, Philippines.</p>
                    </div>
                    <br>

                    <!-- FAQ 2 -->
                    <button class="btn btn-link p-0 text-left w-100" type="button" data-toggle="collapse" data-target="#faq2" aria-expanded="false" aria-controls="faq2">
                        <h3 class="font-weight-normal">Do you accept walk-in patients?</h3>
                    </button>
                    <div id="faq2" class="collapse">
                        <p class="text-muted">Yes! We surely cater walk-in patients, especially those who need urgent medical attention. Just visit our clinic.</p>
                    </div>
                    <br>

                    <!-- FAQ 3 -->
                    <button class="btn btn-link p-0 text-left w-100" type="button" data-toggle="collapse" data-target="#faq3" aria-expanded="false" aria-controls="faq3">
                        <h3 class="font-weight-normal">Do you have grooming services?</h3>
                    </button>
                    <div id="faq3" class="collapse">
                        <p class="text-muted">Yes! We offer grooming services, with prices varying depending on your pet's size and weight.</p>
                    </div>
                    <br>

                    <!-- FAQ 4 -->
                    <button class="btn btn-link p-0 text-left w-100" type="button" data-toggle="collapse" data-target="#faq4" aria-expanded="false" aria-controls="faq4">
                        <h3 class="font-weight-normal">Do you have an anti-distemper and anti-parvo vaccine?</h3>
                    </button>
                    <div id="faq4" class="collapse">
                        <p class="text-muted">Yes! We offer anti-distemper and anti-parvo vaccines. Visit our clinic for more details.</p>
                    </div>
                    <br>

                    <!-- FAQ 5 -->
                    <button class="btn btn-link p-0 text-left w-100" type="button" data-toggle="collapse" data-target="#faq5" aria-expanded="false" aria-controls="faq5">
                        <h3 class="font-weight-normal">Is your clinic 24 hours open?</h3>
                    </button>
                    <div id="faq5" class="collapse">
                        <p class="text-muted">No, our clinic operates from 10:00 AM to 5:00 PM, Monday to Saturday.</p>
                    </div>
                    <br>

                    <!-- FAQ 6 -->
                    <button class="btn btn-link p-0 text-left w-100" type="button" data-toggle="collapse" data-target="#faq6" aria-expanded="false" aria-controls="faq6">
                        <h3 class="font-weight-normal">Where can I send my payment?</h3>
                    </button>
                    <div id="faq6" class="collapse">
                        <p class="text-muted">We accept GCash and Cash payments only.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .faq-item {
            transition: all 0.3s ease;
        }
        .faq-item:hover {
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        /* Make button text responsive */
        @media (max-width: 768px) {
            .faq-item h3 {
                font-size: 1.1rem;
            }
        }
    </style>
@endsection

@section('scripts')
    <script>
        // Optional: You can add custom JS here to customize the collapse behavior or styling if needed
    </script>
@endsection
