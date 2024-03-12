@extends('layouts.frontend.app')
@push('css')
<link rel="stylesheet" href="{{ assets('frontend/css/mark-burnet-foundation.css') }}">
@endpush
@section('content')
<section class="mark-burnet">
    <div class="container">
        <div class="sponser-partner">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="left-section">
                        <img src="{{ assets('uploads/content/'.$data['sec1_image']) }}" alt="image" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-section">
                        <h1 class="black-color head-1 mb-4">{{ $data['sec1_title'] ?? 'NA' }}</h1>
                    </div>
                </div>
            </div>
            <p class="text-color mt-md-5 mt-sm-2 text-justify">{{ $data['sec1_sub_title'] ?? 'NA' }}</p>
            <a href="{{ route('user.subscription') }}"><button class="btn common-btn mt-3">Join the Community<i class="bi bi-arrow-right ms-2"></i></button></a>
        </div>
        <div class="donate-support">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="left-section">
                        <div class="img-box">
                            <img src="{{ assets('uploads/content/'.$data['sec2_image']) }}" alt="image" class="img-fluid">
                        </div>
                        <!-- <img src="images/donate-support-2.jpg" alt="image" class="img-fluid img-2"> -->
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
    <div class="merch" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('public/uploads/content/{{$data['sec3_image']}}' )">
        <div class="container">
            <h1 class="white-color f-600 text-center mb-3">{{ $data['sec3_title'] ?? 'NA' }}</h1>
            <p class="white-color text-justify text-center">{{ $data['sec3_sub_title'] ?? 'NA' }}</p>
            <div class="text-center">
                @if(!isset(auth()->user()->id))
                    <a href="{{ route('signup') }}"><button class="btn common-btn mt-1 signup-btn">Sign Up</button></a>
                @endif
            </div>
            <div class="image-slider">
                <div class="parent">
                    <div class="carousel">
                        <div class="owl-carousel owl-theme pmoCarousel">
                            @forelse($product as $key => $value)
                            <div class="item">
                                <a href="{{ route('products') }}">
                                    <img src="{{ assets("uploads/products/".$value->image) }}" class="aboutImageSlide">
                                </a>
                            </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<script>
    $('.pmoCarousel').owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        dots: false,
        responsive:{
            0:{
                items:1
            },
            300:{
                items:2
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    });
</script>
@endpush