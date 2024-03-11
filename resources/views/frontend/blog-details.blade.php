@extends('layouts.frontend.app')
@push('css')
<link rel="stylesheet" href="{{ assets('frontend/css/blog.css') }}">
@endpush
@section('content')
<section class="blog-details">
    <div class="blog-banner">
        <div class="container">
            {!! $blog->description ?? 'NA' !!}
        </div>
    </div>
</section>
@endsection