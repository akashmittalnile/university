@extends('layouts.frontend.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/mark-burnet-foundation.css') }}">
@endpush
@section('content')
    <section class="mark-burnet">
        <div class="container">
            <div class="sponser-partner">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="left-section">
                            <img src="{{ asset('frontend/images/sponser.jpg') }}" alt="image" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="right-section">
                            <h1 class="black-color head-1 mb-4">Become a <b class="main-color">Partner</b> <br> or <b
                                    class="main-color">Sponser</b></h1>
                        </div>
                    </div>
                </div>
                <p class="text-color mt-md-5 mt-sm-2 text-justify">Our purpose is to be at the heart of Project Management
                    as the engine to lead Business or Digital Transformation, solving pain points, putting 'Order to Chaos',
                    boosting productive communities through lucrative projects, dynamic tools, operational optimization,
                    technology solutions, effective training across industries.</p>
                <p class="text-color text-justify">"For over a decade, our team have been championing customer expectations,
                    driving business value across markets. We remain committed to fueling project management solutions,
                    which will open up opportunities for some of our greatest business/digital challenges and the benefits
                    to millions of people. -ECONO-ProjectEX Team.</p>
                <a href="#"><button class="btn common-btn mt-3">Join the Global Community<i
                            class="bi bi-arrow-right ms-2"></i></button></a>
            </div>
            <div class="donate-support">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="left-section">
                            <div class="img-box">
                                <img src="{{ asset('frontend/images/donate-support-1.jpg') }}" alt="image"
                                    class="img-fluid">
                            </div>
                            <img src="{{ asset('frontend/images/donate-support-2.jpg') }}" alt="image"
                                class="img-fluid img-2">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h1 class="mb-4 black-color">Donate <b class="main-color">&</b> Support</h1>
                        <p class="text-color text-justify">In a fully digital world, ECONO-ProjectEX provides effective
                            consultative/ advisory, change management, managed & technical implementation services tailored
                            to address the entire breadth of your business needs and success.</p>
                        <p class="text-color text-justify">We're focused on helping Micro, Small and Medium-sized
                            enterprises (MSMEs) including clients of all sizes to bring their most important project ideas
                            to life; customize operational setup, improve workflows, align resources and strategies across
                            an array of industry verticals. We take a case-by- case approach to deliver their complex
                            projects (or initiatives) with confidence; leveraging people, process and technology.</p>
                        <p class="text-color text-justify">We are BIG thinkers with demonstrated experience overseeing 25+
                            high-risk projects and 240+ cross-functional resources. Likewise, we've operated in demanding
                            conditions to deliver over 4204+ ICT sites serving over 4.0+ million consumers spanning 19+
                            countries across the Caribbean and Central America.</p>
                        <a href=""><button class="btn common-btn mt-4">Join The Community</button></a>
                    </div>
                </div>
            </div>
        </div>
       
        <div class="merch">
            <div class="container">
                <h1 class="white-color f-600 text-center mb-3">Merch</h1>
                <p class="white-color text-justify text-center">Most importantly, ECONO-ProjectEX is committed to
                    collaborate with the international project management community, and offer tremendous advantages to
                    Micro, Small and Medium-sized enterprises (MSMEs): Executives/Sponsors, Entrepreneurs, Consultants,
                    Contractors, Teachers, Students, Project/ Senior Managers, Project Management Offices (PMOs) among
                    others who are eager to shift and serve their industries.</p>
                @if(!isset(auth()->user()->id))
                <div class="text-center">
                    <a href="sign-up.html"><button class="btn common-btn mt-1 signup-btn">Sign up</button></a>
                </div>
                @endif
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
        
    </section>
@endsection
