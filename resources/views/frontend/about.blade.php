@extends('layouts.frontend.app')
@push('css')
<link rel="stylesheet" href="{{ assets('frontend/css/about.css') }}">
@endpush
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.1/owl.carousel.min.js"></script>
<script src="{{ assets('frontend/js/about.js') }}"></script>
@endpush
@section('content')
<section class="about-us">
    <div class="container">
        <div class="vision-purpose">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="left-section">
                        <h1 class="text-md-end black-color">
                            {{ $data['sec1_title'] ?? 'NA' }}
                        </h1>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="right-section common-shadow">
                        <img src="{{ assets('uploads/about/'.($data['sec1_image'] ?? null)) }}" alt="image" class="img-fluid" />
                    </div>
                </div>
            </div>
            <p class="text-color text-justify mt-5">
                {{ $data['sec1_sub_title'] ?? 'NA' }}
            </p>
        </div>
        <div class="my-story">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="left-section">
                        <img src="{{ assets('uploads/about/'.($data['sec2_image'] ?? null)) }}" class="img-fluid" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="head mb-2">
                        <h1 class="black-color mb-0 pb-0">{{ $data['sec2_title'] ?? 'NA' }}</h1>
                    </div>
                    <p class="text-color text-justify mt-3">
                        {{ $data['sec2_sub_title'] ?? 'NA' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="what-we-do" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('public/uploads/about/{{($data['sec3_image'] ?? null)}}' ), background-repeat: no-repeat;">
        <div class="container">
            <h1 class="text-center white-color">
                {{ $data['sec3_title'] ?? 'NA' }}
            </h1>
            <!-- <p class="white-color sub-text text-center">
                Today, it's time to take Do you need help to your
                business from a point of chaos to order. handle your
                Business Save time, boost productivity, and overcome
                Transformation and scale with a full-range of simple
                solutions? complexities by smoothing processes and
                tasks:
            </p> -->
            <div class="what-we-do-box common-shadow">
                <p class="white-color sub-text text-center">{{ $data['sec3_sub_title'] ?? 'NA' }}</p>
                <!-- <ul>
                    <li>
                        <i class="bi bi-patch-check-fill me-2"></i>Grow
                        your business by helping you become more
                        productive with dedicated resources.
                    </li>
                    <li>
                        <i class="bi bi-patch-check-fill me-2"></i>Track
                        key metrics and maintain overall performance
                        reports. Lead resources and streamline projects
                        to completion.
                    </li>
                    <li>
                        <i class="bi bi-patch-check-fill me-2"></i>Improve your project results by overseeing the
                        performance of teams.
                    </li>
                    <li>
                        <i class="bi bi-patch-check-fill me-2"></i>Organize and automate your operations with
                        templates. Strengthen teams via the maze of
                        great practices.
                    </li>
                    <li>
                        <i class="bi bi-patch-check-fill me-2"></i>Manage change and customer experience, by
                        delivering the right projects the right way.
                    </li>
                    <li>
                        <i class="bi bi-patch-check-fill me-2"></i>Lead
                        technology implementation and digital
                        integration to accelerate measurable benefits.
                    </li>
                    <li>
                        <i class="bi bi-patch-check-fill me-2"></i>Mitigate risks, optimize cost, focus on
                        critical milestones for better road mapping or
                        forecasting.
                    </li>
                    <li>
                        <i class="bi bi-patch-check-fill me-2"></i>Serve
                        to foster a collaborative climate of learning
                        for Project Management, Business Analysis, Agile
                        and related fields.
                    </li>
                </ul> -->
            </div>
        </div>
    </div>
    <div class="how-we-do">
        <div class="container">
            <h1 class="text-center black-color">
                {{ $data2['sec_heading'] ?? 'NA' }}
            </h1>
            <div class="row">
                <div class="col-md-6 bottom-margin">
                    <div class="how-we-do-box common-shadow h-100 float">
                        <img src="{{ assets('uploads/about/'.($data2['sec1_image'] ?? null)) }}" alt="image" class="img-fluid" />
                        <h3 class="text-capitalize main-color mb-3">
                            {{ $data2['sec1_title'] ?? 'NA' }}
                        </h3>
                        <p class="black-color">
                            {{ $data2['sec1_sub_title'] ?? 'NA' }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6 bottom-margin">
                    <div class="how-we-do-box common-shadow h-100 float">
                        <img src="{{ assets('uploads/about/'.($data2['sec2_image'] ?? null)) }}" alt="image" class="img-fluid" />
                        <h3 class="text-capitalize main-color mb-3">
                            {{ $data2['sec2_title'] ?? 'NA' }}
                        </h3>
                        <p class="black-color">
                            {{ $data2['sec2_sub_title'] ?? 'NA' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="how-we-do-cards">
        <div class="container">
            <div class="row">
                <div class="col-md-4 bottom-margin">
                    <div class="card common-shadow float">
                        <div class="img-bg">
                            <img src="{{ assets('uploads/about/'.($data2['sec3_image'] ?? null)) }}" alt="image" class="img-fluid" />
                        </div>
                        <h5 class="f-600 mt-3">{{ $data2['sec3_title'] ?? 'NA' }}</h5>
                        <p class="mt-3">
                            {{ $data2['sec3_sub_title'] ?? 'NA' }}
                        </p>
                    </div>
                </div>
                <div class="col-md-4 bottom-margin">
                    <div class="card common-shadow float">
                        <div class="img-bg">
                            <img src="{{ assets('uploads/about/'.($data2['sec4_image'] ?? null)) }}" alt="image" class="img-fluid" />
                        </div>
                        <h5 class="f-600 mt-3">
                            {{ $data2['sec4_title'] ?? 'NA' }}
                        </h5>
                        <p class="mt-3">
                            {{ $data2['sec4_sub_title'] ?? 'NA' }}
                        </p>
                    </div>
                </div>
                <div class="col-md-4 bottom-margin">
                    <div class="card common-shadow float">
                        <div class="img-bg">
                            <img src="{{ assets('uploads/about/'.($data2['sec5_image'] ?? null)) }}" alt="image" class="img-fluid" />
                        </div>
                        <h5 class="f-600 mt-3">{{ $data2['sec5_title'] ?? 'NA' }}</h5>
                        <p class="mt-3">
                            {{ $data2['sec5_sub_title'] ?? 'NA' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="why-you-select">
        <div class="container">
            <h1 class="black-color head-1 mb-4">
                {{ $data['sec4_title'] ?? 'NA' }}
            </h1>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="left-section">
                        <img src="{{ assets('uploads/about/'.($data['sec4_image'] ?? null)) }}" alt="image" class="img-fluid" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="why-you-select-box common-shadow">
                        <p>
                            {{ $data['sec4_sub_title'] ?? 'NA' }}
                        </p>
                        <!-- <ul>
                            <li>
                                <i class="bi bi-patch-check-fill me-2"></i>We've seen it, we're living proof of
                                improved results and customer
                                satisfaction.
                            </li>
                            <li>
                                <i class="bi bi-patch-check-fill me-2"></i>Fewer cost overruns leveraging
                                effective project tools and best
                                practices.
                            </li>
                            <li>
                                <i class="bi bi-patch-check-fill me-2"></i>Detailed tracking/reporting and
                                data-driven perspectives to make things
                                right the first time!
                            </li>
                            <li>
                                <i class="bi bi-patch-check-fill me-2"></i>Provide diversity inclusion mentorship
                                to ignite team potential.
                            </li>
                            <li>
                                <i class="bi bi-patch-check-fill me-2"></i>Optimize resources and manage projects
                                faster with measurable performance.
                            </li>
                            <li>
                                <i class="bi bi-patch-check-fill me-2"></i>Mastery of project management tasks
                                that are applicable across virtually any
                                industry and methodology.
                            </li>
                        </ul> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="how-we-offer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="left-section">
                        <img src="{{ assets('uploads/about/'.($data['sec5_image'] ?? null)) }}" alt="image" class="img-fluid" />
                    </div>
                </div>
                <div class="col-md-6">
                    <h1 class="black-color head-1 mb-4">
                        {{ $data['sec5_title'] ?? 'NA' }}
                    </h1>
                    <div class="right-section">
                        <img src="{{ assets('uploads/about/'.($data['sec6_image'] ?? null)) }}" alt="image" class="img-fluid" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="how-we-offer-box mt-md-4 mt-sm-0">
                        <p>
                            {{ $data['sec5_sub_title'] ?? 'NA' }}
                        </p>
                        <!-- <ul>
                            <li>
                                <i class="bi bi-patch-check-fill me-2"></i>Leverage multi-country experiences,
                                methods, tools and processes to solve
                                pains points.
                            </li>
                            <li>
                                <i class="bi bi-patch-check-fill me-2"></i>Lead your business ambitions by
                                delivering the right projects with the
                                right resources.
                            </li>
                            <li>
                                <i class="bi bi-patch-check-fill me-2"></i>Smart decision-making and listen to
                                ensure understanding of your needs.
                            </li>
                            <li>
                                <i class="bi bi-patch-check-fill me-2"></i>Heart-based leadership shoulder an
                                effective system built on close
                                collaboration between technology &
                                business transformation.
                            </li>
                            <li>
                                <i class="bi bi-patch-check-fill me-2"></i>Winning customer experiences in digital
                                transformation projects.
                            </li>
                        </ul> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="who-is-it-for">
        <div class="container">
            <div class="who-is-it-for-contents">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="left-section">
                            <img src="{{ assets('uploads/about/'.($data['sec7_image'] ?? null)) }}" alt="image" class="img-fluid" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="right-section">
                            <h1 class="black-color head-1 mb-4">
                                {{ $data['sec6_title'] ?? 'NA' }}
                            </h1>
                            <p class="text-color text-justify">
                                {{ $data['sec6_sub_title'] ?? 'NA' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="global-impact">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="left-section">
                        <h1 class="black-color text-md-end head-1 mb-0 pb-0">
                            {{ $data['sec7_title'] ?? 'NA' }}
                        </h1>
                        <p class="text-color text-md-end">
                            {{ $data['sec7_sub_title'] ?? 'NA' }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-section">
                        <img src="{{ assets('uploads/about/'.($data['sec8_image'] ?? null)) }}" alt="image" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="why-you-select">
        <div class="container">
            <h1 class="black-color head-1 mb-4">
                {{ $data['sec8_title'] ?? 'NA' }}
            </h1>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="left-section">
                        <img src="{{ assets('uploads/about/'.($data['sec9_image'] ?? null)) }}" alt="image" class="img-fluid" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="why-you-select-box common-shadow">
                        <p>
                            {{ $data['sec8_sub_title'] ?? 'NA' }}
                        </p>
                        <!-- <ul>
                            <li>
                                <i class="bi bi-patch-check-fill me-2"></i>We've seen it, we're living proof of
                                improved results and customer
                                satisfaction.
                            </li>
                            <li>
                                <i class="bi bi-patch-check-fill me-2"></i>Fewer cost overruns leveraging
                                effective project tools and best
                                practices.
                            </li>
                            <li>
                                <i class="bi bi-patch-check-fill me-2"></i>Detailed tracking/reporting and
                                data-driven perspectives to make things
                                right the first time!
                            </li>
                            <li>
                                <i class="bi bi-patch-check-fill me-2"></i>Provide diversity inclusion mentorship
                                to ignite team potential.
                            </li>
                            <li>
                                <i class="bi bi-patch-check-fill me-2"></i>Optimize resources and manage projects
                                faster with measurable performance.
                            </li>
                            <li>
                                <i class="bi bi-patch-check-fill me-2"></i>Mastery of project management tasks
                                that are applicable across virtually any
                                industry and methodology.
                            </li>
                        </ul> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="global-impact">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="left-section">
                        <h1 class="black-color text-md-end head-1 mb-0 pb-0">
                            {{ $data['sec9_title'] ?? 'NA' }}
                        </h1>
                        <p class="text-color text-md-end">
                            {{ $data['sec9_sub_title'] ?? 'NA' }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-section">
                        <img src="{{ assets('uploads/about/'.($data['sec10_image'] ?? null)) }}" alt="image" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection