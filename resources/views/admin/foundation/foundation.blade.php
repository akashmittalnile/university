@extends('layouts.admin.app')
@section('heading', 'Mark Burnett Foundation')
@push('css')
<link rel="stylesheet" href="{{ assets('admin/css/admin-home.css') }}" />
<link rel="stylesheet" href="{{ assets('admin/css/edit-podcast.css') }}" />
<link rel="stylesheet" href="{{ assets('frontend/css/mark-burnet-foundation.css') }}">
<style>
    .stripe-button-el {
        opacity: 1;
    }

    .current-plan {
        background-color: #d81b1b;
        position: absolute;
        border-radius: 10px 0px 10px 0px;
        left: auto;
        right: 0;
        margin-top: -13px;
        padding: 5px 10px;
        z-index: 9;
    }

    .current-plan p {
        color: #ffffff;
        font-size: 14px;
    }

    .current-div {
        position: relative;
    }

    .current-plan p {
        margin: 0;
        padding: 0;
    }

    .mark-membership-section {
        position: relative;
        padding: 2rem 0;
    }

    .community-section {
        position: relative;
        padding: 2rem 0;
        background: linear-gradient(180deg, #ebf6eb, rgba(255, 255, 255, 0) 100%);
    }

    .mark-mentorship-image {
        background-color: #3fab40;
        padding: 0px 0px 20px 20px;
        height: 500px;
        width: 100%;
        position: relative;
    }

    .mark-mentorship-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .mark-mentorship-content h1 {
        font-weight: bold;
        margin: 0 0 1rem 0;
        padding: 0;
        text-align: center;
    }
</style>
@endpush
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css">
<!-- Main -->


<div class="pmu-content-list mt-5">
    <div class="pmu-content">
        <div class="row">
            <div class="">
                <input type="hidden" name="type_mode" id="type_mode" value="" />
                <div class="col-md-12">
                    <div class="pmu-courses-form-section pmu-addcourse-form">
                        <div class="pmu-courses-form column edit-ebook">

                            <!-- Become a partner or sponser -->
                            <div class="edit-pmu-form-item">
                                <div class="edit-pmu-heading">
                                    <div class="edit-pmu-text d-flex flex-row align-items-center">
                                        <div class="edit-pmu-text-title mx-2">
                                            <h3 data-bs-toggle="collapse" data-bs-target="#collapsePartner">
                                                <span class="edit-pmu-collapse-icon"><i class="bi bi-card-image"></i></span> {!! $data1->title ?? 'Become a Partner or Sponser' !!} <i class="bi bi-chevron-down"></i>
                                            </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)" class="preview" data-name="partner"><button class="common-btn ms-2"> Preview </button></a>
                                    </div>
                                </div>
                                <div class="edit-pmu-section collapse-course-form collapse" id="collapsePartner">
                                    <form action="{{ route('admin.markBurnett.partner.save') }}" method="post" enctype="multipart/form-data" id="partner_form">@csrf
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="mb-3 field_error">
                                                    <label for="makeMeSummerTitle1" class="form-label black-color f-600">Enter Title</label>
                                                    <textarea name="partner_title" id="makeMeSummerTitle1" cols="30" rows="10">{{ $data1->title ?? '' }}</textarea>
                                                    @if(isset($data1->id))
                                                    <input type="hidden" name="partner_id" value="{{ encrypt_decrypt('encrypt', $data1->id) }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="@if(isset($data1->image1)) col-md-3 @else col-md-4 @endif">
                                                <div class="mb-3">
                                                    <label for="imageInput{{ $data1->id ?? 324 }}" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field flex-column">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name{{ $data1->id ?? 324 }}">
                                                                @if(isset($data1->image1))
                                                                {{ $data1->image1 }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span> <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" @if(!isset($data1->image1)) required @endif data-num="{{ $data1->id ?? 324 }}" name="partner_image" accept="image/png, image/jpg, image/jpeg" id="imageInput{{ $data1->id ?? 324 }}" />
                                                        </div>
                                                        <div class="alert alert-danger mt-2 text-dark" role="alert">
                                                            Please upload an image greater than or equal to recommended size (1348 X 720)
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($data1->image1))
                                            <div class="col-md-1">
                                                <a target="_blank" href="{{ assets('uploads/foundation/'.$data1->image1) }}"><img width="50" style="margin-top: 33.5%;" src="{{ assets('admin/images/gallery.png') }}" alt=""></a>
                                            </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="mb-3 field_error">
                                                    <label for="makeMeSummerNote1" class="form-label black-color f-600">Enter Description</label>
                                                    <textarea class="post-area form-control" required id="makeMeSummerNote1" name="partner_description" rows="3" placeholder="Enter Description">{{ $data1->description ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="d-flex mt-3 mb-4">
                                                <button type="submit" data-id="partner_form" class="common-btn ms-2">Update<i class="bi bi-floppy ms-2"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Donate and support -->
                            <div class="edit-pmu-form-item">
                                <div class="edit-pmu-heading">
                                    <div class="edit-pmu-text d-flex flex-row align-items-center">
                                        <div class="edit-pmu-text-title mx-2">
                                            <h3 data-bs-toggle="collapse" data-bs-target="#collapseDonate">
                                                <span class="edit-pmu-collapse-icon"><i class="bi bi-card-image"></i></span> {!! $data2->title ?? 'Donate & Support' !!} <i class="bi bi-chevron-down"></i>
                                            </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)" class="preview" data-name="donate"><button class="common-btn ms-2"> Preview </button></a>
                                    </div>
                                </div>
                                <div class="edit-pmu-section collapse-course-form collapse" id="collapseDonate">
                                    <form action="{{ route('admin.markBurnett.donate.save') }}" method="post" enctype="multipart/form-data" id="donate_form">@csrf
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="mb-3 field_error">
                                                    <label for="makeMeSummerTitle2" class="form-label black-color f-600">Enter Title</label>
                                                    <textarea name="donate_title" id="makeMeSummerTitle2" cols="30" rows="10">{{ $data2->title ?? '' }}</textarea>
                                                    @if(isset($data2->id))
                                                    <input type="hidden" name="donate_id" value="{{ encrypt_decrypt('encrypt', $data2->id) }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="@if(isset($data2->image1)) col-md-3 @else col-md-4 @endif">
                                                <div class="mb-3">
                                                    <label for="imageInput{{ $data2->id ?? 8546 }}" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field flex-column">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name{{ $data2->id ?? 8546 }}">
                                                                @if(isset($data2->image1))
                                                                {{ $data2->image1 }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span> <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" @if(!isset($data2->image1)) required @endif data-num="{{ $data2->id ?? 8546 }}" name="donate_image" accept="image/png, image/jpg, image/jpeg" id="imageInput{{ $data2->id ?? 8546 }}" />
                                                        </div>
                                                        <div class="alert alert-danger mt-2 text-dark" role="alert">
                                                            Please upload an image greater than or equal to recommended size (1348 X 720)
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($data2->image1))
                                            <div class="col-md-1">
                                                <a target="_blank" href="{{ assets('uploads/foundation/'.$data2->image1) }}"><img width="50" style="margin-top: 33.5%;" src="{{ assets('admin/images/gallery.png') }}" alt=""></a>
                                            </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="mb-3 field_error">
                                                    <label for="makeMeSummerNote2" class="form-label black-color f-600">Enter Description</label>
                                                    <textarea class="post-area form-control" required id="makeMeSummerNote2" name="donate_description" rows="3" placeholder="Enter Description">{{ $data2->description ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="d-flex mt-3 mb-4">
                                                <button type="submit" data-id="donate_form" class="common-btn ms-2">Update<i class="bi bi-floppy ms-2"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Products -->
                            <div class="edit-pmu-form-item">
                                <div class="edit-pmu-heading">
                                    <div class="edit-pmu-text d-flex flex-row align-items-center">
                                        <div class="edit-pmu-text-title mx-2">
                                            <h3 data-bs-toggle="collapse" data-bs-target="#collapseProduct">
                                                <span class="edit-pmu-collapse-icon"><i class="bi bi-card-image"></i></span> {!! $data3->title ?? 'Products' !!} <i class="bi bi-chevron-down"></i>
                                            </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)" class="preview" data-name="product"><button class="common-btn ms-2"> Preview </button></a>
                                    </div>
                                </div>
                                <div class="edit-pmu-section collapse-course-form collapse" id="collapseProduct">
                                    <form action="{{ route('admin.markBurnett.product.save') }}" method="post" enctype="multipart/form-data" id="product_form">@csrf
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="mb-3 field_error">
                                                    <label for="makeMeSummerTitle3" class="form-label black-color f-600">Enter Title</label>
                                                    <textarea name="product_title" id="makeMeSummerTitle2" cols="30" rows="10">{{ $data3->title ?? '' }}</textarea>
                                                    @if(isset($data3->id))
                                                    <input type="hidden" name="product_id" value="{{ encrypt_decrypt('encrypt', $data3->id) }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="@if(isset($data3->image1)) col-md-3 @else col-md-4 @endif">
                                                <div class="mb-3">
                                                    <label for="imageInput{{ $data3->id ?? 452 }}" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field flex-column">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name{{ $data3->id ?? 452 }}">
                                                                @if(isset($data3->image1))
                                                                {{ $data3->image1 }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span> <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" @if(!isset($data3->image1)) required @endif data-num="{{ $data3->id ?? 452 }}" name="product_image" accept="image/png, image/jpg, image/jpeg" id="imageInput{{ $data3->id ?? 452 }}" />
                                                        </div>
                                                        <div class="alert alert-danger mt-2 text-dark" role="alert">
                                                            Please upload an image greater than or equal to recommended size (1348 X 720)
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($data3->image1))
                                            <div class="col-md-1">
                                                <a target="_blank" href="{{ assets('uploads/foundation/'.$data3->image1) }}"><img width="50" style="margin-top: 33.5%;" src="{{ assets('admin/images/gallery.png') }}" alt=""></a>
                                            </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="mb-3 field_error">
                                                    <label for="makeMeSummerNote2" class="form-label black-color f-600">Enter Description</label>
                                                    <textarea class="post-area form-control" required id="makeMeSummerNote3" name="product_description" rows="3" placeholder="Enter Description">{{ $data3->description ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="d-flex mt-3 mb-4">
                                                <button type="submit" data-id="product_form" class="common-btn ms-2">Update<i class="bi bi-floppy ms-2"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="review-modal" tabindex="-1" aria-labelledby="review-modalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" style="max-width: 85% !important;">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <div class="sponserpartner-section partner d-none">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="sponserpartner-image-info">
                                    <img src="{{ isset($data1->image1) ? assets('uploads/foundation/'.$data1->image1) : assets('frontend/images/podcasts.jpg') }}" alt="image" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="sponserpartner-title-info">
                                    <h1>{!! $data1->title ?? 'NA' !!}</h1>
                                </div>
                                <div class="sponserpartner-content-info">
                                    <p class="text-color text-justify">{!! $data1->description ?? 'NA' !!}</p>
                                    <a href="javascript:void(0)"><button class="btn common-btn mt-3 join-butn">Join the Community<i class="bi bi-arrow-right ms-2"></i></button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="donatesupport-section donate d-none">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="left-section">
                                    <div class="img-box">
                                        <img src="{{ isset($data2->image1) ? assets('uploads/foundation/'.$data2->image1) : assets('frontend/images/donate-support-1.jpg') }}" alt="image" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h1 class="mb-4 black-color">{!! $data2->title ?? 'NA' !!}</h1>
                                <p class="text-color text-justify">{!! $data2->description ?? 'NA' !!}</p>
                                <a href="javascript:void(0)"><button class="btn common-btn mt-4 join-butn">Join The Community</button></a>
                            </div>
                        </div>
                    </div>
                </div>

                @if(isset($data3->image1))
                <div class="merch product d-none" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('../public/uploads/foundation/{{$data3->image1}}' ); background-repeat: no-repeat; background-size: cover;">
                @else
                <div class="merch product d-none" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('../public/frontend/images/p-bg.jpg' ); background-repeat: no-repeat; background-size: cover;">
                @endif
                    <div class="container">
                        <h1 class="white-color f-600 text-center mb-3">{!! $data3->title ?? 'NA' !!}</h1>
                        <div class="white-color text-justify text-center">{!! $data3->description ?? 'NA' !!}</div>
                        <div class="text-center">
                            <a href="javascript:void(0)"><button class="btn common-btn mt-3 signup-btn join-butn">Sign Up</button></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- End Main -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $("*[id^='makeMeSummerNote']").summernote({
            height: 200,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
            ],
        });
        $("*[id^='makeMeSummerTitle']").summernote({
            height: 100,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
            ],
        });

        $(document).on('click', ".preview", function() {
            let name = $(this).data('name');
            $(".partner").addClass('d-none');
            $(".donate").addClass('d-none');
            $(".product").addClass('d-none');
            $("." + name).removeClass('d-none');
            $("#review-modal").modal('show');
        });

        $('#partner_form').validate({
            rules: {
                partner_title: {
                    required: true,
                },
                partner_description: {
                    required: true,
                },
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                element.addClass("border border-danger");
                element.closest(".file").addClass("border border-danger");
                element.closest(".form-check").addClass("border border-danger");
            },
            highlight: function(element, errorClass, validClass) {
                $('.please-wait').hide();

            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass("border border-danger");
                $(element).closest(".file").removeClass("border border-danger");
                $(element).closest(".form-check").removeClass("border border-danger");
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                form.submit();
            }
        });

        $('#donate_form').validate({
            rules: {
                donate_title: {
                    required: true,
                },
                donate_description: {
                    required: true,
                },
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                element.addClass("border border-danger");
                element.closest(".file").addClass("border border-danger");
                element.closest(".form-check").addClass("border border-danger");
            },
            highlight: function(element, errorClass, validClass) {
                $('.please-wait').hide();

            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass("border border-danger");
                $(element).closest(".file").removeClass("border border-danger");
                $(element).closest(".form-check").removeClass("border border-danger");
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                form.submit();
            }
        });

        $('#product_form').validate({
            rules: {
                product_title: {
                    required: true,
                },
                product_description: {
                    required: true,
                },
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                element.addClass("border border-danger");
                element.closest(".file").addClass("border border-danger");
                element.closest(".form-check").addClass("border border-danger");
            },
            highlight: function(element, errorClass, validClass) {
                $('.please-wait').hide();

            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass("border border-danger");
                $(element).closest(".file").removeClass("border border-danger");
                $(element).closest(".form-check").removeClass("border border-danger");
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                form.submit();
            }
        });
    })

    $(document).on("change", "*[id^='imageInput']", function(event) {
        let num = $(this).data('num');
        const fileInput = event.target;
        if (fileInput.files.length > 0) {
            const selectedFile = fileInput.files[0];
            $("#image_name" + num).text(selectedFile.name);
        }
    })
</script>
@endsection