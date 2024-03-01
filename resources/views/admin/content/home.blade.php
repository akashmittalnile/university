@extends('layouts.admin.app')
@push('css')
<link rel="stylesheet" href="{{ asset('admin/css/edit-podcast.css') }}" />
@endpush
@push('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.3.2/ckeditor.js"></script>
<script>
    CKEDITOR.replace("post_text", {
        uiColor: "#dddddd",
        height: 500,
        resize_dir: 'vertical'
    });
    CKEDITOR.instances['post_text'].on('change', function() {
        let value = CKEDITOR.instances['post_text'].getData().trim();
        if (value != undefined && value != null && value != '') {
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

            <h3 class="font-weight-bold black-color">Manage Home</h3>
        </div>
        <div class="profile-link">
            <a href="#">
                <div class="d-flex align-items-center">
                    <div class="profile-pic">
                        <img src="{{ isset(auth()->user()->profile) ? asset("uploads/profile/".auth()->user()->profile) : asset('admin/images/no-image.jpg')}}" alt="profile image" class="img-fluid me-2">
                    </div>
                    <div class="button-link">
                        <a href="{{ route('admin.profile') }}" class="profile-name">{{auth()->user()->name ?? 'Admin Profile'}}<i class="bi bi-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-12">
            <div class="main-cards">
                <div class="e-book-details">
                    <div class="d-flex align-items-center justify-content-end mb-3">
                        <a href="{{ route('admin.manage.testimonial') }}"><button class="btn common-btn top-btn me-4">Manage Testimonials</button></a>
                        <a href="{{ route('admin.affiliate.badges') }}"><button class="btn common-btn top-btn me-4">Manage Affiliate Badges</button></a>
                    </div>
                    <div class="about-us">
                        <form action="{{ route('admin.manage.home.save') }}" method="post" enctype="multipart/form-data" id="create_form">
                            @csrf
                            <div class="edit-ebook">
                                <input type="hidden" id="redirect_url" value="{{ route('admin.ebooks') }}">
                                <div class="common-card">
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <div class="mb-3 field_error">
                                                <label for="banner_title" class="form-label black-color f-600">Enter Banner Title</label>
                                                <input type="text" name="banner_title" class="form-control" id="banner_title" value="{{ $data['banner_title'] ?? '' }}" aria-describedby="banner_title" placeholder="Enter Banner Title">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <div class="mb-3 field_error">
                                                    <label for="banner_sub_title" class="form-label black-color f-600">Enter Banner Sub-Title</label>
                                                    <input type="text" name="banner_sub_title" class="form-control" id="banner_sub_title" value="{{ $data['banner_sub_title'] ?? '' }}" aria-describedby="banner_sub_title" placeholder="Enter Banner Sub-Title">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="imageInput" class="form-label black-color f-600">Upload Banner Background Image</label>
                                                <div class="file-upload d-flex align-items-center mb-3 field">
                                                    <div class="file btn black-color upload-btn">
                                                        <span id="image_name">
                                                            @if(isset($data['banner_image']))
                                                                {{ $data['banner_image'] ?? "" }}
                                                            @else
                                                                Upload Photos
                                                            @endif
                                                        </span> 
                                                        <i class="bi bi-file-image ms-2 main-color"></i>
                                                        <input type="file" name="banner_image" accept="image/png, image/jpg, image/jpeg" id="imageInput" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <div class="mb-3 field_error">
                                                    <label for="you_title" class="form-label black-color f-600">Enter Youtube Title</label>
                                                    <input type="text" name="you_title" class="form-control" id="you_title" value="{{ $data['you_title'] ?? '' }}" aria-describedby="you_title" placeholder="Enter Youtube Title">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <div class="mb-3 field_error">
                                                    <label for="you_link" class="form-label black-color f-600">Enter Youtube Video Link</label>
                                                    <input type="url" name="you_link" class="form-control" id="you_link" value="{{ $data['you_link'] ?? '' }}" aria-describedby="you_link" placeholder="Enter Youtube Video Link">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex mt-3 mb-4">
                                    <!-- <a href="{{ route('admin.ebooks') }}"><button type="button" class="outline-btn" type="button">Cancel</button></a> -->
                                    <a><button class="common-btn ms-2">Submit</button></a>
                                </div>
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
        if (val != undefined && val != null && val != '') {
            return true;
        }
        $(".cke_1.cke_chrome").attr("style", "border: 1px solid red !important;");
        return false;
    }

    document.getElementById('imageInput').addEventListener('change', function(event) {
        const fileInput = event.target;
        const imageDisplay = document.getElementById('imageDisplay');

        if (fileInput.files.length > 0) {
            const selectedFile = fileInput.files[0];

            // Display the audio image
            const objectURL = URL.createObjectURL(selectedFile);
            $("#image_name").text(selectedFile.name);
            // Set the audio source to the selected file
            imageDisplay.src = objectURL;
        }
    });
</script>
@endsection