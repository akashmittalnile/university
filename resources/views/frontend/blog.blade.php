@extends('layouts.frontend.app')
@push('css')
<link rel="stylesheet" href="{{ asset('frontend/css/blogs-card.css') }}">
@endpush
@section('content')
<section class="resources">
    <div class="resourse-banner">
        <div class="resources-box common-shadow">
            <h1 class="white-color head-1 mb-4 text-center">Welcome to Our Blog</h1>
            <p class="text-center white-color mt-4">Welcome to our blog, where we share insights, stories, and updates on a variety of topics. Explore our collection of articles to discover valuable information, tips, and engaging content. Whether you're looking for inspiration, guidance, or simply want to stay informed, our blog is here for you. </p>
        </div>
    </div>
    <div class="blogs">
        <div class="container">
            <div class="row">
                @forelse($blog as $val)
                <div class="col-md-4 mb-3 block">
                    <div class="card float">
                        <div class="img-box">
                            @if(isset($val->image))
                            <img src="{{ asset("uploads/blogs/".$val->image) }}" alt="image" class="img-fluid">
                            @else
                            <img src="{{ asset('frontend/images/gallery-1.jpg') }}" alt="image" class="img-fluid">
                            @endif
                        </div>
                        <h5 class="black-color text-capitalize mt-3">{{ $val->title ?? 'NA' }}</h5>
                        <p class="mt-3 text-color text-capitalize m-0 p-0">{!! $val->description !!}</p>
                        @if(isset(auth()->user()->id))
                        <a target="_blank" href="{{ $val->links }}"><button class="btn learn-more-btn">Read me <i class="bi bi-arrow-right ms-2"></i></button></a>
                        @endif
                    </div>
                </div>
                @empty
                @endforelse
            </div>
            @if(count($blog)>3)
            <div class="text-center mt-4">
                <a href="javascript:void(0)" id="loadMore"><button class="btn common-btn">Load More<i class="bi bi-arrow-down ms-3"></i></button></a>
                <a href="javascript:void(0)" class="d-none" id="showLess"><button class="btn common-btn">Show Less<i class="bi bi-arrow-up ms-3"></i></button></a>
            </div>
            @endif
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