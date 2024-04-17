@extends('layouts.frontend.app')
@push('css')
<link rel="stylesheet" href="{{ assets('frontend/css/about.css') }}">
@endpush
@push('js')
<script src="{{ assets('frontend/js/about.js') }}"></script>
@endpush
@section('content')
<section class="about-us">
    <div class="container">
        <div class="vision-purpose">
            <div class="row align-items-center mb-3">
                <div class="col-md-4">
                    <div class="left-section">
                        <h1 class="text-md-end black-color">
                            {{ $data1->title ?? 'NA' }}
                        </h1>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="right-section common-shadow">
                        <img src="{{ isset($data1->image1) ? assets('uploads/about/'.($data1->image1 ?? null)) : assets('frontend/images/no-image.jpg') }}" alt="image" class="img-fluid" />
                    </div>
                </div>
            </div>
            <p class="my-story-descr">
                {!! $data1->description ?? 'NA' !!}
            </p>
        </div>
        <div class="my-story">
            <div class="row">
                <div class="col-md-6">
                    <div class="left-section">
                        <img src="{{ isset($data2->image1) ? assets('uploads/about/'.($data2->image1 ?? null)) : assets('frontend/images/no-image.jpg') }}" class="img-fluid" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="heading-title">
                        <h1>{{ $data2->title ?? 'NA' }}</h1>
                    </div>
                    <p class="my-story-descr">
                        {!! $data2->description ?? 'NA' !!}
                    </p>
                </div>
            </div>
        </div>
    </div>

    @if(count($team) > 0)
    <section class="team-members-section">
        <h1>Team Members</h1>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="TeamMembers" class="owl-carousel">

                        @forelse($team as $key => $val) 
                        <div class="item">
                            <div class="team-members-card">

                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="team-members-card-image">
                                            <img src="{{ assets('uploads/team/'.$val->image) }}"alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="team-members-card-content">
                                            <div class="team-quotes">"</div>
                                            <div class="team-members-card-content-innner">
                                            <p>" {!! $val->company_name ?? 'NA' !!} "</p>
                                            <h4>{{ $val->name ?? 'NA' }}</h4>
                                            <h6><i class="bi bi-dash-lg me-2"></i>{{ $val->designation ?? 'NA' }}</h6></div>
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
    </section>
    @endif

    @if(isset($data3->image1)) <div class="what-we-do" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('public/uploads/about/{{($data3->image1 ?? null)}}' ); background-repeat: no-repeat; background-size: cover;"> @else <div class="what-we-do" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('public/frontend/images/conference.jpg'); background-repeat: no-repeat; background-size: cover;"> @endif
        <div class="container">
            <h1 class="text-center white-color">
                {{ $data3->title ?? 'NA' }}
            </h1>
            <div class="what-we-do-box common-shadow">
                <p class="white-color sub-text text-center">{!! $data3->description ?? 'NA' !!}</p>
            </div>
        </div>
    </div>

    <div class="how-we-do">
        <div class="container">
            <h1 class="text-center black-color">
                {{ $how->title ?? 'NA' }}
            </h1>
            <div class="row">
                <div class="col-md-6 bottom-margin">
                    <div class="how-we-do-box common-shadow h-100 float">
                        <img src="{{ isset($how1->image1) ? assets('uploads/about/'.($how1->image1 ?? null)) : assets('frontend/images/no-image.jpg') }}" alt="image" class="img-fluid" />
                        <h3 class="text-capitalize main-color mb-3">
                            {{ $how1->title ?? 'NA' }}
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
                            {{ $how2->title ?? 'NA' }}
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
                        <h5 class="f-600 mt-3">{{ $how3->title ?? 'NA' }}</h5>
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
                            {{ $how4->title ?? 'NA' }}
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
                        <h5 class="f-600 mt-3">{{ $how5->title ?? 'NA' }}</h5>
                        <p class="mt-3">
                            {!! $how5->description ?? 'NA' !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="why-you-select">
        <div class="container">
            <h1 class="black-color head-1 mb-4">
                {{ $data4->title ?? 'NA' }}
            </h1>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="left-section">
                        <img src="{{ isset($data4->image1) ? assets('uploads/about/'.($data4->image1 ?? null)) : assets('frontend/images/no-image.jpg') }}" alt="image" class="img-fluid" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="why-you-select-box common-shadow">
                        <p>
                            {!! $data4->description ?? 'NA' !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="how-we-offer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="left-section">
                        <img src="{{ isset($data5->image1) ? assets('uploads/about/'.($data5->image1 ?? null)) : assets('frontend/images/no-image.jpg') }}" alt="image" class="img-fluid" />
                    </div>
                </div>
                <div class="col-md-6">
                    <h1 class="black-color head-1 mb-4">
                        {{ $data5->title ?? 'NA' }}
                    </h1>
                    <div class="right-section">
                        <img src="{{ isset($data5->image2) ? assets('uploads/about/'.($data5->image2 ?? null)) : assets('frontend/images/no-image.jpg') }}" alt="image" class="img-fluid" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="how-we-offer-box mt-md-4 mt-sm-0">
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
            <div class="who-is-it-for-contents">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="left-section">
                            <img src="{{ isset($data6->image1) ? assets('uploads/about/'.($data6->image1 ?? null)) : assets('frontend/images/no-image.jpg') }}" alt="image" class="img-fluid" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="right-section">
                            <h1 class="black-color head-1 mb-4">
                                {{ $data6->title ?? 'NA' }}
                            </h1>
                            <p class="global-descr  text-justify">
                                {!! $data6->description ?? 'NA' !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="global-impact">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="left-section">
                        <h1 class="black-color text-md-end head-1 mb-0 pb-0">
                            {{ $data7->title ?? 'NA' }}
                        </h1>
                        <p class="global-descr text-md-end">
                            {!! $data7->description ?? 'NA' !!}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-section">
                        <img src="{{ isset($data7->image1) ? assets('uploads/about/'.($data7->image1 ?? null)) : assets('frontend/images/no-image.jpg') }}" alt="image" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="why-you-select">
        <div class="container">
            <h1 class="black-color head-1 mb-4">
                {{ $data8->title ?? 'NA' }}
            </h1>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="left-section">
                        <img src="{{ isset($data8->image1) ? assets('uploads/about/'.($data8->image1 ?? null)) : assets('frontend/images/no-image.jpg') }}" alt="image" class="img-fluid" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="why-you-select-box common-shadow">
                        <p class="global-descr">
                            {!! $data8->description ?? 'NA' !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="global-impact">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="left-section">
                        <h1 class="heading-title-text text-end">
                            {{ $data9->title ?? 'NA' }}
                        </h1>
                        <p class="global-descr text-md-end">
                            {!! $data9->description ?? 'NA' !!}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-section">
                        <img src="{{ isset($data9->image1) ? assets('uploads/about/'.($data9->image1 ?? null)) : assets('frontend/images/no-image.jpg') }}" alt="image" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        $("#customers-testimonials1").owlCarousel({
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