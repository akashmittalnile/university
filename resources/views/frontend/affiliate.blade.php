@extends('layouts.frontend.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/about.css') }}">
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.1/owl.carousel.min.js"></script>
    <script src="{{ asset('frontend/js/about.js') }}"></script>
@endpush
@section('content')
    <section class="about-us">
        <div class="container">
            {!! $affiliate->value !!}
        </div>
    </section>
@endsection
