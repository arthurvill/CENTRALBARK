@extends('layouts.main.app')

@section('title', "$app_name | Contact Us")

@section('content')
    <div class="container my-5">
        <div class="card shadow-lg border-0 rounded">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <img class="img-fluid d-block mx-auto" src="{{ asset('img/main/section-3/contact.svg') }}" alt="Contact Us">
                </div>
                <div class="col-md-6">
                    <h3 class="font-weight-bold text-center mb-4">Contact Information</h3>
                    <p class="text-muted text-center mb-5">You can reach us through any of the following methods:</p>

                    <!-- Phone -->
                    <div class="contact-info-item mb-4 p-4 border rounded-lg shadow-sm">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-phone-alt fa-2x mr-4 text-primary"></i>
                            <div>
                                <h5 class="mb-1">Phone</h5>
                                <p class="text-muted">+63 912 345 6789</p>
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="contact-info-item mb-4 p-4 border rounded-lg shadow-sm">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-envelope fa-2x mr-4 text-primary"></i>
                            <div>
                                <h5 class="mb-1">Email</h5>
                                <p class="text-muted">centralbarkclinic@gmail.com</p>
                            </div>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="contact-info-item mb-4 p-4 border rounded-lg shadow-sm">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-map-marker-alt fa-2x mr-4 text-primary"></i>
                            <div>
                                <h5 class="mb-1">Address</h5>
                                <p class="text-muted">Tungkop, Minglanilla, Cebu, Philippines</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        /* Card styling for contact info */
        .contact-info-item {
            background-color: #f9f9f9;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .contact-info-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .contact-info-item i {
            color: #007bff; /* Blue icon color */
        }

        .contact-info-item h5 {
            color: #333;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .contact-info-item p {
            color: #555;
        }

        /* Responsive layout */
        @media (max-width: 768px) {
            .contact-info-item h5 {
                font-size: 1.15rem;
            }
            .contact-info-item p {
                font-size: 1rem;
            }
        }

        /* Additional styles for the container and cards */
        .card {
            background-color: #ffffff;
            padding: 30px;
        }

        .card h3 {
            font-size: 2rem;
            color: #023e8a;
            font-weight: 800!important;
        }

        .card p {
            font-size: 1.1rem;
            color: #666;
        }
    </style>
@endsection

@section('scripts')
    <!-- FontAwesome icons for phone, email, and address -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
@endsection
