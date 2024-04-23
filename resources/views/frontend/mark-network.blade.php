@extends('layouts.frontend.app')
@push('css')
<link rel="stylesheet" href="{{ assets('frontend/css/mark-network.css') }}">
<style>
    .stripe-button-el {
        opacity: 1;
    }
    .current-plan{background-color: #d81b1b;
        position: absolute;
        border-radius: 10px 0px 10px 0px;left: auto;right: 0;
        margin-top: -13px;
        padding: 5px 10px;
        z-index: 9;}
    .current-plan p{color: #ffffff;font-size: 14px;}
    .current-div{position: relative;}
    .current-plan p{margin: 0;padding: 0;}

.mark-membership-section{position: relative; padding: 2rem 0;}
.community-section{position: relative; padding: 2rem 0;background: linear-gradient(180deg, #ebf6eb, rgba(255, 255, 255, 0) 100%); }



    .mark-mentorship-image {
    background-color: #3fab40;
    padding: 0px 0px 20px 20px;
    height: 500px;
    width: 100%;
    position: relative;
}

.mark-mentorship-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.mark-mentorship-content h1 {
    font-weight: bold;
    margin: 0 0 1rem 0;
    padding: 0;
    text-align: center;
}

</style>
@endpush
@section('content')
<section class="marknetwork">
    <div class="mark-membership-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mark-mentorship-image" >
                        <img src="{{ isset($data1->image1) ? assets('uploads/mark-network/'.$data1->image1) : assets('frontend/images/mentor.jpg') }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mark-mentorship-content">
                        <h1>{!! $data1->title ?? 'NA' !!}</h1>
                        <p>{!! $data1->description ?? 'NA' !!}</p>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
    <div class="community-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 ">
                    <div class="left-section">
                        <div class="img-box">
                            <img src="{{ isset($data2->image1) ? assets('uploads/mark-network/'.$data2->image1) : assets('frontend/images/membership-2.jpg') }}" alt="image" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h1 class="mb-4 black-color">{!! $data2->title ?? 'NA' !!}</h1>
                    <p class="text-color text-justify">{!! $data2->description ?? 'NA' !!}</p>
                    <a href="{{ route('user.subscription') }}"><button class="btn common-btn mt-4">Join The Community</button></a>
                </div>
            </div>
        </div>
    </div>
    @if(isset($data3->image1))
    <div class="become-a-member" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 05)), url('public/uploads/mark-network/{{$data3->image1}}' ); background-repeat: no-repeat; background-size: cover;">
    @else
    <div class="become-a-member" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 05)), url('public/frontend/images/merch-bg.jpg' ); background-repeat: no-repeat; background-size: cover;">
    @endif
        <div class="container">
            <h1 class="mb-4 white-color text-center">{!! $data3->title ?? 'NA' !!}</h1>
            <div class="text-center white-color">{!! $data3->description ?? 'NA' !!}</div>
        </div>
    </div>
    <div class="container">
        <div class="membership-cards">
            <div class="header">
                <div class="inner-header flex">
                    <section>
                        <div class="pricing pricing-palden">

                            @forelse($plans as $key => $item)
                            <div class="pricing-item features-item float ja-animate current-div" data-animation="move-from-bottom" data-delay="item-2" style="min-height: 497px;">
                                @if($item->current_plan)
                                <div class="current-plan me-auto">
                                    <p>Current Plan</p>
                                </div>
                                @endif
                                <div class="pricing-deco">
                                    <svg class="pricing-deco-img" enable-background="new 0 0 300 100" height="100px" id="Layer_1" preserveAspectRatio="none" version="1.1" viewBox="0 0 300 100" width="300px" x="0px" xml:space="preserve" y="0px">
                                        <path class="deco-layer deco-layer--1" d="M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z" fill="#FFFFFF" opacity="0.6"></path>
                                        <path class="deco-layer deco-layer--2" d="M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z" fill="#FFFFFF" opacity="0.6"></path>
                                        <path class="deco-layer deco-layer--3" d="M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716H42.401L43.415,98.342z" fill="#FFFFFF" opacity="0.7"></path>
                                        <path class="deco-layer deco-layer--4" d="M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z" fill="#FFFFFF"></path>
                                    </svg>
                                    <div class="pricing-price" style="font-weight: 100; font-size: 1.5rem;">{{ $item->name ?? 'NA' }}</div>
                                    @if($item->price == 0)
                                    <div class="pricing-price" style="height: 14.5vh;">Free
                                        <span class="pricing-period"></span>
                                    </div>
                                    @else
                                        @if($key == 1)
                                        <div class="pricing-price">${{ number_format($item->price, 2, '.', ',') }}
                                            <span class="pricing-period">/ {{ $item->type ?? 'month' }}</span>
                                        </div>
                                        @else
                                        <div class="pricing-price" style="height: 14.5vh;">${{ number_format($item->price, 2, '.', ',') }}
                                            <span class="pricing-period">/ {{ $item->type ?? 'month' }}</span>
                                        </div>
                                        @endif
                                    @endif
                                    @if($key == 1)
                                    <h3 class="pricing-title text-center">Recommended Plan</h3>
                                    @endif
                                </div>

                                <p class="px-4">{!! $item->description ?? 'NA' !!}</p>
                                
                                @if($item->current_plan)
                                <a class="mb-4" href="javascript:void(0)"><button class="btn buy-btn btn-green">Subscribed</button></a>
                                @else
                                <a class="mb-4" href="{{ route('user.subscription') }}"><button class="btn buy-btn btn-green">
                                    @if($item->price == 0)  
                                        Free
                                    @else
                                        @if(isset(auth()->user()->id) && $item->current_plan_price <= $item->price)
                                            Upgrade
                                        @elseif(isset(auth()->user()->id) && $item->current_plan_price >= $item->price)
                                            Downgrade
                                        @else
                                            Buy Now
                                        @endif
                                    @endif
                                </button></a>
                                @endif
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