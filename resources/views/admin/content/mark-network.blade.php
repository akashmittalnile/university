@extends('layouts.admin.app')
@push('css')
<link rel="stylesheet" href="{{ assets('admin/css/edit-podcast.css') }}" />
@endpush
@section('content')
<!-- Main -->
<main class="main-container dashboard">
    <div class="main-title d-flex align-items-center">
        <div class="page-title d-flex align-items-center">

            <h3 class="font-weight-bold black-color">Mark Network</h3>
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
                        <!-- <a href="{{ route('admin.manage.testimonial') }}"><button class="btn common-btn top-btn me-4">Manage Testimonials</button></a>
                        <a href="{{ route('admin.manage.affiliate-badges') }}"><button class="btn common-btn top-btn me-4">Manage Affiliate Badges</button></a> -->
                    </div>
                    <div class="about-us">
                        <form action="{{ route('admin.markNetwork.save') }}" method="post" enctype="multipart/form-data" id="create_form">
                            @csrf
                            <div class="edit-ebook">
                                <input type="hidden" id="redirect_url" value="{{ route('admin.markNetwork') }}">
                                <div class="common-card">
                                    <div class="row align-items-center">
                                        <h6 class="mb-3 main-color">Section 1</h6>
                                        <div class="border-bottom row">
                                            <div class="col-md-6">
                                                <div class="mb-3 field_error">
                                                    <label for="sec1_title" class="form-label black-color f-600">Enter Title</label>
                                                    <input type="text" name="sec1_title" class="form-control" id="sec1_title" value="{{ $data['sec1_title'] ?? '' }}" aria-describedby="sec1_title" placeholder="Enter Title">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="imageInput" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name1">
                                                                @if(isset($data['sec1_image']))
                                                                {{ $data['sec1_image'] ?? "" }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span>
                                                            <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" name="sec1_image" accept="image/png, image/jpg, image/jpeg" id="imageInput1" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="mb-3 field_error">
                                                        <label for="sec1_sub_title" class="form-label black-color f-600">Enter Sub-Title</label>
                                                        <textarea name="sec1_sub_title" class="form-control" id="sec1_sub_title" aria-describedby="sec1_sub_title" placeholder="Enter Sub-Title" cols="30" rows="3">{{ $data['sec1_sub_title'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h6 class="my-3 main-color">Section 2</h6>
                                        <div class="border-bottom row">
                                            <div class="col-md-6">
                                                <div class="mb-3 field_error">
                                                    <label for="sec2_title" class="form-label black-color f-600">Enter Title</label>
                                                    <input type="text" name="sec2_title" class="form-control" id="sec2_title" value="{{ $data['sec2_title'] ?? '' }}" aria-describedby="sec2_title" placeholder="Enter Title">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="imageInput" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name2">
                                                                @if(isset($data['sec2_image']))
                                                                {{ $data['sec2_image'] ?? "" }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span>
                                                            <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" name="sec2_image" accept="image/png, image/jpg, image/jpeg" id="imageInput2" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="mb-3 field_error">
                                                        <label for="sec2_sub_title" class="form-label black-color f-600">Enter Sub-Title</label>
                                                        <textarea name="sec2_sub_title" class="form-control" id="sec2_sub_title" aria-describedby="sec2_sub_title" placeholder="Enter Sub-Title" cols="30" rows="3">{{ $data['sec2_sub_title'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h6 class="my-3 main-color">Section 3</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3 field_error">
                                                    <label for="sec3_title" class="form-label black-color f-600">Enter Title</label>
                                                    <input type="text" name="sec3_title" class="form-control" id="sec3_title" value="{{ $data['sec3_title'] ?? '' }}" aria-describedby="sec3_title" placeholder="Enter Title">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="imageInput" class="form-label black-color f-600">Upload Background Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name3">
                                                                @if(isset($data['sec3_image']))
                                                                {{ $data['sec3_image'] ?? "" }}
                                                                @else
                                                                Upload Background Image
                                                                @endif
                                                            </span>
                                                            <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" name="sec3_image" accept="image/png, image/jpg, image/jpeg" id="imageInput3" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="mb-3 field_error">
                                                        <label for="sec3_sub_title" class="form-label black-color f-600">Enter Sub-Title</label>
                                                        <textarea name="sec3_sub_title" class="form-control" id="sec3_sub_title" aria-describedby="sec3_sub_title" placeholder="Enter Sub-Title" cols="30" rows="3">{{ $data['sec3_sub_title'] ?? '' }}</textarea>
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
                sec1_title: {
                    required: true,
                },
                sec1_sub_title: {
                    required: true,
                },
                @if(!isset($data['sec1_image']))
                sec1_image: {
                    required: true,
                    filesize: 5
                },
                @else
                sec1_image: {
                    filesize: 5
                },
                @endif
                sec2_title: {
                    required: true,
                },
                sec2_sub_title: {
                    required: true,
                },
                @if(!isset($data['sec2_image']))
                sec2_image: {
                    required: true,
                    filesize: 5
                },
                @else
                sec2_image: {
                    filesize: 5
                },
                @endif
                sec3_title: {
                    required: true,
                },
                sec3_sub_title: {
                    required: true,
                },
                @if(!isset($data['sec3_image']))
                sec3_image: {
                    required: true,
                    filesize: 5
                },
                @else
                sec3_image: {
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

    document.getElementById('imageInput1').addEventListener('change', function(event) {
        const fileInput = event.target;
        if (fileInput.files.length > 0) {
            const selectedFile = fileInput.files[0];
            // Display the audio image
            const objectURL = URL.createObjectURL(selectedFile);
            $("#image_name1").text(selectedFile.name);
        }
    });
    document.getElementById('imageInput2').addEventListener('change', function(event) {
        const fileInput = event.target;
        if (fileInput.files.length > 0) {
            const selectedFile = fileInput.files[0];
            // Display the audio image
            const objectURL = URL.createObjectURL(selectedFile);
            $("#image_name2").text(selectedFile.name);
        }
    });
    document.getElementById('imageInput3').addEventListener('change', function(event) {
        const fileInput = event.target;
        if (fileInput.files.length > 0) {
            const selectedFile = fileInput.files[0];
            // Display the audio image
            const objectURL = URL.createObjectURL(selectedFile);
            $("#image_name3").text(selectedFile.name);
        }
    });
</script>
@endsection