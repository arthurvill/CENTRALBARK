@extends('layouts.main.app')

@section('content')
    {{-- Section 1 --}}
    <section class="mt-5 bg-primary">
        <div id="template-mo-zay-hero-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#template-mo-zay-hero-carousel" data-slide-to="0" class="active" aria-current="true"></li>
                <li data-target="#template-mo-zay-hero-carousel" data-slide-to="1"></li>
                <li data-target="#template-mo-zay-hero-carousel" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner p-5" style="
                height: 65vh;
                background-image: url('{{ asset('img/main/section-1/dog.png') }}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                margin-top: -80px;
            ">
                <div class="carousel-item active carousel-item-start" id="carousel-item-1">
                    <div class="container d-flex justify-content-center align-items-center" style="height: 100%; margin-top: 210px;">
                        <div class="text-align-center align-self-center text-center">
                            <h1 class="display-3 text-capitalize text-white font-weight-bold">Your Pet's Wellness, Our Priority</h1>
                            <p class="text-white font-weight-bold">Welcome to Central Bark Veterinary Clinic, where trust and comfort are priorities.</p>
                            <a class="btn btn-success" href="/about">Read more</a>
                        </div>
                    </div>
                </div>

                <div class="carousel-item carousel-item-next carousel-item-start" id="carousel-item-2">
                    <div class="container d-flex justify-content-center align-items-center" style="height: 100%; margin-top: 210px;">
                        <div class="text-align-center align-self-center text-center">
                            <h1 class="display-3 text-capitalize text-white font-weight-bold">Nurturing Health, Pawsitively</h1>
                            <p class="text-white font-weight-bold">Trust us to nurture their health with a positive touch, ensuring a lifetime of love and vitality.</p>
                            <a class="btn btn-success" href="/about">Read more</a>
                        </div>
                    </div>
                </div>

                <div class="carousel-item" id="carousel-item-3">
                    <div class="container d-flex justify-content-center align-items-center" style="height: 100%; margin-top: 210px;">
                        <div class="text-align-center align-self-center text-center">
                            <h1 class="display-3 text-capitalize text-white font-weight-bold">Your Partner in Pet Wellbeing</h1>
                            <p class="text-white font-weight-bold">Together, let's ensure their wellbeing and create unforgettable memories filled with wagging tails and purring contentment.</p>
                            <a class="btn btn-success" href="/about">Read more</a>
                        </div>
                    </div>
                </div>
            </div>

            <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-slide="prev">
                <i class="fas fa-chevron-left"></i>
            </a>
            <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-slide="next">
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    </section>
    {{-- End Section 1 --}}

    {{-- Team of Amazing Experts Section --}}
    <section class="py-2 py-md-0">
        <div class="container">
            <!-- About Us Section -->
            <div class="row text-center pt-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="d-md-block text-primary font-weight-bold">About Us <i class="fas fa-info-circle ml-1"></i></h1>
                </div>
            </div>

            <!-- Image and Paragraph Side by Side -->
            <div class="row align-items-center mt-3">
                <!-- Image Section -->
                <div class="col-md-6 text-center">
                    <div style="width: 100%; height: 350px; background-image: url('{{ asset('img/about/about.png') }}'); background-size: cover; background-position: center; border-radius: 0px;"></div>
                </div>

                <!-- Paragraph Section -->
                <div class="col-md-6">
                    <p class="">Our shop was founded in Tungkop, Minglanilla, Cebu and has been a beloved part of the community. With our commitment to providing exceptional services for pets and their owners, we have expanded to include a branch in Tungkop, Minglanilla, Cebu, ensuring that even more furry friends and their families have access to top-quality care. At Central Bark Clinic, we understand the special bond between pets and their owners. That's why we strive carefully selected to meet the unique needs of every pet. Our knowledgeable and friendly staff are here to assist you in finding the perfect items for your furry companions. Whether you're a seasoned pet parent or a first-time pet owner, we're dedicated to providing you with the support and resources you need to give your pets the happy, healthy lives they deserve.</p>
                </div>
            </div>

            <!-- Team of Amazing Experts Section -->
            <!-- <div class="row text-center pt-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="d-md-block text-primary font-weight-bold">Team of Amazing Experts <i class="fas fa-users ml-1"></i></h1>
                </div>
            </div>

            <div class="row mt-2 justify-content-center">
                <div class="col-md-4 text-center">
                    <h3 class="font-weight-bold">Jeniphyr M. Largo</h3>
                    <img style="width: 100%; height: 250px; object-fit: cover; border-radius: 15px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);" src="{{ asset('img/team/t1.jpg') }}" alt="Expert 1">
                </div>
                <div class="col-md-4 text-center">
                    <h3 class="font-weight-bold">Sin Causing</h3>
                    <img style="width: 100%; height: 250px; object-fit: cover; border-radius: 15px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);" src="{{ asset('img/team/t2.jpg') }}" alt="Expert 2">
                </div>
                <div class="col-md-4 text-center">
                    <h3 class="font-weight-bold">Camly Galingan</h3>
                    <img style="width: 100%; height: 250px; object-fit: cover; border-radius: 15px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);" src="{{ asset('img/team/t3.jpg') }}" alt="Expert 3">
                </div> -->
            </div>
        </div>
    </section>
    {{-- End Team of Amazing Experts Section --}}

    <center>
        <hr class="w-75">
    </center>

    {{-- Section 2 --}}
    <section class="py-2 py-md-5">
    <div class="container">
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1 class="d-md-block text-primary font-weight-bold">Our Services <i class="fas fa-clipboard-list ml-1"></i></h1>
                <p>We offer a comprehensive range of veterinary services designed to keep your pets healthy and thriving.</p>
            </div>
        </div>

        <div class="row mt-3">
            @foreach ($services as $service)
                <div class="col-md-4 col-lg-4 d-flex services align-self-stretch">
                    <div class="card w-100 card-shadow-none hoverable rounded"
                         style="transition: transform 0.3s ease, box-shadow 0.3s ease !important;">
                        <div class="card-body d-flex flex-column text-center text-small p-0">
                            <img class="img-fluid d-block mx-auto" src="{{ asset('img/service/paw.png') }}" width="100" alt="service">
                        </div>
                        <div class="card-footer border-0 pt-1 pb-2 text-center">
                            <h3 class="font-weight-bold">
                                <a href="{{ route('customer.services.schedules.index', $service) }}">{{ $service->name }}</a>
                            </h3>
                            <h4 class="font-weight-normal text-muted" data-toggle="tooltip" data-placement="right" title="{{ $service->description }}">
                                {{ textTruncate($service->description, '100') }}
                            </h4>
                            <!-- Book Now Button -->
                            <a href="{{ route('customer.services.schedules.index', $service) }}"
                               class="btn btn-primary mt-3"
                               style="padding: 10px 20px; font-size: 13px; border-radius: 5px !important; transition: background-color 0.3s; background-color: #172b4d !important; border-color: #172b4d !important;">
                                Book Now
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <center>
        <hr class="w-75">
    </center>
</section>

<!-- Inline hover styles -->
<section>
    <script>
        document.querySelectorAll('.card').forEach(card => {
            card.addEventListener('mouseover', () => {
                card.style.transform = 'scale(1.05)';
                card.style.boxShadow = '0 4px 15px rgba(0, 0, 0, 0.2)';
            });
            card.addEventListener('mouseout', () => {
                card.style.transform = 'scale(1)';
                card.style.boxShadow = 'none';
            });
        });

        document.querySelectorAll('.btn-primary').forEach(button => {
            button.addEventListener('mouseover', () => {
                button.style.backgroundColor = '#0056b3';
            });
            button.addEventListener('mouseout', () => {
                button.style.backgroundColor = '#172b4d';
            });
        });
    </script>
</section>

    {{-- End Section 2 --}}
    
    {{-- Section 4 --}}
    <section>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3926.2245532163793!2d123.780205!3d10.2367509!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a977b93e3881bf%3A0x80da9a87587027e7!2sCentral%20Bark%20Veterinary%20Clinic!5e0!3m2!1sen!2sph!4v1686225433542!5m2!1sen!2sph"
            width="100%" height="500px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </section>
    {{-- End Section 4 --}}

    <center>
        <hr class="w-75">
    </center>

    {{-- FAQ Section --}}
    {{-- FAQ Section --}}
<section class="my-5">
    <div class="container my-auto">
    <h1 class="text-center text-primary font-weight-bold mb-4">Frequently Asked Questions
                <i class="fas fa-question-circle"></i>
            </h1>

        <div class="card card-body">
            <div class="row justify-content-center">
                <div class="col-md-6 order-0 order-lg-1">
                    <img class="img-fluid d-block mx-auto" src="{{ asset('img/main/faqs.svg') }}" alt="faqs">
                </div>
                <div class="col-md-6 order-1 order-lg-0">
                    <div class="accordion" id="faqAccordion">
                        <!-- FAQ 1 -->
                        <div class="card faq-item">
    <div class="card-header p-0">
        <button class="btn btn-link p-0 text-left w-100" type="button" data-toggle="collapse" data-target="#faq1" aria-expanded="false" aria-controls="faq1">
            <h3 class="font-weight-normal">Where is your clinic located?</h3>
        </button>
    </div>
    <div id="faq1" class="collapse" data-parent="#faqAccordion">
        <div class="card-body text-muted">
            We’re located at Tungkop, Minglanilla, Cebu, Philippines.
        </div>
    </div>
</div>

                        <!-- FAQ 2 -->
                        <div class="card faq-item">
                            <div class="card-header p-0">
                                <button class="btn btn-link p-0 text-left w-100" type="button" data-toggle="collapse" data-target="#faq2" aria-expanded="false" aria-controls="faq2">
                                    <h3 class="font-weight-normal">Do you accept walk-in patients?</h3>
                                </button>
                            </div>
                            <div id="faq2" class="collapse" data-parent="#faqAccordion">
                                <div class="card-body text-muted">
                                    Yes! We cater to walk-in patients, especially those needing urgent medical attention. Just visit our clinic.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 3 -->
                        <div class="card faq-item">
                            <div class="card-header p-0">
                                <button class="btn btn-link p-0 text-left w-100" type="button" data-toggle="collapse" data-target="#faq3" aria-expanded="false" aria-controls="faq3">
                                    <h3 class="font-weight-normal">Do you have grooming services?</h3>
                                </button>
                            </div>
                            <div id="faq3" class="collapse" data-parent="#faqAccordion">
                                <div class="card-body text-muted">
                                    Yes! We offer grooming services, with prices varying depending on your pet's size and weight.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 4 -->
                        <div class="card faq-item">
                            <div class="card-header p-0">
                                <button class="btn btn-link p-0 text-left w-100" type="button" data-toggle="collapse" data-target="#faq4" aria-expanded="false" aria-controls="faq4">
                                    <h3 class="font-weight-normal">What are your clinic hours?</h3>
                                </button>
                            </div>
                            <div id="faq4" class="collapse" data-parent="#faqAccordion">
                                <div class="card-body text-muted">
                                    Our clinic is open from 8 AM to 5 PM, Monday through Saturday.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 5 -->
                        <div class="card faq-item">
                            <div class="card-header p-0">
                                <button class="btn btn-link p-0 text-left w-100" type="button" data-toggle="collapse" data-target="#faq5" aria-expanded="false" aria-controls="faq5">
                                    <h3 class="font-weight-normal">Do you provide home visits for pets?</h3>
                                </button>
                            </div>
                            <div id="faq5" class="collapse" data-parent="#faqAccordion">
                                <div class="card-body text-muted">
                                    Yes, we offer home visits for pets in certain cases. Please contact us for more details.
                                </div>
                            </div>
                        </div>

                        <!-- Add more FAQs as needed in the same format -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    {{-- End FAQ Section --}}
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
