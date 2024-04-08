@extends('layouts.frontend.app')
@push('css')
<link rel="stylesheet" href="{{ assets('frontend/css/affiliate-links.css') }}">
<style>
    a{
        text-decoration: none !important;
    }
</style>
@endpush
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.1/owl.carousel.min.js"></script>
<script src="{{ assets('frontend/js/about.js') }}"></script>
<script>
    $('.pmoCarousel').owlCarousel({
        loop: false,
        margin: 10,
        nav: false,
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
@section('content')
<section class="affiliate-links">
    <div class="project-manager" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('public/uploads/content/{{$data['sec1_image']}}' ), background-repeat: no-repeat;"></div>
    <div class="join-community">
        <h1 class="black-color text-center text-capitalize">{{ $data['sec1_title'] ?? 'NA' }}</h1>
        <p class="black-color mt-4 text-center">{{ $data['sec1_sub_title'] ?? 'NA' }}</p>
        <div class="d-flex justify-content-center affiliate-buttons mt-5">
            <a href="{{ route('resources') }}"><button class="btn free-btn">Resources<i class="bi bi-arrow-right ms-3"></i></button></a>
            <a href="{{ route('user.subscription') }}"><button class="btn common-btn ms-md-3">Join the Community<i class="bi bi-arrow-right ms-3"></i></button></a>
        </div>
    </div>
    <div class="affiliate-images" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('public/uploads/content/{{$data['sec2_image']}}' ), background-repeat: no-repeat;">
        <div class="container">
            <h1 class="white-color text-center text-capitalize">{{ $data['sec2_title'] ?? 'NA' }}</h1>
            <p class="white-color text-justify">{{ $data['sec2_sub_title'] ?? 'NA' }}</p>
            @if(!isset(auth()->user()->id))
                <a href="{{ route('signup') }}"><button class="btn common-btn mt-1 signup-btn">Sign Up</button></a>
            @endif
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
    <div class="business-links">
        <div class="container">
            <h1 class="black-color text-center text-capitalize">Business <b class="main-color">Links</b></h1>
            <div class="business-link-contents">

                @forelse($link as $key => $value)
                <a href="{{ $value->links ?? 'NA' }}" target="_blank">
                    <div class="link-box mb-3 block">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="left-section">
                                    <img src="{{ assets('uploads/content/'.$value->image) }}" alt="image" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="right-section">
                                    <h4 class="black-color mb-4 f-600">{{ $value->title ?? 'NA' }}</h4>
                                    <p class="text-color">{{ $value->description ?? 'NA' }}</p>
                                    <br>
                                    <!-- <a href="{{ $value->links ?? 'NA' }}" target="_blank"><button class="btn learn-more-btn mt-2">Learn More<i class="bi bi-arrow-right ms-3"></i></button></a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @empty
                @endforelse

                @if(count($link)>3)
                <div class="text-center mt-4">
                    <a href="javascript:void(0)" id="loadMore"><button class="btn common-btn mt-md-5 mt-sm-2 load-more-btn">Load More<i class="bi bi-arrow-down ms-3"></i></button></a>
                    <a href="javascript:void(0)" class="d-none" id="showLess"><button class="btn common-btn">Show Less<i class="bi bi-arrow-up ms-3"></i></button></a>
                </div>
                @endif
                
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        let len = $(".block").length;
        $(".block").slice(3, len).hide();
        if ($(".block:hidden").length != 0) {
            $("#loadMore").show();
        }
        $("#loadMore").on("click", function(e) {
            e.preventDefault();
            let hidelen = $(".block:hidden").length
            $(".block:hidden").slice(0, hidelen).slideDown();
            $("#showLess").removeClass('d-none');
            $(this).addClass('d-none');
        });
        $("#showLess").on("click", function(e) {
            e.preventDefault();
            $(".block").slice(3, len).slideUp();
            $("#loadMore").removeClass('d-none');
            $(this).addClass('d-none');
        });
    });
</script>
@endsection