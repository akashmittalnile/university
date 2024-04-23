@extends('layouts.admin.app')
@section('heading', 'Mark Network')
@push('css')
<link rel="stylesheet" href="{{ assets('admin/css/admin-home.css') }}" />
<link rel="stylesheet" href="{{ assets('admin/css/edit-podcast.css') }}" />
<link rel="stylesheet" href="{{ assets('frontend/css/mark-network.css') }}">
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

                            <!-- Mentor ship -->
                            <div class="edit-pmu-form-item">
                                <div class="edit-pmu-heading">
                                    <div class="edit-pmu-text d-flex flex-row align-items-center">
                                        <div class="edit-pmu-text-title mx-2">
                                            <h3 data-bs-toggle="collapse" data-bs-target="#collapseMentorship">
                                                <span class="edit-pmu-collapse-icon"><i class="bi bi-card-image"></i></span> {!! $data1->title ?? 'Mentorship' !!} <i class="bi bi-chevron-down"></i>
                                            </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)" class="preview" data-name="mentorship"><button class="common-btn ms-2"> Preview </button></a>
                                    </div>
                                </div>
                                <div class="edit-pmu-section collapse-course-form collapse" id="collapseMentorship">
                                    <form action="{{ route('admin.markNetwork.mentorship.save') }}" method="post" enctype="multipart/form-data" id="mentorship_form">@csrf
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="mb-3 field_error">
                                                    <label for="makeMeSummerTitle1" class="form-label black-color f-600">Enter Title</label>
                                                    <textarea name="mentorship_title" id="makeMeSummerTitle1" cols="30" rows="10">{{ $data1->title ?? '' }}</textarea>
                                                    @if(isset($data1->id))
                                                    <input type="hidden" name="mentorship_id" value="{{ encrypt_decrypt('encrypt', $data1->id) }}">
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
                                                            <input type="file" @if(!isset($data1->image1)) required @endif data-num="{{ $data1->id ?? 324 }}" name="mentorship_image" accept="image/png, image/jpg, image/jpeg" id="imageInput{{ $data1->id ?? 324 }}" />
                                                        </div>
                                                        <div class="alert alert-danger mt-2 text-dark" role="alert">
                                                            Please upload an image greater than or equal to recommended size (1348 X 720)
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($data1->image1))
                                            <div class="col-md-1">
                                                <a target="_blank" href="{{ assets('uploads/mark-network/'.$data1->image1) }}"><img width="50" style="margin-top: 33.5%;" src="{{ assets('admin/images/gallery.png') }}" alt=""></a>
                                            </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="mb-3 field_error">
                                                    <label for="makeMeSummerNote1" class="form-label black-color f-600">Enter Description</label>
                                                    <textarea class="post-area form-control" required id="makeMeSummerNote1" name="mentorship_description" rows="3" placeholder="Enter Description">{{ $data1->description ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="d-flex mt-3 mb-4">
                                                <button type="submit" data-id="mentorship_form" class="common-btn ms-2">Update<i class="bi bi-floppy ms-2"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Community -->
                            <div class="edit-pmu-form-item">
                                <div class="edit-pmu-heading">
                                    <div class="edit-pmu-text d-flex flex-row align-items-center">
                                        <div class="edit-pmu-text-title mx-2">
                                            <h3 data-bs-toggle="collapse" data-bs-target="#collapseCommunity">
                                                <span class="edit-pmu-collapse-icon"><i class="bi bi-card-image"></i></span> {!! $data2->title ?? 'Community' !!} <i class="bi bi-chevron-down"></i>
                                            </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)" class="preview" data-name="community"><button class="common-btn ms-2"> Preview </button></a>
                                    </div>
                                </div>
                                <div class="edit-pmu-section collapse-course-form collapse" id="collapseCommunity">
                                    <form action="{{ route('admin.markNetwork.community.save') }}" method="post" enctype="multipart/form-data" id="community_form">@csrf
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="mb-3 field_error">
                                                    <label for="makeMeSummerTitle2" class="form-label black-color f-600">Enter Title</label>
                                                    <textarea name="community_title" id="makeMeSummerTitle2" cols="30" rows="10">{{ $data2->title ?? '' }}</textarea>
                                                    @if(isset($data2->id))
                                                    <input type="hidden" name="community_id" value="{{ encrypt_decrypt('encrypt', $data2->id) }}">
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
                                                            <input type="file" @if(!isset($data2->image1)) required @endif data-num="{{ $data2->id ?? 8546 }}" name="community_image" accept="image/png, image/jpg, image/jpeg" id="imageInput{{ $data2->id ?? 8546 }}" />
                                                        </div>
                                                        <div class="alert alert-danger mt-2 text-dark" role="alert">
                                                            Please upload an image greater than or equal to recommended size (1348 X 720)
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($data2->image1))
                                            <div class="col-md-1">
                                                <a target="_blank" href="{{ assets('uploads/mark-network/'.$data2->image1) }}"><img width="50" style="margin-top: 33.5%;" src="{{ assets('admin/images/gallery.png') }}" alt=""></a>
                                            </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="mb-3 field_error">
                                                    <label for="makeMeSummerNote2" class="form-label black-color f-600">Enter Description</label>
                                                    <textarea class="post-area form-control" required id="makeMeSummerNote2" name="community_description" rows="3" placeholder="Enter Description">{{ $data2->description ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="d-flex mt-3 mb-4">
                                                <button type="submit" data-id="community_form" class="common-btn ms-2">Update<i class="bi bi-floppy ms-2"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Became a member -->
                            <div class="edit-pmu-form-item">
                                <div class="edit-pmu-heading">
                                    <div class="edit-pmu-text d-flex flex-row align-items-center">
                                        <div class="edit-pmu-text-title mx-2">
                                            <h3 data-bs-toggle="collapse" data-bs-target="#collapseMember">
                                                <span class="edit-pmu-collapse-icon"><i class="bi bi-card-image"></i></span> {!! $data3->title ?? 'Become A Member' !!} <i class="bi bi-chevron-down"></i>
                                            </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)" class="preview" data-name="member"><button class="common-btn ms-2"> Preview </button></a>
                                    </div>
                                </div>
                                <div class="edit-pmu-section collapse-course-form collapse" id="collapseMember">
                                    <form action="{{ route('admin.markNetwork.member.save') }}" method="post" enctype="multipart/form-data" id="member_form">@csrf
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="mb-3 field_error">
                                                    <label for="makeMeSummerTitle3" class="form-label black-color f-600">Enter Title</label>
                                                    <textarea name="member_title" id="makeMeSummerTitle2" cols="30" rows="10">{{ $data3->title ?? '' }}</textarea>
                                                    @if(isset($data3->id))
                                                    <input type="hidden" name="member_id" value="{{ encrypt_decrypt('encrypt', $data3->id) }}">
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
                                                            <input type="file" @if(!isset($data3->image1)) required @endif data-num="{{ $data3->id ?? 452 }}" name="member_image" accept="image/png, image/jpg, image/jpeg" id="imageInput{{ $data3->id ?? 452 }}" />
                                                        </div>
                                                        <div class="alert alert-danger mt-2 text-dark" role="alert">
                                                            Please upload an image greater than or equal to recommended size (1348 X 720)
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($data3->image1))
                                            <div class="col-md-1">
                                                <a target="_blank" href="{{ assets('uploads/mark-network/'.$data3->image1) }}"><img width="50" style="margin-top: 33.5%;" src="{{ assets('admin/images/gallery.png') }}" alt=""></a>
                                            </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="mb-3 field_error">
                                                    <label for="makeMeSummerNote2" class="form-label black-color f-600">Enter Description</label>
                                                    <textarea class="post-area form-control" required id="makeMeSummerNote3" name="member_description" rows="3" placeholder="Enter Description">{{ $data3->description ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="d-flex mt-3 mb-4">
                                                <button type="submit" data-id="member_form" class="common-btn ms-2">Update<i class="bi bi-floppy ms-2"></i></button>
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
                <section class="marknetwork">
                    <div class="mark-membership-section mentorship d-none">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mark-mentorship-image" >
                                        <img src="{{ isset($data1->image1) ? assets('uploads/mark-network/'.$data1->image1) : assets('frontend/images/mentor.jpg') }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mark-mentorship-content">
                                        <h1>{!! $data1->title ?? 'NA' !!}</h1>
                                        <p>{!! $data1->description ?? 'NA' !!}</p>
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                    </div>

                    <div class="community-section community d-none">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-md-6 ">
                                    <div class="left-section">
                                        <div class="img-box">
                                            <img src="{{ isset($data2->image1) ? assets('uploads/mark-network/'.$data2->image1) : assets('frontend/images/membership-2.jpg') }}" alt="image" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h1 class="mb-4 black-color">{!! $data2->title ?? 'NA' !!}</h1>
                                    <p class="text-color text-justify">{!! $data2->description ?? 'NA' !!}</p>
                                    <a href="{{ route('user.subscription') }}"><button class="btn common-btn mt-4">Join The Community</button></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(isset($data3->image1))
                    <div class="become-a-member member d-none" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('../public/uploads/mark-network/{{$data3->image1}}' ); background-repeat: no-repeat; background-size: cover;">
                    @else
                    <div class="become-a-member member d-none" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('../public/frontend/images/merch-bg.jpg' ); background-repeat: no-repeat; background-size: cover;">
                    @endif
                        <div class="container">
                            <h1 class="mb-4 white-color text-center">{!! $data3->title ?? 'NA' !!}</h1>
                            <div class="text-center white-color">{!! $data3->description ?? 'NA' !!}</div>
                        </div>
                    </div>
                </section>
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
            $(".mentorship").addClass('d-none');
            $(".community").addClass('d-none');
            $(".member").addClass('d-none');
            $("." + name).removeClass('d-none');
            $("#review-modal").modal('show');
        });

        $('#mentorship_form').validate({
            rules: {
                mentorship_title: {
                    required: true,
                },
                mentorship_description: {
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

        $('#community_form').validate({
            rules: {
                community_title: {
                    required: true,
                },
                community_description: {
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

        $('#member_form').validate({
            rules: {
                member_title: {
                    required: true,
                },
                member_description: {
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