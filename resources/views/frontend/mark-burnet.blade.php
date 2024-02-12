@extends('layouts.frontend.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/mark-burnet-foundation.css') }}">
@endpush
@section('content')
    <section class="mark-burnet">
        <div class="container">
            {!! $burnet->value !!}
        </div>
    </section>
@endsection
