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
            {!! $network->value !!}
        </div>
    </section>
@endsection
