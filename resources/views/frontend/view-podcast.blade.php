@extends('layouts.frontend.app')
@push('css')
<link rel="stylesheet" href="{{ asset('frontend/css/resources.css') }}">
@endpush
@section('content')
<section class="resources">
    <div class="resourse-banner">
        <div class="resources-box common-shadow">
            <h1 class="white-color head-1 mb-4 text-center">{!! $podcast->name ?? 'NA' !!}</h1>
            <p class="text-center white-color mt-4">{!! $podcast->description ?? 'NA' !!}</p>
        </div>
    </div>
    <div class="podcast-contents">
        <div class="container d-flex justify-content-center">
            {!! $podcast->audio_file !!}
        </div>
    </div>
</section>
@endsection