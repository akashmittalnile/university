@extends('layouts.admin.app')
@push('css')
<link rel="stylesheet" href="{{ assets('admin/css/edit-podcast.css') }}" />
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
                        <img src="{{ isset(auth()->user()->profile) ? assets("uploads/profile/".auth()->user()->profile) : assets('admin/images/no-image.jpg')}}" alt="profile image" class="img-fluid me-2">
                    </div>
                    <div class="button-link">
                        <a href="{{ route('admin.profile') }}" class="profile-name">{{auth()->user()->name ?? 'Admin Profile'}}<i class="bi bi-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-cards">
                <div class="e-book-details">
                    <div class="d-flex align-items-center justify-content-end mb-3">
                        <a href="{{ route('admin.manage.testimonial') }}"><button class="btn common-btn top-btn me-4">Manage Testimonials</button></a>
                        <a href="{{ route('admin.manage.videos') }}"><button class="btn common-btn top-btn me-4">Manage Youtube Videos</button></a>
                        <a href="{{ route('admin.manage.affiliate-badges') }}"><button class="btn common-btn top-btn me-4">Manage Affiliate Badges</button></a>
                    </div>
                    <div class="about-us">
                        <form action="{{ route('admin.manage.home.save') }}" method="post" enctype="multipart/form-data" id="create_form">
                            @csrf
                            <div class="edit-ebook">
                                <input type="hidden" id="redirect_url" value="{{ route('admin.manage.home') }}">
                                <div class="common-card">
                                    <div class="row align-items-center">
                                        <h6 class="mb-3 main-color">Section 1</h6>
                                        <div class="border-bottom row">
                                            <div class="col-md-6">
                                                <div class="mb-3 field_error">
                                                    <label for="banner_title" class="form-label black-color f-600">Enter Banner Title</label>
                                                    <input type="text" name="banner_title" class="form-control" id="banner_title" value="{{ $data['banner_title'] ?? '' }}" aria-describedby="banner_title" placeholder="Enter Banner Title">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
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
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="mb-3 field_error">
                                                        <label for="banner_sub_title" class="form-label black-color f-600">Enter Banner Sub-Title</label>

                                                        <textarea name="banner_sub_title" class="form-control" id="banner_sub_title" aria-describedby="banner_sub_title" placeholder="Enter Banner Sub-Title" cols="30" rows="5">{{ $data['banner_sub_title'] ?? '' }}</textarea>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <h6 class="my-3 main-color">Section 2</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3 field_error">
                                                    <label for="community_title" class="form-label black-color f-600">Enter Community Title</label>
                                                    <input type="text" name="community_title" class="form-control" id="community_title" value="{{ $data['community_title'] ?? '' }}" aria-describedby="community_title" placeholder="Enter Community Title">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="imageInput2" class="form-label black-color f-600">Upload Community Background Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name2">
                                                                @if(isset($data['community_image']))
                                                                {{ $data['community_image'] ?? "" }}
                                                                @else
                                                                Upload Background Photos
                                                                @endif
                                                            </span>
                                                            <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" name="community_image" accept="image/png, image/jpg, image/jpeg" id="imageInput2" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="mb-3 field_error">
                                                        <label for="community_sub_title" class="form-label black-color f-600">Enter Community Sub-Title</label>

                                                        <textarea name="community_sub_title" class="form-control" id="community_sub_title" aria-describedby="community_sub_title" placeholder="Enter Community Sub-Title" cols="30" rows="5">{{ $data['community_sub_title'] ?? '' }}</textarea>

                                                    </div>
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
    </div>

</main>
<!-- End Main -->
<script>
    $(document).ready(function() {
        $.validator.addMethod('filesize', function (value, element, param) {
            return this.optional(element) || (element.files[0].size <= param * 1000000)
        }, 'File size must be less than {0} MB');
        $('#create_form').validate({
            rules: {
                banner_title: {
                    required: true,
                },
                banner_sub_title: {
                    required: true,
                },
                @if(!isset($data['banner_image']))
                banner_image: {
                    required: true,
                    filesize: 5
                },
                @else
                banner_image: {
                    filesize: 5
                },
                @endif
                community_title: {
                    required: true,
                },
                community_sub_title: {
                    required: true,
                },
                @if(!isset($data['community_image']))
                community_image: {
                    required: true,
                    filesize: 5
                },
                @else
                community_image: {
                    filesize: 5
                },
                @endif
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                // error.addClass("invalid-feedback");
                element.addClass("border border-danger");
                element.closest(".file").addClass("border border-danger");
            },
            highlight: function(element, errorClass, validClass) {
                $('.please-wait').hide();

            },
            unhighlight: function(element, errorClass, validClass) {
                // $(element).removeClass("text-danger");
                $(element).removeClass("border border-danger");
                $(element).closest(".file").removeClass("border border-danger");
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                form.submit();
            }
        });
    });

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
        if (fileInput.files.length > 0) {
            const selectedFile = fileInput.files[0];
            $("#image_name").text(selectedFile.name);
        }
    });
    document.getElementById('imageInput2').addEventListener('change', function(event) {
        const fileInput = event.target;
        if (fileInput.files.length > 0) {
            const selectedFile = fileInput.files[0];
            $("#image_name2").text(selectedFile.name);
        }
    });
</script>
@endsection