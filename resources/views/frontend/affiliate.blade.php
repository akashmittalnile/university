@extends('layouts.frontend.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/affiliate-links.css') }}">
@endpush

@section('content')
    <section class="affiliate-links">
        <div class="project-manager"></div>
        <div class="join-community">
            <h1 class="black-color text-center text-capitalize">Rocking rock stars project <b class="main-color">managers</b>
                <br> strategic project <b class="main-color">leaders</b>
            </h1>
            <p class="black-color mt-4 text-center">Giving you the proffessional guidance and expert tools you need to
                execute projects with soaring success to become leaders n business beyond.</p>
            <div class="d-flex justify-content-center affiliate-buttons mt-5">
                <a href=""><button class="btn free-btn">Free Resources<i
                            class="bi bi-arrow-right ms-3"></i></button></a>
                <a href=""><button class="btn common-btn ms-md-3">Join the Global Community<i
                            class="bi bi-arrow-right ms-3"></i></button></a>
            </div>
        </div>
        <div class="affiliate-images">
            <div class="container">
                <p class="white-color text-justify">Most importantly, ECONO-ProjectEX is committed to collaborate with the
                    international project management community, and offer tremendous advantages to Micro, Small and
                    Medium-sized enterprises (MSMEs): Executives/Sponsors, Entrepreneurs, Consultants, Contractors,
                    Teachers, Students, Project/ Senior Managers, Project Management Offices (PMOs) among others who are
                    eager to shift and serve their industries.</p>
                <a href="{{ route('signup') }}"><button class="btn common-btn mt-1 signup-btn">Sign up</button></a>
                <div class="image-slider">
                    <div class="parent">
                        <div class="carousel">
                            <div class="owl-carousel ">
                                <div class="slide">
                                    <img src="{{ asset('frontend/images/affiliate-slider-1.jpg') }}"
                                        class="aboutImageSlide">
                                </div>
                                <div class="slide">
                                    <img src="{{ asset('frontend/images/affiliate-slider-1.jpg') }}"
                                        class="aboutImageSlide">
                                </div>
                                <div class="slide">
                                    <img src="https://images.unsplash.com/photo-1700493624764-f7524969037d?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                        alt="ourPromise" class="aboutImageSlide">
                                </div>
                                <div class="slide">
                                    <img src="{{ asset('frontend/images/affiliate-slider-1.jpg') }}"
                                        class="aboutImageSlide">
                                </div>
                                <div class="slide">
                                    <img src="https://images.unsplash.com/photo-1700493624764-f7524969037d?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                        alt="ourVibe" class="aboutImageSlide">
                                </div>
                                <div class="slide">
                                    <img src="https://images.unsplash.com/photo-1700493624764-f7524969037d?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                        alt="ourVibe" class="aboutImageSlide">
                                </div>
                                <div class="slide">
                                    <img src="{{ asset('frontend/images/affiliate-slider-1.jpg') }}"
                                        class="aboutImageSlide">
                                </div>
                                <div class="slide">
                                    <img src="{{ asset('frontend/images/affiliate-slider-1.jpg') }}"
                                        class="aboutImageSlide">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="business-links">
            <div class="container">
                <h1 class="black-color text-center text-capitalize">Business <b class="main-color">Links</b></h1>
                <div class="business-link-contents">
                    <div class="link-box mb-3">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="left-section">
                                    <img src="{{ asset('frontend/images/business-links-1.jpg') }}" alt="image"
                                        class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="right-section">
                                    <h4 class="black-color mb-4 f-600">ECONO-ProjectEX provides effective</h4>
                                    <p class="text-color">In a fully digital world ECONO-ProjectEX provides effective
                                        consultive/adivisory. change management, managed & technical implimentation services
                                        tailored to address the entire breadth of your bsiness needs and success.</p>
                                    <br>
                                    <p class="black-color">We're focussed on helping Micro, Small and Medium-seized
                                        enterprices(MSMEs)</p>
                                    <a href="#"><button class="btn learn-more-btn mt-2">Learn More<i
                                                class="bi bi-arrow-right ms-3"></i></button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="link-box mb-3">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="left-section">
                                    <img src="{{ asset('frontend/images/business-links-1.jpg') }}" alt="image"
                                        class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="right-section">
                                    <h4 class="black-color mb-4 f-600">ECONO-ProjectEX provides effective</h4>
                                    <p class="text-color">In a fully digital world ECONO-ProjectEX provides effective
                                        consultive/adivisory. change management, managed & technical implimentation services
                                        tailored to address the entire breadth of your bsiness needs and success.</p>
                                    <br>
                                    <p class="black-color">We're focussed on helping Micro, Small and Medium-seized
                                        enterprices(MSMEs)</p>
                                    <a href="#"><button class="btn learn-more-btn mt-2">Learn More<i
                                                class="bi bi-arrow-right ms-3"></i></button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="link-box mb-3">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="left-section">
                                    <img src="{{ asset('frontend/images/business-links-1.jpg') }}" alt="image"
                                        class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="right-section">
                                    <h4 class="black-color mb-4 f-600">ECONO-ProjectEX provides effective</h4>
                                    <p class="text-color">In a fully digital world ECONO-ProjectEX provides effective
                                        consultive/adivisory. change management, managed & technical implimentation services
                                        tailored to address the entire breadth of your bsiness needs and success.</p>
                                    <br>
                                    <p class="black-color">We're focussed on helping Micro, Small and Medium-seized
                                        enterprices(MSMEs)</p>
                                    <a href="#"><button class="btn learn-more-btn mt-2">Learn More<i
                                                class="bi bi-arrow-right ms-3"></i></button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="link-box mb-3">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="left-section">
                                    <img src="{{ asset('frontend/images/business-links-1.jpg') }}" alt="image"
                                        class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="right-section">
                                    <h4 class="black-color mb-4 f-600">ECONO-ProjectEX provides effective</h4>
                                    <p class="text-color">In a fully digital world ECONO-ProjectEX provides effective
                                        consultive/adivisory. change management, managed & technical implimentation services
                                        tailored to address the entire breadth of your bsiness needs and success.</p>
                                    <br>
                                    <p class="black-color">We're focussed on helping Micro, Small and Medium-seized
                                        enterprices(MSMEs)</p>
                                    <a href="#"><button class="btn learn-more-btn mt-2">Learn More<i
                                                class="bi bi-arrow-right ms-3"></i></button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="#"><button class="btn common-btn mt-md-5 mt-sm-2 load-more-btn">Load More<i
                                    class="bi bi-arrow-down ms-2"></i></button></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
