@extends('layouts.frontend.app')
@push('css')
<link rel="stylesheet" href="{{ asset('frontend/css/resources.css') }}">
<style>
    .product-img {position: relative; height: 380px; width: 380px; margin: 0 auto; border-bottom: 12px solid #008d21a1; border-right: 12px solid #008d21a1; border-top: 1px solid #008d21a1; border-left: 1px solid #008d21a1;}
    .product-img img{position: absolute; bottom: 0; left: 0; right: 0; top: 0; margin: auto; max-width: 100%; max-height: 100%;}

</style>
@endpush
@section('content')
<section class="resources">
    <div class="resourse-banner">
        <div class="resources-box common-shadow">
            <h1 class="white-color head-1 mb-4 text-center">Products</h1>
            <p class="text-center white-color mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam laoreet lectus ac cursus accumsan. Donec malesuada dignissim mi, sed pellentesque ante laoreet sit amet. Duis scelerisque, mi eget lobortis condimentum, quam metus faucibus felis, at dignissim nibh lectus tincidunt odio. Donec nec ante facilisis, tempus ante vel, gravida nunc.</p>
        </div>
    </div>
    <div class="podcast-contents">
        <div class="container">
            <div class="row">
                @forelse($product as $val)
                <div class="col-md-4 mb-3 block ">
                    <div class="card float w-100">
                        <div class="product-img">
                            <img src="{{ asset("uploads/products/".$val->image) }}" alt="image" class="img-fluid">
                        </div>
                        <h5 class="black-color mt-3 text-capitalize">{{ $val->title ?? 'NA' }}</h5>
                        <h3 class="main-color f-600 mt-3">${{ $val->price ?? '0' }}</h3>

                    </div>
                </div>
                @empty
                @endforelse
            </div>
            @if(count($product)>3)
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