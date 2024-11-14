<footer class="mt-auto bg-primary">
    <div class="container">
        <div class="row">

            <div class="col-md-4 pt-5">
                <h2 class="h2 text-success border-bottom pb-3 border-secondary logo">
                    <img class="img-fluid" src="{{ asset('img/logo/logo2.png') }}" width="200" alt="logo">
                </h2>
                <ul class="list-unstyled text-white footer-link-list">
                    <li class="text-white">
                        <i class="fas fa-map-marker-alt"></i>
                        Tungkop, Minglanilla, Cebu, Philippines
                    </li>
                    <li>
                        <i class="fa fa-phone"></i>
                        <a class="text-decoration-none text-white" href="tel:+639663815639">+639663815639</a>
                    </li>
                    <li>
                        <i class="fa fa-envelope"></i>
                        <a class="text-decoration-none text-white" href="mailto: {{ config('mail.from.address') }}">
                            {{ config('mail.from.address') }}</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-4 pt-5">
                <h2 class="h2 text-white border-bottom pb-3 border-secondary">Services</h2>
                <ul class="list-unstyled footer-link-list">
                    @foreach ($our_services as $id => $our_service)
                        <li>
                            <a class="text-decoration-none text-white"
                                href="{{ route('customer.services.schedules.index', $id) }}">{{ $our_service }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-4 pt-5">
                <h2 class="h2 text-white border-bottom pb-3 border-secondary">Quick Links</h2>
                <ul class="list-unstyled text-white footer-link-list">
                    <li><a class="text-decoration-none text-white" href="/">Home</a></li>
                    <li><a class="text-decoration-none text-white" href="{{ route('main.pages.about') }}">About Us</a>
                    </li>
                    <li><a class="text-decoration-none text-white"
                            href="{{ route('customer.services.index') }}">Services</a>
                    </li>
                    <li><a class="text-decoration-none text-white" href="{{ route('main.pages.faqs') }}">FAQS</a></li>
                    <li><a class="text-decoration-none text-white" href="/#contact">Contact</a></li>
                    <li><a class="text-decoration-none text-white" href="javascript:void(0)">Terms &amp;
                            Conditions</a></li>
                    <li><a class="text-decoration-none text-white" href="javascript:void(0)">Privacy &amp;
                            Policy</a></li>
                </ul>
            </div>

        </div>

        <div class="row text-white mb-4">
            <div class="col-12 mb-3">
                <div class="w-100 my-3 border-top border-secondary"></div>
            </div>
            <div class="col-auto mr-auto">
                <ul class="list-inline text-left footer-icons">
                    <li class="list-inline-item border border-secondary rounded-circle text-center">
                        <a class="text-white text-decoration-none" target="_blank" href="http://facebook.com/"><i
                                class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-secondary rounded-circle text-center">
                        <a class="text-white text-decoration-none" target="_blank" href="https://twitter.com/"><i
                                class="fab fa-twitter fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-secondary rounded-circle text-center">
                        <a class="text-white text-decoration-none" target="_blank" href="https://www.instagram.com/"><i
                                class="fab fa-instagram fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-secondary rounded-circle text-center">
                        <a class="text-white text-decoration-none" target="_blank" href="https://www.youtube.com/"><i
                                class="fab fa-youtube fa-lg fa-fw"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="w-100 bg-black py-3">
        <div class="container">
            <div class="row pt-2">
                <div class="col-12">
                    <p class="text-left text-white">
                        Copyright © 2024 {{ config('app.name') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

</footer>
