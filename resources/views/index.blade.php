@extends('layouts.frontend.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}">
@endpush
@section('content')
    <section class="banner" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('uploads/content/{{$data['banner_image']}}' )">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="left-section">
                        <h1 class="white-color f-600">{{ $data['banner_title'] ?? 'NA' }}</h1>
                        <!-- <p class="white-color mt-3 f-500 text-capitalize">We help you deliver them with confidence</p> -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-section">
                        <h5 class="text-capitalize white-color">{{ $data['banner_sub_title'] ?? 'NA' }}</h5>
                        @if(!isset(auth()->user()->id))
                        <a href="{{ route('signup') }}"><button class="btn common-btn mt-4">Sign Up</button></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(count($test) > 0)
    <section class="testimonials">
        <h1 class="mt-4 text-center f-600">Testimonials<b class="main-color"></b></h1>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="customers-testimonials" class="owl-carousel">

                        @forelse($test as $key => $val)
                        <div class="item">
                            <div class="shadow-effect">
                                <img style="margin: 0; max-width: 350px" class="img-circle img-fluid rounded"
                                    src="{{ asset('uploads/testimonial/'.$val->image) }}"
                                    alt="">
                                <h6 class="main-color mt-2 text-left">{{ $val->title ?? 'NA' }}</h6>
                                <p>{{ $val->description ?? 'NA' }}</p>
                                <hr class="main-color">
                                <h4 class="client-name black-color f-500"><i class="bi bi-dash-lg me-2 main-color"></i>{{ $val->designation ?? 'NA' }}</h4>
                            </div>
                        </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
            @if(isset(auth()->user()->id))
            <p class="text-center mt-3">Share Your Thoughts!</p>
            <div class="text-center">
                <a href="javascript:void(0)"><button data-bs-toggle="modal" data-bs-target="#review-modal" class="common-btn">Write a Review</button></a>
            </div>
            @endif
        </div>
    </section>
    @endif

    <section class="youtube">
        <div class="container">
            <p class="white-color text-center">{{ $data['you_title'] ?? 'NA' }}</p>
            <div class="youtube-video mt-4">
                <iframe src="{{ $data['you_link'] ?? 'https://www.youtube.com/embed/XV1cOGaZUq0?si=LMIXLag_k_VxIP1k' }}" title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
            </div>
        </div>
    </section>

    @if(count($badges) > 0)
    <section class="testimonial">
        <h1 class="mt-4 text-center f-600">Affiliate <b class="main-color"> Badges</b></h1>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="customers-testimonials1" class="owl-carousel">

                        @forelse($badges as $key => $val)
                        <div class="item">
                            <div class="shadow-effect" style="width: 350px; padding: 10px;">
                                <img style="margin: 0; max-width: 350px" class="img-circle img-fluid rounded"
                                    src="{{ asset('uploads/badges/'.$val->path) }}"
                                    alt="">
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

    <div class="modal fade" id="review-modal" tabindex="-1" aria-labelledby="review-modalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.review') }}" method="post" id="profile_form" enctype="multipart/form-data"> @csrf
                <div class="modal-body">
                    <h5 class="black-color text-center mb-3 f-600 letter-space"><b class="main-color">R</b>eview</h5>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput1" placeholder="Name" value="{{ auth()->user()->name ?? '' }}" name="name">
                        <label for="floatingInput1">Full Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput2" placeholder="Email" value="{{ auth()->user()->email ?? '' }}" name="email">
                        <label for="floatingInput2">Email address</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="edit-profile-cancel-btn" class="btn outline-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn common-btn">Update Details</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
