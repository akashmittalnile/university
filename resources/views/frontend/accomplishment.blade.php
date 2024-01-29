@extends('layouts.frontend.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/accomplishment-gallery.css') }}">
@endpush
@section('content')
    <section class="accomplishment-gallery">
        <h1 class="black-color head-1 mb-4 text-center">Accomplishment <b class="main-color">Gallery</b></h1>
        <div id="flexbox">
            <div class="column">
                <div class="img-box">
                    <img src="{{ asset('frontend/images/gallery-1.jpg') }}" alt="Image" width="100%"
                        class="gallery-image">
                    <div class="overlay">
                        <div class="text">
                            <p>In a fully didgital world ECONO ProjectEX provides effective consultative/advisory change
                                management, managed and technical implimentation services tailored to address the entire
                                breadth of your business needs and success.</p>
                            <div class="text-center">
                                <a href="#"><button class="view-btn common-btn"><i class="bi bi-eye me-2"></i>View
                                        Photo</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="img-box">
                    <img src="{{ asset('frontend/images/gallery-2.jpg') }}" alt="Image" width="100%">
                    <div class="overlay">
                        <div class="text">
                            <p>In a fully didgital world ECONO ProjectEX provides effective consultative/advisory change
                                management, managed and technical implimentation services tailored to address the entire
                                breadth of your business needs and success.</p>
                            <div class="text-center">
                                <a href="#"><button class="view-btn common-btn"><i class="bi bi-eye me-2"></i>View
                                        Photo</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="img-box">
                    <img src="{{ asset('frontend/images/gallery-1.jpg') }}" alt="Image" width="100%"
                        class="gallery-image">
                    <div class="overlay">
                        <div class="text">
                            <p>In a fully didgital world ECONO ProjectEX provides effective consultative/advisory change
                                management, managed and technical implimentation services tailored to address the entire
                                breadth of your business needs and success.</p>
                            <div class="text-center">
                                <a href="#"><button class="view-btn common-btn"><i class="bi bi-eye me-2"></i>View
                                        Photo</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="img-box">
                    <img src="{{ asset('frontend/images/gallery-2.jpg') }}" alt="Image" width="100%">
                    <div class="overlay">
                        <div class="text">
                            <p>In a fully didgital world ECONO ProjectEX provides effective consultative/advisory change
                                management, managed and technical implimentation services tailored to address the entire
                                breadth of your business needs and success.</p>
                            <div class="text-center">
                                <a href="#"><button class="view-btn common-btn"><i class="bi bi-eye me-2"></i>View
                                        Photo</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="img-box">
                    <img src="{{ asset('frontend/images/gallery-1.jpg') }}" alt="Image" width="100%"
                        class="gallery-image">
                    <div class="overlay">
                        <div class="text">
                            <p>In a fully didgital world ECONO ProjectEX provides effective consultative/advisory change
                                management, managed and technical implimentation services tailored to address the entire
                                breadth of your business needs and success.</p>
                            <div class="text-center">
                                <a href="#"><button class="view-btn common-btn"><i class="bi bi-eye me-2"></i>View
                                        Photo</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="img-box">
                    <img src="{{ asset('frontend/images/gallery-2.jpg') }}" alt="Image" width="100%">
                    <div class="overlay">
                        <div class="text">
                            <p>In a fully didgital world ECONO ProjectEX provides effective consultative/advisory change
                                management, managed and technical implimentation services tailored to address the entire
                                breadth of your business needs and success.</p>
                            <div class="text-center">
                                <a href="#"><button class="view-btn common-btn"><i class="bi bi-eye me-2"></i>View
                                        Photo</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="img-box">
                    <img src="{{ asset('frontend/images/gallery-1.jpg') }}" alt="Image" width="100%"
                        class="gallery-image">
                    <div class="overlay">
                        <div class="text">
                            <p>In a fully didgital world ECONO ProjectEX provides effective consultative/advisory change
                                management, managed and technical implimentation services tailored to address the entire
                                breadth of your business needs and success.</p>
                            <div class="text-center">
                                <a href="#"><button class="view-btn common-btn"><i class="bi bi-eye me-2"></i>View
                                        Photo</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="img-box">
                    <img src="{{ asset('frontend/images/gallery-2.jpg') }}" alt="Image" width="100%">
                    <div class="overlay">
                        <div class="text">
                            <p>In a fully didgital world ECONO ProjectEX provides effective consultative/advisory change
                                management, managed and technical implimentation services tailored to address the entire
                                breadth of your business needs and success.</p>
                            <div class="text-center">
                                <a href="#"><button class="view-btn common-btn"><i class="bi bi-eye me-2"></i>View
                                        Photo</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
