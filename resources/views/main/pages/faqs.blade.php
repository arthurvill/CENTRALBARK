@extends('layouts.main.app')

@section('title', "$app_name | FAQS")

@section('content')
    <div class="container my-auto"><br><br><br><br>
        <div class="card card-body ">
            <div class="row justify-content-center">
                <div class="col-md-6 order-0 order-lg-1">
                    <img class="img-fluid d-block mx-auto" src="{{ asset('img/main/faqs.svg') }}" alt="faqs">
                </div>
                <div class="col-md-6 order-1 order-lg-0">
                    <h3 class="font-weight-normal">
                        Where is your clinic located?
                    </h3>
                    <h4 class="font-weight-normal text-muted">
                        We’re located at Tungkop, Minglanilla, Cebu, Philippines
                    </h4>
                    <br>
                    <h3 class="font-weight-normal">
                        Do you accept walk-in patients?
                    </h3>
                    <h4 class="font-weight-normal text-muted">
                        Yes! We surely cater walk-in patients especially for those who need urgent medical
                        attention. Just visit our clinic.
                    </h4>
                    <br>
                    <h3 class="font-weight-normal">
                        Do you have grooming services?
                    </h3>
                    <h4 class="font-weight-normal text-muted">
                        Yes! We do have grooming services, prices may vary depending on the height and
                        weight of your pet.
                    </h4>
                    <br>
                    <h3 class="font-weight-normal">
                        Do you have an anti-distemper and anti-parvo vaccine?
                    </h3>
                    <h4 class="font-weight-normal text-muted">
                        Yes! We do have an anti-distemper and anti-parvo vaccine, visit our clinic for more
                        information.
                    </h4>
                    <br>
                    <h3 class="font-weight-normal">
                        Is your clinic 24 hours open?
                    </h3>
                    <h4 class="font-weight-normal text-muted">
                        No, our clinic operates at 10:00 AM in the morning and closes by 5:00 PM every
                        Monday - Saturday.
                    </h4>
                    <br>
                    <h3 class="font-weight-normal">
                        Where can I send my payment?
                    </h3>
                    <h4 class="font-weight-normal text-muted">
                        Our clinic accepts GCash and Cash only.
                    </h4>
                </div>
            </div>
        </div>
    </div>
@endsection
