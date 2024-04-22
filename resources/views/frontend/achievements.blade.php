@extends('layouts.frontend.app')
@push('css')
<link rel="stylesheet" href="{{ assets('frontend/css/home.css') }}">
@endpush
@section('content')
<section class="testimonial">
    <h1 class="black-color head-1 mb-4 mt-5 text-center">Key <b class="main-color">Achievements</b></h1>
    <div class="container">
        <div class="row">
            @forelse($badges as $key => $val)
            <div class="col-sm-12">
                <div class="affiliate-badges-card mb-3">
                    <div class="affiliate-c-media">
                        <img src="{{ assets('uploads/badges/'.$val->path) }}" alt="">
                    </div>
                    <div class="affiliate-Badges-content">
                        <h6>{!! $val->title ?? '' !!}</h6>
                        <div>{!! $val->description ?? '' !!}</div>
                    </div>
                </div>
            </div>
         @empty
            @endforelse
            </div>

        </div>
    </div>
</section>
@endsection
@push('js')
<script>
    $('#customers-testimonials1').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        dots: false,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:1,
            },
            1000:{
                items:1,
            }
        }
    });
</script>
@endpush