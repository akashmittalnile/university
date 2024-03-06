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
                        <h1 class="mb-4 white-color">{{ $data['sec1_title'] ?? 'NA' }}</h1>
                        <p class="white-color text-justify">{{ $data['sec1_sub_title'] ?? 'NA' }}</p>
                    </div>
                </div>
                <div class="col-md-8 col-position-2">
                    <div class="right-section" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('uploads/content/{{$data['sec1_image']}}' )">

                    </div>
                </div>
            </div>
        </div>
        <div class="community">
            <div class="row align-items-center">
                <div class="col-md-6 ">
                    <div class="left-section">
                        <div class="img-box">
                            <img src="{{ asset('uploads/content/'.$data['sec2_image']) }}" alt="image" class="img-fluid">
                        </div>
                        <!-- <img src="images/community-2.jpg" alt="image" class="img-fluid img-2"> -->
                    </div>
                </div>
                <div class="col-md-6">
                    <h1 class="mb-4 black-color">{{ $data['sec2_title'] ?? 'NA' }}</h1>
                    <p class="text-color text-justify">{{ $data['sec2_sub_title'] ?? 'NA' }}</p>
                    <a href="{{ route('user.subscription') }}"><button class="btn common-btn mt-4">Join The Community</button></a>
                </div>
            </div>
        </div>
    </div>
    <div class="become-a-member" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('uploads/content/{{$data['sec3_image']}}' )">
        <div class="container">
            <h1 class="mb-4 white-color text-center">{{ $data['sec3_title'] ?? 'NA' }}</h1>
            <p class="text-center white-color">{{ $data['sec3_sub_title'] ?? 'NA' }}</p>
        </div>
    </div>
    <div class="container">
        <div class="membership-cards">
            <div class="header">
                <div class="inner-header flex">
                    <section>
                        <div class="pricing pricing-palden">

                            @forelse($plans as $key => $item)
                            <div class="pricing-item features-item float ja-animate" data-animation="move-from-bottom" data-delay="item-2" style="min-height: 497px;">
                                <div class="pricing-deco">
                                    <svg class="pricing-deco-img" enable-background="new 0 0 300 100" height="100px" id="Layer_1" preserveAspectRatio="none" version="1.1" viewBox="0 0 300 100" width="300px" x="0px" xml:space="preserve" y="0px">
                                        <path class="deco-layer deco-layer--1" d="M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z" fill="#FFFFFF" opacity="0.6"></path>
                                        <path class="deco-layer deco-layer--2" d="M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z" fill="#FFFFFF" opacity="0.6"></path>
                                        <path class="deco-layer deco-layer--3" d="M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716H42.401L43.415,98.342z" fill="#FFFFFF" opacity="0.7"></path>
                                        <path class="deco-layer deco-layer--4" d="M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z" fill="#FFFFFF"></path>
                                    </svg>
                                    <div class="pricing-price">${{ number_format($item->price, 2, '.', ',') }}
                                        <span class="pricing-period">/ month</span>
                                    </div>
                                    <h3 class="pricing-title text-center">Recommended Plan</h3>
                                </div>
                                <ul class="pricing-feature-list">
                                    @foreach ($item->description as $text)
                                    <li class="pricing-feature text-capitalize">{{ $text }}</li>
                                    @endforeach
                                </ul>
                                <a class="mb-4" href="{{ route('user.subscription') }}"><button class="btn buy-btn btn-green">Buy Now</button></a>
                            </div>
                            @empty
                            @endforelse

                            <!-- <div class="pricing-item features-item float ja-animate pricing__item--featured" data-animation="move-from-bottom" data-delay="item-1" style="min-height: 497px;">
                                <div class="pricing-deco middle-card">
                                    <svg class="pricing-deco-img" enable-background="new 0 0 300 100" height="100px" id="Layer_1" preserveAspectRatio="none" version="1.1" viewBox="0 0 300 100" width="300px" x="0px" xml:space="preserve" y="0px">
                                        <path class="deco-layer deco-layer--1" d="M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z" fill="#FFFFFF" opacity="0.6"></path>
                                        <path class="deco-layer deco-layer--2" d="M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z" fill="#FFFFFF" opacity="0.6"></path>
                                        <path class="deco-layer deco-layer--3" d="M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716H42.401L43.415,98.342z" fill="#FFFFFF" opacity="0.7"></path>
                                        <path class="deco-layer deco-layer--4" d="M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z" fill="#FFFFFF"></path>
                                    </svg>
                                    <div class="pricing-price">$350.00
                                        <span class="pricing-period">/ month</span>
                                    </div>
                                    <h3 class="pricing-title text-center">Recommended Plan</h3>
                                </div>
                                <ul class="pricing-feature-list">
                                    <li class="pricing-feature text-capitalize">All podcatsts - unlimited access</li>
                                    <li class="pricing-feature text-capitalize">Accomplishment Gallery - limited access</li>
                                    <li class="pricing-feature text-capitalize">E-Book - limited access</li>
                                </ul>
                                <a href=""><button class="btn buy-btn btn-yellow">Buy Now</button></a>
                            </div>
                            <div class="pricing-item features-item float ja-animate" data-animation="move-from-bottom" data-delay="item-2" style="min-height: 497px;">
                                <div class="pricing-deco">
                                    <svg class="pricing-deco-img" enable-background="new 0 0 300 100" height="100px" id="Layer_1" preserveAspectRatio="none" version="1.1" viewBox="0 0 300 100" width="300px" x="0px" xml:space="preserve" y="0px">
                                        <path class="deco-layer deco-layer--1" d="M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z" fill="#FFFFFF" opacity="0.6"></path>
                                        <path class="deco-layer deco-layer--2" d="M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z" fill="#FFFFFF" opacity="0.6"></path>
                                        <path class="deco-layer deco-layer--3" d="M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716H42.401L43.415,98.342z" fill="#FFFFFF" opacity="0.7"></path>
                                        <path class="deco-layer deco-layer--4" d="M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z" fill="#FFFFFF"></path>
                                    </svg>
                                    <div class="pricing-price bottom-margin">$450.00
                                        <span class="pricing-period">/ month</span>
                                    </div>
                                </div>
                                <ul class="pricing-feature-list">
                                    <li class="pricing-feature text-capitalize">All podcatsts - unlimited access</li>
                                    <li class="pricing-feature text-capitalize">Accomplishment Gallery - limited access</li>
                                    <li class="pricing-feature text-capitalize">E-Book - limited access</li>
                                </ul>
                                <a href=""><button class="btn buy-btn btn-green">Buy Now</button></a>
                            </div> -->
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection