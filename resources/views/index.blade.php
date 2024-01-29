@extends('layouts.frontend.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}">
@endpush
@section('content')
    <section class="banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="left-section">
                        <h1 class="white-color f-600">Projects are a <b class="main-color">Nightmare!</b></h1>
                        <p class="white-color mt-3 f-500 text-capitalize">We help you deliver them with confidence</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-section">
                        <h5 class="text-capitalize white-color">Everything You Need to Work Smarter, Save Precious Time
                            and grow your business faster, in one place! <br>Opening at 08:30 AM</h5>
                        <a href="{{ route('signup') }}"><button class="btn common-btn mt-4">Sign Up</button></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="customers-testimonials" class="owl-carousel">
                        <div class="item">
                            <div class="shadow-effect">
                                <img class="img-circle"
                                    src="http://themes.audemedia.com/html/goodgrowth/images/testimonial3.jpg"
                                    alt="">
                                <h6 class="main-color mb-0 text-left">4.5</h6>
                                <div class="stars">
                                    <i class="bi bi-star-fill full-star"></i>
                                    <i class="bi bi-star-fill full-star"></i>
                                    <i class="bi bi-star-fill full-star"></i>
                                    <i class="bi bi-star-fill full-star"></i>
                                    <i class="bi bi-star-fill half-star"></i>
                                </div>
                                <p>Dramatically maintain clicks-and-mortar solutions without functional solutions.
                                    Completely synergize resource taxing relationships via premier niche markets.
                                    Professionally cultivate.</p>
                                <hr class="main-color">
                                <h4 class="client-name black-color f-500"><i class="bi bi-dash-lg me-2 main-color"></i>Liya
                                    Patrik</h4>
                            </div>
                        </div>
                        <div class="item">
                            <div class="shadow-effect">
                                <img class="img-circle"
                                    src="http://themes.audemedia.com/html/goodgrowth/images/testimonial3.jpg"
                                    alt="">
                                <h6 class="main-color mb-0 text-left">4.5</h6>
                                <div class="stars">
                                    <i class="bi bi-star-fill full-star"></i>
                                    <i class="bi bi-star-fill full-star"></i>
                                    <i class="bi bi-star-fill full-star"></i>
                                    <i class="bi bi-star-fill full-star"></i>
                                    <i class="bi bi-star-fill half-star"></i>
                                </div>
                                <p>Dramatically maintain clicks-and-mortar solutions without functional solutions.
                                    Completely synergize resource taxing relationships via premier niche markets.
                                    Professionally cultivate.</p>
                                <hr class="main-color">
                                <h4 class="client-name black-color f-500"><i class="bi bi-dash-lg me-2 main-color"></i>Liya
                                    Patrik</h4>
                            </div>
                        </div>
                        <div class="item">
                            <div class="shadow-effect">
                                <img class="img-circle"
                                    src="http://themes.audemedia.com/html/goodgrowth/images/testimonial3.jpg"
                                    alt="">
                                <h6 class="main-color mb-0 text-left">4.5</h6>
                                <div class="stars">
                                    <i class="bi bi-star-fill full-star"></i>
                                    <i class="bi bi-star-fill full-star"></i>
                                    <i class="bi bi-star-fill full-star"></i>
                                    <i class="bi bi-star-fill full-star"></i>
                                    <i class="bi bi-star-fill half-star"></i>
                                </div>
                                <p>Dramatically maintain clicks-and-mortar solutions without functional solutions.
                                    Completely synergize resource taxing relationships via premier niche markets.
                                    Professionally cultivate.</p>
                                <hr class="main-color">
                                <h4 class="client-name black-color f-500"><i class="bi bi-dash-lg me-2 main-color"></i>Liya
                                    Patrik</h4>
                            </div>
                        </div>
                        <div class="item">
                            <div class="shadow-effect">
                                <img class="img-circle"
                                    src="http://themes.audemedia.com/html/goodgrowth/images/testimonial3.jpg"
                                    alt="">
                                <h6 class="main-color mb-0 text-left">4.5</h6>
                                <div class="stars">
                                    <i class="bi bi-star-fill full-star"></i>
                                    <i class="bi bi-star-fill full-star"></i>
                                    <i class="bi bi-star-fill full-star"></i>
                                    <i class="bi bi-star-fill full-star"></i>
                                    <i class="bi bi-star-fill half-star"></i>
                                </div>
                                <p>Dramatically maintain clicks-and-mortar solutions without functional solutions.
                                    Completely synergize resource taxing relationships via premier niche markets.
                                    Professionally cultivate.</p>
                                <hr class="main-color">
                                <h4 class="client-name black-color f-500"><i class="bi bi-dash-lg me-2 main-color"></i>Liya
                                    Patrik</h4>
                            </div>
                        </div>
                        <div class="item">
                            <div class="shadow-effect">
                                <img class="img-circle"
                                    src="http://themes.audemedia.com/html/goodgrowth/images/testimonial3.jpg"
                                    alt="">
                                <h6 class="main-color mb-0 text-left">4.5</h6>
                                <div class="stars">
                                    <i class="bi bi-star-fill full-star"></i>
                                    <i class="bi bi-star-fill full-star"></i>
                                    <i class="bi bi-star-fill full-star"></i>
                                    <i class="bi bi-star-fill full-star"></i>
                                    <i class="bi bi-star-fill half-star"></i>
                                </div>
                                <p>Dramatically maintain clicks-and-mortar solutions without functional solutions.
                                    Completely synergize resource taxing relationships via premier niche markets.
                                    Professionally cultivate.</p>
                                <hr class="main-color">
                                <h4 class="client-name black-color f-500"><i class="bi bi-dash-lg me-2 main-color"></i>Liya
                                    Patrik</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-center mt-3">Share Your Thoughts!</p>
            <div class="text-center">
                <a href="#"><button class="common-btn">Write a Review</button></a>
            </div>
        </div>
    </section>

    <section class="youtube">
        <div class="container">
            <p class="white-color text-center">In a fully Digital World , ECONO - ProjectEX provides, effective
                consultative/advisory, change management, managedc and technical implimentation services tailored to
                adress the entire breadth of you business needs and success</p>
            <div class="youtube-video mt-4">
                <iframe src="https://www.youtube.com/embed/XV1cOGaZUq0?si=LMIXLag_k_VxIP1k" title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
            </div>
        </div>
    </section>
@endsection
