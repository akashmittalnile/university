@extends('layouts.frontend.app')
@push('css')
<link rel="stylesheet" href="{{ assets('frontend/css/about.css') }}">
@endpush
@push('js')
<script src="{{ assets('frontend/js/about.js') }}"></script>
@endpush
@section('content')

<div class="visionpurpose-section">
    <div class="container">
         <div class="vision-purpose">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="vision-purpose-content">
                        <h1>{!! $data1->title ?? 'NA' !!}</h1>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="vision-purpose-media">
                        <img src="{{ isset($data1->image1) ? assets('uploads/about/'.($data1->image1 ?? null)) : assets('frontend/images/no-image.jpg') }}" alt="image" class="img-fluid" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="vision-purpose-content">
                        <p class="my-story-descr">{!! $data1->description ?? 'NA' !!}</p>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
</div>

<div class="supporters-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="supporters-content">
                    <h1>
                        {!! $data9->title ?? 'NA' !!}
                    </h1>
                    <p>
                        {!! $data9->description ?? 'NA' !!}
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="supporters-image">
                    <img src="{{ isset($data9->image1) ? assets('uploads/about/'.($data9->image1 ?? null)) : assets('frontend/images/no-image.jpg') }}" alt="image" class="img-fluid" />
                </div>
            </div>
        </div>
    </div>
</div>

<div class="story-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="story-heading-info">
                    <h1>{!! $data2->title ?? 'NA' !!}</h1>
                </div>
            </div>
            <!-- <div class="col-md-12">
                <div class="story-image-info">
                    <img src="{{ isset($data2->image1) ? assets('uploads/about/'.($data2->image1 ?? null)) : assets('frontend/images/no-image.jpg') }}" />
                </div>
            </div> -->

            <div class="col-md-12">
                <div class="story-content-info">
                    <p class="my-story-descr"> {!! $data2->description ?? 'NA' !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@if(count($info) > 0)
<div class="info-section">
    <div class="container">
        <div class="row">
            @forelse($info as $key => $val) 
            <div class="col-3">
                <div class="team-members-card">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="team-members-card-imag">
                                <img width="100" src="{{ assets('uploads/info/'.$val->image) }}"alt="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="team-members-card-content">
                                <div class="team-quotes">"</div>
                                <div class="team-members-card-content-innner">
                                    <p>{!! $val->description ?? 'NA' !!}</p>
                                    <h4>{!! $val->title ?? 'NA' !!}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            @endforelse
        </div>
    </div>
</div>
@endif
@if(count($team) > 0)
<div class="team-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="team-heading-info">
                    <h1>Team Members</h1>
                </div>
            </div>
            <div class="col-md-12">
                <div class="team-carousel-info">
                    <div id="TeamMembers" class="owl-carousel">
                        @forelse($team as $key => $val) 
                        <div class="item">
                            <div class="team-members-card">

                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <div class="team-members-card-image">
                                            <img src="{{ assets('uploads/team/'.$val->image) }}"alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="team-members-card-content">
                                            <div class="team-quotes">"</div>
                                            <div class="team-members-card-content-innner">
                                                <p>" {!! $val->company_name ?? 'NA' !!} "</p>
                                                <h4>{!! $val->name ?? 'NA' !!}</h4>
                                                <h6><i class="bi bi-dash-lg me-2"></i>{!! $val->designation ?? 'NA' !!}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if(isset($data3->image1))
<div class="whatwedo-section" style="background:url('public/uploads/about/{{($data3->image1 ?? null)}}' ); background-repeat: no-repeat; background-size: cover;"> 
@else 
<div class="whatwedo-section" style="background: url('public/frontend/images/conference.jpg'); background-repeat: no-repeat; background-size: cover;">
@endif
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="whatwedo-heading-info">
                    <h1>{!! $data3->title ?? 'NA' !!}</h1>
                </div>
            </div>
            <div class="col-md-12">
                <div class="whatwedo-content-info">
                    {!! $data3->description ?? 'NA' !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="how-we-do">
    <div class="container">
        <div class="how-we-do-heading">
            <h1>
                {!! $how->title ?? 'NA' !!}
            </h1>
        </div>
        <div class="row">
            <div class="col-md-6 bottom-margin">
                <div class="how-we-do-box common-shadow h-100 float">
                    <img src="{{ isset($how1->image1) ? assets('uploads/about/'.($how1->image1 ?? null)) : assets('frontend/images/no-image.jpg') }}" alt="image" class="img-fluid" />
                    <h3 class="text-capitalize main-color mb-3">
                        {!! $how1->title ?? 'NA' !!}
                    </h3>
                    <p class="black-color">
                        {!! $how1->description ?? 'NA' !!}
                    </p>
                </div>
            </div>
            <div class="col-md-6 bottom-margin">
                <div class="how-we-do-box common-shadow h-100 float">
                    <img src="{{ isset($how2->image1) ? assets('uploads/about/'.($how2->image1 ?? null)) : assets('frontend/images/no-image.jpg') }}" alt="image" class="img-fluid" />
                    <h3 class="text-capitalize main-color mb-3">
                        {!! $how2->title ?? 'NA' !!}
                    </h3>
                    <p class="black-color">
                        {!! $how2->description ?? 'NA' !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

 <div class="how-we-do-cards">
        <div class="container">
            <div class="row">
                <div class="col-md-4 bottom-margin">
                    <div class="card common-shadow float">
                        <div class="img-bg">
                            <img src="{{ isset($how3->image1) ? assets('uploads/about/'.($how3->image1 ?? null)) : assets('frontend/images/no-image.jpg') }}" alt="image" class="img-fluid" />
                        </div>
                        <h5 class="f-600 mt-3">{!! $how3->title ?? 'NA' !!}</h5>
                        <p class="mt-3">
                            {!! $how3->description ?? 'NA' !!}
                        </p>
                    </div>
                </div>
                <div class="col-md-4 bottom-margin">
                    <div class="card common-shadow float">
                        <div class="img-bg">
                            <img src="{{ isset($how4->image1) ? assets('uploads/about/'.($how4->image1 ?? null)) : assets('frontend/images/no-image.jpg') }}" alt="image" class="img-fluid" />
                        </div>
                        <h5 class="f-600 mt-3">
                            {!! $how4->title ?? 'NA' !!}
                        </h5>
                        <p class="mt-3">
                            {!! $how4->description ?? 'NA' !!}
                        </p>
                    </div>
                </div>
                <div class="col-md-4 bottom-margin">
                    <div class="card common-shadow float">
                        <div class="img-bg">
                            <img src="{{ isset($how5->image1) ? assets('uploads/about/'.($how5->image1 ?? null)) : assets('frontend/images/no-image.jpg') }}" alt="image" class="img-fluid" />
                        </div>
                        <h5 class="f-600 mt-3">{!! $how5->title ?? 'NA' !!}</h5>
                        <p class="mt-3">
                            {!! $how5->description ?? 'NA' !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="whyyouselect-section">
        <div class="container">
            <div class="whyyouselect-heading">
                <h1>
                    {!! $data4->title ?? 'NA' !!}
                </h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="whyyouselect-image-info">
                        <img src="{{ isset($data4->image1) ? assets('uploads/about/'.($data4->image1 ?? null)) : assets('frontend/images/no-image.jpg') }}" alt="image" class="img-fluid" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="whyyouselect-content-info">
                        <p>
                            {!! $data4->description ?? 'NA' !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <div class="howweoffer-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="left-section">
                        <img src="{{ isset($data5->image1) ? assets('uploads/about/'.($data5->image1 ?? null)) : assets('frontend/images/no-image.jpg') }}" alt="image" class="img-fluid" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="howweoffer-heading">
                        <h1>
                             {!! $data5->title ?? 'NA' !!}
                        </h1>
                    </div>
                    <div class="right-section">
                        <img src="{{ isset($data5->image2) ? assets('uploads/about/'.($data5->image2 ?? null)) : assets('frontend/images/no-image.jpg') }}" alt="image" class="img-fluid" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="howweoffer-content">
                        <p>
                            {!! $data5->description ?? 'NA' !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="who-is-it-for">
        <div class="container">
            <div class="whoisitfor-box">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="whoisitfor-image">
                            <img src="{{ isset($data6->image1) ? assets('uploads/about/'.($data6->image1 ?? null)) : assets('frontend/images/no-image.jpg') }}" alt="image" class="img-fluid" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="whoisitfor-content">
                            <h1>{!! $data6->title ?? 'NA' !!}</h1>
                            <p class="global-descr  text-justify">
                                {!! $data6->description ?? 'NA' !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="globalimpact-section">
        <div class="container">
            <div class="globalimpact-heading">
                <h1 >
                    {!! $data7->title ?? 'NA' !!}
                </h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="globalimpact-image">
                        <img src="{{ isset($data7->image1) ? assets('uploads/about/'.($data7->image1 ?? null)) : assets('frontend/images/no-image.jpg') }}" alt="image" class="img-fluid" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="globalimpact-content">
                        <p class="global-descr text-md-end">
                            {!! $data7->description ?? 'NA' !!}
                        </p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <div class="partners-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="partners-image-info">
                        <img src="{{ isset($data8->image1) ? assets('uploads/about/'.($data8->image1 ?? null)) : assets('frontend/images/no-image.jpg') }}" alt="image" class="img-fluid" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="wpartners-content-info">
                        <h1>{!! $data8->title ?? 'NA' !!}</h1>
                        <p> {!! $data8->description ?? 'NA' !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@if(count($award) > 0)
<div class="team-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="team-heading-info">
                    <h1 class="text-center">{!! $data10->title ?? 'NA' !!}</h1>
                    <div class="text-center">{!! $data10->title ?? 'NA' !!}</div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="team-carousel-info">
                    <div id="awards" class="owl-carousel">
                        @forelse($award as $key => $val) 
                        <div class="item">
                            <div class="team-members-card">

                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <div class="team-members-card-image">
                                            <img src="{{ assets('uploads/award/'.$val->image) }}"alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif


    

<script>
    $(document).ready(function(){
        $("#awards").owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                500: {
                    items: 2
                },
                1000: {
                    items: 3
                },
            }
        });
        $("#TeamMembers").owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            responsive: {
                1000: {
                    items: 1
                },
            }
        });
    })
</script>
@endsection