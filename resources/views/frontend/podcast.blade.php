@extends('layouts.frontend.app')
@push('css')
<link rel="stylesheet" href="{{ assets('frontend/css/resources.css') }}">
@endpush
@section('content')
<style>
    .current-plan{background-color: #d81b1b;
    position: absolute;
    border-radius: 10px 0px 10px 0px;left: auto;right: 0;
    margin-top: -13px;
    padding: 5px 10px;
    z-index: 9;}
    .current-plan p{color: #ffffff;font-size: 14px;}
    .current-div{position: relative;}
    .current-plan p{margin: 0;padding: 0;}
</style>
<section class="resources">
    <div class="resourse-banner">
        <div class="resources-box common-shadow">
            <h1 class="white-color head-1 mb-4 text-center">Podcasts</h1>
            <p class="text-center white-color mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam laoreet lectus ac cursus accumsan. Donec malesuada dignissim mi, sed pellentesque ante laoreet sit amet. Duis scelerisque, mi eget lobortis condimentum, quam metus faucibus felis, at dignissim nibh lectus tincidunt odio. Donec nec ante facilisis, tempus ante vel, gravida nunc.</p>
        </div>
    </div>
    <div class="podcast-contents">
        <div class="container">
            <div class="row" id="list">
                @forelse($podcasts as $key => $val)
                <div class="col-md-3 mb-3 block current-div">
                    <div class="current-plan me-auto">
                        <p>{{ $val['plan_name'] ?? 'NA' }}</p>
                    </div>
                    <div class="card float">
                        <div class="img-box">
                            <img src="{{ assets("uploads/podcasts/".$val['thumbnail']) }}" alt="image" class="img-fluid">
                        </div>
                        <h5 class="black-color mt-3 text-capitalize">{{ $val['name'] ?? 'NA' }}</h5>
                        <ul class="mt-3">
                            <li class="text-capitalize">{!! $val['description'] !!}</li>
                        </ul>
                        @if(isset(auth()->user()->id))
                            @if($val['purchase'])
                                @if($val['file_type']=='1')
                                <a target="_blank" href="{{ assets("uploads/podcasts/".$val['audio_file']) }}"><button class="btn learn-more-btn">Listen <i class="bi bi-play-circle ms-2"></i></button></a>
                                @else
                                <a target="_blank" href="{{ route('view.podcast', encrypt_decrypt('encrypt', $val['id'])) }}"><button class="btn learn-more-btn">Listen <i class="bi bi-play-circle ms-2"></i></button></a>
                                @endif
                            @else
                            <a target="_blank" href="{{ route('user.subscription') }}"><button class="btn learn-more-btn">Subscribe</button></a>
                            @endif
                        @endif
                    </div>
                </div>
                @empty
                @endforelse
            </div>
            @if(count($podcasts)>3)
            <div class="text-center mt-4">
                <a href="javascript:void(0)" id="loadMore"><button class="btn common-btn">Load More<i class="bi bi-arrow-down ms-3"></i></button></a>
                <a href="javascript:void(0)" class="d-none" id="showLess"><button class="btn common-btn">Show Less<i class="bi bi-arrow-up ms-3"></i></button></a>
            </div>
            @endif
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        let len = $(".block").length;
        $(".block").slice(3, len).hide(); 
        if ($(".block:hidden").length != 0) { 
            $("#loadMore").show(); 
        } 
        $("#loadMore").on("click", function (e) { 
            e.preventDefault(); 
            let hidelen = $(".block:hidden").length
            $(".block:hidden").slice(0, hidelen).slideDown(); 
            $("#showLess").removeClass('d-none'); 
            $(this).addClass('d-none');
        });
        $("#showLess").on("click", function (e) { 
            e.preventDefault(); 
            $(".block").slice(3, len).slideUp(); 
            $("#loadMore").removeClass('d-none'); 
            $(this).addClass('d-none'); 
        });
    });
</script>
@endsection