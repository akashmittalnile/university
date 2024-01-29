@extends('layouts.admin.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/resources.css') }}" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.3.2/ckeditor.js"></script>
@endpush
@push('js')
    <script src="{{ asset('admin/js/text-editor.js') }}"></script>
@endpush
@section('content')
    <!-- Main -->
    <main class="main-container dashboard">
        <div class="main-title d-flex align-items-center">
            <div class="page-title d-flex align-items-center">
                <a href="manage-podcasts.html"><i class="bi bi-arrow-left-circle-fill main-color me-3"></i></a>
                <h3 class="font-weight-bold black-color">Manage Page Content</h3>
            </div>
            <div class="profile-link">
                <a href="#">
                    <div class="d-flex align-items-center">
                        <div class="profile-pic">
                            <img src="{{ isset(auth()->user()->profile) ? asset("uploads/profile/".auth()->user()->profile) : asset('admin/images/profile-image.jpg')}}" alt="profile image" class="img-fluid me-2">
                        </div>
                        <div class="button-link">
                            <a href="{{ route('admin.profile') }}" class="profile-name">{{auth()->user()->name ?? 'Admin Profile'}}<i
                                    class="bi bi-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-12">
                <div class="main-cards">
                    <div class="e-book-details">
                        <div class="d-flex align-items-center justify-content-end">
                            <a href="#"><button class="btn common-btn top-btn me-4">Manage Blogs</button></a>
                            <a href="#"><button class="btn outline-btn top-btn me-4">Manage News &
                                    Updates</button></a>
                            <p class="text-color">Home<i class="fa fa-angle-right ms-3 me-3"></i> Editors <i
                                    class="fa fa-angle-right ms-3 me-3"></i> <b class="main-color">Resources</b></p>
                        </div>
                        <div class="about-us">
                            <form action="{{ route('admin.resources.save') }}" method="post">
                                @csrf
                                <div class="wrapper">
                                    <div class="col-lg-12  p-0  page-main">
                                        <div class="new-post">
                                            <textarea id="post_text" class="post-area" name="data"> 
                                                {!! $content->value !!}
                                             </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <a href="javascript:void(0)"><button type="button" class="btn outline-btn">Cancel</button></a>
                                    <a href="javascript:void(0)"><button class="btn common-btn ms-3" type="submit">Submit</button></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    </main>
    <!-- End Main -->
@endsection
