@extends('layouts.admin.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/resources.css') }}" />
@endpush
@push('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.3.2/ckeditor.js"></script>
    <script>
        CKEDITOR.replace("post_text", {
            language: "en",
            uiColor: "#dddddd",
            height: 500,
            resize_dir: 'vertical'
        });
        CKEDITOR.instances['post_text'].on('change', function() { 
            let value = CKEDITOR.instances['post_text'].getData().trim();
            if(value!=undefined && value!=null && value!=''){
                $(".cke_1.cke_chrome").attr("style", "border: 1px solid #3eda3f !important;")
            } else $(".cke_1.cke_chrome").attr("style", "border: 1px solid red !important;")
        });
    </script>
    <script src="https://cdn.ckeditor.com/4.23.0-lts/standard/ckeditor.js"></script>
@endpush
@section('content')
    <!-- Main -->
    <main class="main-container dashboard">
        <div class="main-title d-flex align-items-center">
            <div class="page-title d-flex align-items-center">
                
                <h3 class="font-weight-bold black-color">Resources</h3>
            </div>
            <div class="profile-link">
                <a href="#">
                    <div class="d-flex align-items-center">
                        <div class="profile-pic">
                            <img src="{{ isset(auth()->user()->profile) ? asset("uploads/profile/".auth()->user()->profile) : asset('admin/images/no-image.jpg')}}" alt="profile image" class="img-fluid me-2">
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
                            
                        </div>
                        <div class="about-us">
                            <form action="{{ route('admin.resources.save') }}" method="post" onsubmit="return validateForm()">
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
                                    <!-- <a href="javascript:void(0)"><button type="button" class="btn outline-btn">Cancel</button></a> -->
                                    <a href="javascript:void(0)"><button class="btn common-btn" type="submit">Submit</button></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    </main>
    <!-- End Main -->
    <script>
        const validateForm = () => {
            let val = CKEDITOR.instances['post_text'].getData().trim();
            if(val!=undefined && val!=null && val !=''){
                return true;
            }
            $(".cke_1.cke_chrome").attr("style", "border: 1px solid red !important;");
            return false;
        }
    </script>
@endsection
