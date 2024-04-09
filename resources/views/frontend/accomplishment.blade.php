@extends('layouts.frontend.app')
@push('css')
    <link rel="stylesheet" href="{{ assets('frontend/css/accomplishment-gallery.css') }}">
@endpush
@section('content')
    <section class="accomplishment-gallery">
        <h1 class="black-color head-1 mb-4 text-center">Accomplishment <b class="main-color">Gallery</b></h1>
        <div id="flexbox">

            <div class="row">
                @forelse($gallery as $item)
                <div class="img-box col-lg-3 mb-2">
                    <img src="{{ assets("uploads/gallery/$item->path") }}" alt="Image" width="100%"
                        class="gallery-image" style="object-position: center; object-fit: cover; height: 350px;" >
                    <div class="overlay">
                        <div class="text">
                            <!-- <p>In a fully didgital world ECONO ProjectEX provides effective consultative/advisory change
                                management, managed and technical implimentation services tailored to address the entire
                                breadth of your business needs and success.</p> -->
                            <div class="text-center">
                                <a target="_blank" href="{{ assets("uploads/gallery/$item->path") }}"><button class="view-btn common-btn"><i class="bi bi-eye me-2"></i>View
                                        Photo</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                @endforelse
            </div>

        </div>
    </section>
@endsection
