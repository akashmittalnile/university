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
            {!! $about->value !!}
        </div>
    </section>
@endsection
