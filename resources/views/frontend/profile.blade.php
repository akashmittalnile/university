@extends('layouts.frontend.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/user-details.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
@endpush
@push('js')
    <script src="{{ asset('frontend/js/user-details.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
@endpush
@section('content')
    <section class="user-details">
        <div class="container">
            <div class="user-detiled-header">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div class="left-section">
                            <h1 class="black-color text-md-end">User <b class="main-color">Details</b></h1>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="right-section  common-shadow">
                            <img src="{{ asset('frontend/images/user-details.jpg') }}" alt="image" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-info">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="left-section">
                            <img src="{{ asset('frontend/images/profile-image.jpg') }}" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="head mb-2">
                            <h2 class="black-color mb-0 pb-0">{{ $user->name }}</h2>
                        </div>
                        <div class="d-flex mt-3 mt-md-5 mail-info align-items-center">
                            <img src="{{ asset('frontend/images/telephone.png') }}" alt="image" class="img-fluid me-2">
                            <p class="black-color f-600 m-0 p-0">{{ $user->phone }}</p>
                        </div>
                        <div class="d-flex mt-3 phone-info align-items-center">
                            <img src="{{ asset('frontend/images/letter.png') }}" alt="image" class="img-fluid me-2">
                            <h6 class="black-color f-600 m-0 p-0">{{ $user->email }}</h6>
                        </div>
                    </div>
                    <div class="col-md-12 mt-5 mb-3">
                        <h5 class="sub-head text-capitalize">My <b class="main-color">Subscription</b> Plan & <b
                                class="main-color">payment</b> Details</h5>
                    </div>
                    <div class="col-md-4  h-100">
                        <div class="card float common-shadow">
                            @if ($currentPlan)
                                <img src="{{ asset('frontend/images/subscription-plan.png') }}" alt="image"
                                    class="img-fluid">
                                <h5 class="text-color mt-3">${{ number_format($currentPlan->price, 2, '.', ',') }}/{{ ucfirst($currentPlan->type) }}
                                </h5>
                                <h3 class="main-color f-600 mt-3">{{ $currentPlan->name }}</h3>
                            @else
                                <h3 class="main-color f-600 mt-3">No Active Plan</h3>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-4  h-100">
                        <div class="card float common-shadow">
                            <img src="{{ asset('frontend/images/transaction.png') }}" alt="image" class="img-fluid">
                            <h5 class="text-color mt-3">Total Subscription Payment</h5>
                            <h3 class="main-color f-600 mt-3">${{ number_format($total, 2, '.', ',') }}</h3>
                        </div>
                    </div>
                    <div class="col-md-4 h-100 d-none">
                        <div class="card float common-shadow">
                            <img src="{{ asset('frontend/images/e-book.png') }}" alt="image" class="img-fluid">
                            <h5 class="text-color mt-3">Total E-book purchasement Payment</h5>
                            <h3 class="main-color f-600 mt-3">$345.23</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="purchased-items">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <h5 class="sub-head text-capitalize white-color text-md-left text-center">My purchased items</h5>
                        <div class="purchased-items-box mt-3 mt-md-5">
                            <button class="btn" id="ebook" onclick="showContent('ebook')">E-Book</button>
                            <button class="btn" id="podcasts" onclick="showContent('podcasts')">Podcast</button>
                            <div class="content active" id="ebookContent">
                                <div class="e-book">
                                    <div class="image-slider">
                                        <div class="parent">
                                            <div class="carousel">
                                                <div class="owl-carousel ">
                                                    <div class="slide">
                                                        <div class="card float">
                                                            <div class="img-box">
                                                                <img src="{{ asset('frontend/images/business-links-1.jpg') }}"
                                                                    class="aboutImageSlide">
                                                            </div>
                                                            <h6 class="black-color text-capitalize mt-3">Increasing return
                                                                on investment(Roi) through enhanced</h6>
                                                            <h3 class="main-color f-600 mt-2">$30.00</h3>
                                                        </div>
                                                    </div>
                                                    <div class="slide">
                                                        <div class="card float">
                                                            <div class="img-box">
                                                                <img src="{{ asset('frontend/images/affiliate-slider-1.jpg') }}"
                                                                    class="aboutImageSlide">
                                                            </div>
                                                            <h6 class="black-color text-capitalize mt-3">Increasing return
                                                                on investment(Roi) through enhanced</h6>
                                                            <h3 class="main-color f-600 mt-2">$30.00</h3>
                                                        </div>
                                                    </div>
                                                    <div class="slide">
                                                        <div class="card float">
                                                            <div class="img-box">
                                                                <img src="{{ asset('frontend/images/business-links-1.jpg') }}"
                                                                    class="aboutImageSlide">
                                                            </div>
                                                            <h6 class="black-color text-capitalize mt-3">Increasing return
                                                                on investment(Roi) through enhanced</h6>
                                                            <h3 class="main-color f-600 mt-2">$30.00</h3>
                                                        </div>
                                                    </div>
                                                    <div class="slide">
                                                        <div class="card float">
                                                            <div class="img-box">
                                                                <img src="{{ asset('frontend/images/affiliate-slider-1.jpg') }}"
                                                                    class="aboutImageSlide">
                                                            </div>
                                                            <h6 class="black-color text-capitalize mt-3">Increasing return
                                                                on investment(Roi) through enhanced</h6>
                                                            <h3 class="main-color f-600 mt-2">$30.00</h3>
                                                        </div>
                                                    </div>
                                                    <div class="slide">
                                                        <div class="card">
                                                            <div class="img-box">
                                                                <img src="{{ asset('frontend/images/business-links-1.jpg') }}"
                                                                    class="aboutImageSlide">
                                                            </div>
                                                            <h6 class="black-color text-capitalize mt-3">Increasing return
                                                                on investment(Roi) through enhanced</h6>
                                                            <h3 class="main-color f-600 mt-2">$30.00</h3>
                                                        </div>
                                                    </div>
                                                    <div class="slide">
                                                        <div class="card float">
                                                            <div class="img-box">
                                                                <img src="{{ asset('frontend/images/affiliate-slider-1.jpg') }}"
                                                                    class="aboutImageSlide">
                                                            </div>
                                                            <h6 class="black-color text-capitalize mt-3">Increasing return
                                                                on investment(Roi) through enhanced</h6>
                                                            <h3 class="main-color f-600 mt-2">$30.00</h3>
                                                        </div>
                                                    </div>
                                                    <div class="slide">
                                                        <div class="card float">
                                                            <div class="img-box">
                                                                <img src="{{ asset('frontend/images/business-links-1.jpg') }}"
                                                                    class="aboutImageSlide">
                                                            </div>
                                                            <h6 class="black-color text-capitalize mt-3">Increasing return
                                                                on investment(Roi) through enhanced</h6>
                                                            <h3 class="main-color f-600 mt-2">$30.00</h3>
                                                        </div>
                                                    </div>
                                                    <div class="slide">
                                                        <div class="card float">
                                                            <div class="img-box">
                                                                <img src="{{ asset('frontend/images/affiliate-slider-1.jpg') }}"
                                                                    class="aboutImageSlide">
                                                            </div>
                                                            <h6 class="black-color text-capitalize mt-3">Increasing return
                                                                on investment(Roi) through enhanced</h6>
                                                            <h3 class="main-color f-600 mt-2">$30.00</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content" id="podcastsContent">
                                <div class="podcasts">
                                    <div class="image-slider">
                                        <div class="parent">
                                            <div class="carousel">
                                                <div class="owl-carousel ">
                                                    <div class="slide">
                                                        <div class="card float">
                                                            <div class="img-box">
                                                                <img src="{{ asset('frontend/images/podcast.jpg') }}"
                                                                    class="aboutImageSlide">
                                                            </div>
                                                            <h6 class="black-color text-capitalize mt-3">Giving you the
                                                                proffessional guidance and expert tools</h6>
                                                            <p class="mt-3 main-color">Increasing Return on Investment(Roi)
                                                                Through Enhanced Customer Experience(Cx)</p>
                                                        </div>
                                                    </div>
                                                    <div class="slide">
                                                        <div class="card float">
                                                            <div class="img-box">
                                                                <img src="{{ asset('frontend/images/podcast.jpg') }}"
                                                                    class="aboutImageSlide">
                                                            </div>
                                                            <h6 class="black-color text-capitalize mt-3">Giving you the
                                                                proffessional guidance and expert tools</h6>
                                                            <p class="mt-3 main-color">Increasing Return on Investment(Roi)
                                                                Through Enhanced Customer Experience(Cx)</p>
                                                        </div>
                                                    </div>
                                                    <div class="slide">
                                                        <div class="card float">
                                                            <div class="img-box">
                                                                <img src="{{ asset('frontend/images/podcast.jpg') }}"
                                                                    class="aboutImageSlide">
                                                            </div>
                                                            <h6 class="black-color text-capitalize mt-3">Giving you the
                                                                proffessional guidance and expert tools</h6>
                                                            <p class="mt-3 main-color">Increasing Return on Investment(Roi)
                                                                Through Enhanced Customer Experience(Cx)</p>
                                                        </div>
                                                    </div>
                                                    <div class="slide">
                                                        <div class="card float">
                                                            <div class="img-box">
                                                                <img src="{{ asset('frontend/images/podcast.jpg') }}"
                                                                    class="aboutImageSlide">
                                                            </div>
                                                            <h6 class="black-color text-capitalize mt-3">Giving you the
                                                                proffessional guidance and expert tools</h6>
                                                            <p class="mt-3 main-color">Increasing Return on Investment(Roi)
                                                                Through Enhanced Customer Experience(Cx)</p>
                                                        </div>
                                                    </div>
                                                    <div class="slide">
                                                        <div class="card float">
                                                            <div class="img-box">
                                                                <img src="{{ asset('frontend/images/podcast.jpg') }}"
                                                                    class="aboutImageSlide">
                                                            </div>
                                                            <h6 class="black-color text-capitalize mt-3">Giving you the
                                                                proffessional guidance and expert tools</h6>
                                                            <p class="mt-3 main-color">Increasing Return on Investment(Roi)
                                                                Through Enhanced Customer Experience(Cx)</p>
                                                        </div>
                                                    </div>
                                                    <div class="slide">
                                                        <div class="card float">
                                                            <div class="img-box">
                                                                <img src="{{ asset('frontend/images/podcast.jpg') }}"
                                                                    class="aboutImageSlide">
                                                            </div>
                                                            <h6 class="black-color text-capitalize mt-3">Giving you the
                                                                proffessional guidance and expert tools</h6>
                                                            <p class="mt-3 main-color">Increasing Return on Investment(Roi)
                                                                Through Enhanced Customer Experience(Cx)</p>
                                                        </div>
                                                    </div>
                                                    <div class="slide">
                                                        <div class="card float">
                                                            <div class="img-box">
                                                                <img src="{{ asset('frontend/images/podcast.jpg') }}"
                                                                    class="aboutImageSlide">
                                                            </div>
                                                            <h6 class="black-color text-capitalize mt-3">Giving you the
                                                                proffessional guidance and expert tools</h6>
                                                            <p class="mt-3 main-color">Increasing Return on Investment(Roi)
                                                                Through Enhanced Customer Experience(Cx)</p>
                                                        </div>
                                                    </div>
                                                    <div class="slide">
                                                        <div class="card float">
                                                            <div class="img-box">
                                                                <img src="{{ asset('frontend/images/podcast.jpg') }}"
                                                                    class="aboutImageSlide">
                                                            </div>
                                                            <h6 class="black-color text-capitalize mt-3">Giving you the
                                                                proffessional guidance and expert tools</h6>
                                                            <p class="mt-3 main-color">Increasing Return on Investment(Roi)
                                                                Through Enhanced Customer Experience(Cx)</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
