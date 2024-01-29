@extends('layouts.frontend.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/mark-network.css') }}">
    <style>
        .stripe-button-el {
            opacity: 1;
        }
    </style>
@endpush
@section('content')
    <section class="mark-network">
        <div class="container">
            <div class="membership">
                <div class="row">
                    <div class="col-md-4 col-position-1">
                        <div class="left-section">
                            <h1 class="mb-4 white-color">Mentorship</h1>
                            <p class="white-color text-justify">Our purpose is to be at the heart of Project Management as
                                the engine to lead Business or Digital Transformation, solving pain points, putting 'Order
                                to Chaos', boosting productive communities through lucrative projects, dynamic tools,
                                operational optimization, technology solutions, effective training across industries. </p>
                            <p class="white-color text-justify">"For over a decade, our team have been championing customer
                                expectations, driving business value across markets. We remain committed to fueling project
                                management solutions, which will open up opportunities for some of our greatest
                                business/digital challenges and the benefits to millions of people." -ECONO-ProjectEX Team.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-8 col-position-2">
                        <div class="right-section">

                        </div>
                    </div>
                </div>
            </div>
            <div class="community">
                <div class="row align-items-center">
                    <div class="col-md-6 ">
                        <div class="left-section">
                            <div class="img-box">
                                <img src="{{ asset('frontend/images/community-1.jpg') }}" alt="image" class="img-fluid">
                            </div>
                            <img src="{{ asset('frontend/images/community-2.jpg') }}" alt="image"
                                class="img-fluid img-2">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h1 class="mb-4 black-color">Community</h1>
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
    </section>
@endsection
