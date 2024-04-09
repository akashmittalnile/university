@extends('layouts.frontend.app')
@push('css')
    <link rel="stylesheet" href="{{ assets('frontend/css/home.css') }}">
    <link rel="stylesheet" href="{{ assets('frontend/css/mark-network.css') }}">
@endpush
@section('content')
    <section class="banner" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('public/uploads/content/{{$banner->image}}' ), background-repeat: no-repeat;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="left-section">
                        <h1 class="white-color f-600">{{ $banner->title ?? 'NA' }}</h1>
                        <!-- <p class="white-color mt-3 f-500 text-capitalize">We help you deliver them with confidence</p> -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-section">
                        <h5 class="text-capitalize white-color">{{ $banner->description ?? 'NA' }}</h5>
                        @if(!isset(auth()->user()->id))
                        <a href="{{ route('signup') }}"><button class="btn common-btn mt-4">Sign Up</button></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(count($test) > 0)
    <section class="testimonials">
        <h1 class="mt-4 text-center f-600">Testimonials<b class="main-color"></b></h1>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="customers-testimonials" class="owl-carousel">

                        @forelse($test as $key => $val)
                        <div class="item">
                            <div class="customers-testimonials-card">
                                <div class="customers-testimonials-image">
                                    <img src="{{ assets('uploads/testimonial/'.$val->image) }}"alt="">
                                </div>
                                <div class="customers-testimonials-content">
                                    <h6 class="main-color mt-2 text-left">{{ $val->title ?? 'NA' }}</h6>
                                    <p>{{ $val->description ?? 'NA' }}</p>
                                    <hr class="main-color">
                                    <h4 class="client-name black-color f-500"><i class="bi bi-dash-lg me-2 main-color"></i>{{ $val->designation ?? 'NA' }}</h4>
                                </div>
                            </div>
                        </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- <section class="youtube">
        <div class="container">
            <p class="white-color text-center">{{ $data['you_title'] ?? 'NA' }}</p>
            <div class="youtube-video mt-4">
                <iframe src="{{ $data['you_link'] ?? 'https://www.youtube.com/embed/XV1cOGaZUq0?si=LMIXLag_k_VxIP1k' }}" title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
            </div>
        </div>
    </section> -->

    @if(count($video) > 0)
    <section class="youtube">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="owl-carousel owl-theme pmoCarousel">
                        @forelse($video as $key => $val)
                        <div class="item">
                            <div class="shadow-effect">
                                <iframe src="{{ $val->link ?? 'https://www.youtube.com/embed/XV1cOGaZUq0?si=LMIXLag_k_VxIP1k' }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                <!-- <img style="margin: 0; max-width: 350px" class="img-circle img-fluid rounded"
                                    src="{{ assets('uploads/testimonial/'.$val->image) }}"
                                    alt=""> -->
                                <h6 class="main-color mt-2 text-left">{{ $val->title ?? 'NA' }}</h6>
                                <!-- <p>{{ $val->description ?? 'NA' }}</p>
                                <hr class="main-color">
                                <h4 class="client-name black-color f-500"><i class="bi bi-dash-lg me-2 main-color"></i>{{ $val->designation ?? 'NA' }}</h4> -->
                            </div>
                        </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if(count($badges) > 0)
    <section class="testimonial">
        <h1 class="mt-4 text-center f-600">Affiliate <b class="main-color"> Badges</b></h1>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="customers-testimonials1" class="owl-carousel">

                        @forelse($badges as $key => $val)
                        <div class="item">
                            <div class="affiliate-badges-card">
                                <div class="affiliate-c-media">
                                    <img 
                                        src="{{ assets('uploads/badges/'.$val->path) }}"
                                        alt="">
                                </div>
                                <div class="affiliate-Badges-media">
                                <h6 class="main-color mt-2 text-left">{{ $val->title ?? '' }}</h6>
                                <p>{{ $val->description ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                        @empty
                        @endforelse
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <div class="become-a-member" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('public/uploads/content/{{$community->image}}' ), background-repeat: no-repeat;">
        <div class="container">
            <h1 class="mb-4 white-color text-center">{{ $community->title ?? 'NA' }}</h1>
            <p class="text-center white-color">{{ $community->description ?? 'NA' }}</p>
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
                                    @if($item->price == 0)
                                    <div class="pricing-price" style="height: 14.5vh;">Free
                                        <span class="pricing-period"></span>
                                    </div>
                                    @else
                                        @if($key == 1)
                                        <div class="pricing-price">${{ number_format($item->price, 2, '.', ',') }}
                                            <span class="pricing-period">/ month</span>
                                        </div>
                                        @else
                                        <div class="pricing-price" style="height: 14.5vh;">${{ number_format($item->price, 2, '.', ',') }}
                                            <span class="pricing-period">/ month</span>
                                        </div>
                                        @endif
                                    @endif
                                    @if($key == 1)
                                    <h3 class="pricing-title text-center">Recommended Plan</h3>
                                    @endif
                                </div>

                                <p class="px-4">{{ $item->description ?? 'NA' }}</p>
                                
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
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="review-modal" tabindex="-1" aria-labelledby="review-modalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.review') }}" method="post" id="profile_form" enctype="multipart/form-data"> @csrf
                <div class="modal-body">
                    <h5 class="black-color text-center mb-3 f-600 letter-space"><b class="main-color">R</b>eview</h5>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput1" placeholder="Name" value="{{ auth()->user()->name ?? '' }}" name="name">
                        <label for="floatingInput1">Full Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput2" placeholder="Email" value="{{ auth()->user()->email ?? '' }}" name="email">
                        <label for="floatingInput2">Email address</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="edit-profile-cancel-btn" class="btn outline-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn common-btn">Update Details</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $('.pmoCarousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        dots: false,
        responsive:{
            1000:{
                items: 1
            },
        }
    });
</script>
@endpush
