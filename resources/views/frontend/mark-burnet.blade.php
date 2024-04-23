@extends('layouts.frontend.app')
@push('css')
<link rel="stylesheet" href="{{ assets('frontend/css/mark-burnet-foundation.css') }}">
@endpush
@section('content')

<div class="sponserpartner-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="sponserpartner-image-info">
                    <img src="{{ isset($data1->image1) ? assets('uploads/foundation/'.$data1->image1) : assets('frontend/images/podcasts.jpg') }}" alt="image" class="img-fluid">
                </div>
            </div>
            <div class="col-md-12">
                <div class="sponserpartner-title-info">
                    <h1>{!! $data1->title ?? 'NA' !!}</h1>
                </div>
                <div class="sponserpartner-content-info">
                    <p class="text-color text-justify">{!! $data1->description ?? 'NA' !!}</p>
                    <a href="{{ route('user.subscription') }}"><button class="btn common-btn mt-3">Join the Community<i class="bi bi-arrow-right ms-2"></i></button></a>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="donatesupport-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="left-section">
                    <div class="img-box">
                        <img src="{{ isset($data2->image1) ? assets('uploads/foundation/'.$data2->image1) : assets('frontend/images/donate-support-1.jpg') }}" alt="image" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h1 class="mb-4 black-color">{!! $data2->title ?? 'NA' !!}</h1>
                <p class="text-color text-justify">{!! $data2->description ?? 'NA' !!}</p>
                <a href="{{ route('user.subscription') }}"><button class="btn common-btn mt-4 join-butn">Join The Community</button></a>
            </div>
        </div>
    </div>
</div>

@if(isset($data3->image1))
<div class="merch" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('public/uploads/foundation/{{$data3->image1}}' ); background-repeat: no-repeat; background-size: cover;">
@else
<div class="merch" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('public/frontend/images/p-bg.jpg' ); background-repeat: no-repeat; background-size: cover;">
@endif
    <div class="container">
        <h1 class="white-color f-600 text-center mb-3">{!! $data3->title ?? 'NA' !!}</h1>
        <div class="white-color text-justify text-center">{!! $data3->description ?? 'NA' !!}</div>
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
                            <div class="aboutImageSlide">
                                <a href="{{ route('products') }}">
                                    <img src="{{ assets("uploads/products/".$value->image) }}">
                                </a>
                            </div>
                        </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')
<script>
    $('.pmoCarousel').owlCarousel({
        loop: false,
        margin: 10,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            300: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });
</script>
@endpush