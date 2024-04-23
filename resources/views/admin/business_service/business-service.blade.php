@extends('layouts.admin.app')
@section('heading', 'Business Service')
@push('css')
<link rel="stylesheet" href="{{ assets('admin/css/admin-home.css') }}" />
<link rel="stylesheet" href="{{ assets('admin/css/edit-podcast.css') }}" />
<link rel="stylesheet" href="{{ assets('frontend/css/affiliate-links.css') }}">
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

                            <!-- Professional training & certification -->
                            <div class="edit-pmu-form-item">
                                <div class="edit-pmu-heading">
                                    <div class="edit-pmu-text d-flex flex-row align-items-center">
                                        <div class="edit-pmu-text-title mx-2">
                                            <h3 data-bs-toggle="collapse" data-bs-target="#collapseTraining">
                                                <span class="edit-pmu-collapse-icon"><i class="bi bi-card-image"></i></span> {!! $data1->title ?? 'Professional Training & Certification' !!} <i class="bi bi-chevron-down"></i>
                                            </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)" class="preview" data-name="training"><button class="common-btn ms-2"> Preview </button></a>
                                    </div>
                                </div>
                                <div class="edit-pmu-section collapse-course-form collapse" id="collapseTraining">
                                    <form action="{{ route('admin.affiliate.training.save') }}" method="post" enctype="multipart/form-data" id="training_form">@csrf
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="mb-3 field_error">
                                                    <label for="makeMeSummerTitle1" class="form-label black-color f-600">Enter Title</label>
                                                    <textarea name="training_title" id="makeMeSummerTitle1" cols="30" rows="10">{{ $data1->title ?? '' }}</textarea>
                                                    @if(isset($data1->id))
                                                    <input type="hidden" name="training_id" value="{{ encrypt_decrypt('encrypt', $data1->id) }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="@if(isset($data1->image1)) col-md-3 @else col-md-4 @endif">
                                                <div class="mb-3">
                                                    <label for="imageInput{{ $data1->id ?? 9885 }}" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field flex-column">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name{{ $data1->id ?? 9885 }}">
                                                                @if(isset($data1->image1))
                                                                {{ $data1->image1 }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span> <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" @if(!isset($data1->image1)) required @endif data-num="{{ $data1->id ?? 9885 }}" name="training_image" accept="image/png, image/jpg, image/jpeg" id="imageInput{{ $data1->id ?? 9885 }}" />
                                                        </div>
                                                        <div class="alert alert-danger mt-2 text-dark" role="alert">
                                                            Please upload an image greater than or equal to recommended size (1348 X 720)
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($data1->image1))
                                            <div class="col-md-1">
                                                <a target="_blank" href="{{ assets('uploads/business-service/'.$data1->image1) }}"><img width="50" style="margin-top: 33.5%;" src="{{ assets('admin/images/gallery.png') }}" alt=""></a>
                                            </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="mb-3 field_error">
                                                    <label for="makeMeSummerNote1" class="form-label black-color f-600">Enter Description</label>
                                                    <textarea class="post-area form-control" required id="makeMeSummerNote1" name="training_description" rows="3" placeholder="Enter Description">{{ $data1->description ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="d-flex mt-3 mb-4">
                                                <button type="submit" data-id="training_form" class="common-btn ms-2">Update<i class="bi bi-floppy ms-2"></i></button>
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
                                                <span class="edit-pmu-collapse-icon"><i class="bi bi-card-image"></i></span> {!! $data2->title ?? 'Products' !!} <i class="bi bi-chevron-down"></i>
                                            </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)" class="preview" data-name="product"><button class="common-btn ms-2"> Preview </button></a>
                                    </div>
                                </div>
                                <div class="edit-pmu-section collapse-course-form collapse" id="collapseProduct">
                                    <form action="{{ route('admin.affiliate.product.save') }}" method="post" enctype="multipart/form-data" id="product_form">@csrf
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="mb-3 field_error">
                                                    <label for="makeMeSummerTitle2" class="form-label black-color f-600">Enter Title</label>
                                                    <textarea name="product_title" id="makeMeSummerTitle2" cols="30" rows="10">{{ $data2->title ?? '' }}</textarea>
                                                    @if(isset($data2->id))
                                                    <input type="hidden" name="product_id" value="{{ encrypt_decrypt('encrypt', $data2->id) }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="@if(isset($data2->image1)) col-md-3 @else col-md-4 @endif">
                                                <div class="mb-3">
                                                    <label for="imageInput{{ $data2->id ?? 452 }}" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field flex-column">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name{{ $data2->id ?? 452 }}">
                                                                @if(isset($data2->image1))
                                                                {{ $data2->image1 }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span> <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" @if(!isset($data2->image1)) required @endif data-num="{{ $data2->id ?? 452 }}" name="product_image" accept="image/png, image/jpg, image/jpeg" id="imageInput{{ $data2->id ?? 452 }}" />
                                                        </div>
                                                        <div class="alert alert-danger mt-2 text-dark" role="alert">
                                                            Please upload an image greater than or equal to recommended size (1348 X 720)
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($data2->image1))
                                            <div class="col-md-1">
                                                <a target="_blank" href="{{ assets('uploads/business-service/'.$data2->image1) }}"><img width="50" style="margin-top: 33.5%;" src="{{ assets('admin/images/gallery.png') }}" alt=""></a>
                                            </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="mb-3 field_error">
                                                    <label for="makeMeSummerNote2" class="form-label black-color f-600">Enter Description</label>
                                                    <textarea class="post-area form-control" required id="makeMeSummerNote2" name="product_description" rows="3" placeholder="Enter Description">{{ $data2->description ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="d-flex mt-3 mb-4">
                                                <button type="submit" data-id="product_form" class="common-btn ms-2">Update<i class="bi bi-floppy ms-2"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Business links -->
                            <div class="edit-pmu-form-item">
                                <div class="edit-pmu-heading">
                                    <div class="edit-pmu-text d-flex flex-row align-items-center">
                                        <div class="edit-pmu-text-title mx-2">
                                            <h3 data-bs-toggle="collapse" data-bs-target="#collapseTeam"><span class="edit-pmu-collapse-icon"><i class="bi bi-card-image"></i>
                                                </span> Business Links <i class="bi bi-chevron-down"></i></h3>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)" class="preview" data-name="link"><button class="common-btn ms-2"> Preview </button></a>
                                    </div>
                                </div>
                                <div class="edit-pmu-section collapse-course-form collapse" id="collapseTeam">
                                    <div class="text-end">
                                        <a href="javascript:void(0)" style="width: 15%;"><button data-bs-toggle="modal" data-bs-target="#uploadFile" class="outline-btn">Add Business Link<i class="bi bi-plus-circle ms-2"></i></button></a>
                                    </div>
                                    <div class="transaction-details mt-3">
                                        <div class="achievements-scroll">
                                            <div class="owl-carouse row">
                                                @forelse ($data as $item)
                                                <div class="slid col-3 mb-4">
                                                    <div class="box-slid common-card float w-100">
                                                        <div class="img-box" style="height: 75%;">
                                                            <img id style="height: 230px; width: 230px; object-fit:cover; object-position:center;" src="{{ assets("uploads/business-service/$item->image") }}" alt="image" class="img-fluid">
                                                        </div>
                                                        <p style="overflow: hidden; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; height: 23px;" class="px-3 pt-1 mt-2 text-center">{!! $item->title ?? 'NA' !!}</p>
                                                        <div class="d-flex mt-2 justify-content-center">
                                                            <a href="javascript:void(0)"><button class="outline-btn" data-bs-toggle="modal" onclick="$('#delete_form').attr('action','{{ route('admin.business.links.delete', encrypt_decrypt('encrypt', $item->id)) }}')" data-bs-target="#deleteFile">Delete</button></a>
                                                            <a href="javascript:void(0)"><button id="imgEditBtn" class="common-btn ms-2" data-id="{{ encrypt_decrypt('encrypt', $item->id) }}" data-title="{{ $item->title }}" data-description="{{ $item->description }}" data-designation="{{ $item->links }}" data-img="{{ $item->image }}">Edit</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @empty
                                                <div class="text-center mt-5">
                                                    <img width="300" src="{{ assets('admin/images/no-data.svg') }}" alt="">
                                                    <h4 class="p-4 text-center my-2 w-100">No business links found</h4>
                                                </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
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
                <section class="affiliate-links">
                    @if(isset($data1->image1))
                    <div class="project-manager training d-none" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('../public/uploads/business-service/{{$data1->image1}}' ); background-repeat: no-repeat; background-size: cover;"></div>
                    @else
                    <div class="project-manager training d-none" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('../public/frontend/images/video-bg.jpg' ); background-repeat: no-repeat; background-size: cover;"></div>
                    @endif
                    <div class="join-community training d-none">
                        <h1 class="black-color text-center text-capitalize">{!! $data1->title ?? 'NA' !!}</h1>
                        <div class="black-color mt-4 mx-3 text-center">{!! $data1->description ?? 'NA' !!}</div>
                        <div class="d-flex justify-content-center affiliate-buttons mt-5">
                            <a href="{{ route('resources') }}"><button class="btn free-btn">Resources<i class="bi bi-arrow-right ms-3"></i></button></a>
                            <a href="{{ route('user.subscription') }}"><button class="btn common-btn ms-md-3" style="padding: 12px 15px !important;">Join the Community<i class="bi bi-arrow-right ms-3"></i></button></a>
                        </div>
                    </div>

                    @if(isset($data2->image1))
                    <div class="affiliate-images product d-none mt-0" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('../public/uploads/business-service/{{$data2->image1}}' ); background-repeat: no-repeat; background-size: cover;">
                        @else
                        <div class="affiliate-images product d-none mt-0" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('../public/frontend/images/p-bg.jpg' ); background-repeat: no-repeat; background-size: cover;">
                            @endif
                            <div class="container">
                                <h1 class="white-color text-center text-capitalize">{!! $data2->title ?? 'NA' !!}</h1>
                                <div class="white-color text-justify mt-2">{!! $data2->description ?? 'NA' !!}</div>
                                <a href="javascript:void(0)"><button class="btn common-btn mt-3 signup-btn">Sign Up</button></a>
                            </div>
                        </div>
                    
                        <div class="business-links link d-none">
                            <div class="container">
                                <h1 class="black-color text-center text-capitalize">Business <b class="main-color">Links</b></h1>
                                <div class="business-link-contents">

                                    @forelse($data as $key => $value)
                                    <a href="{{ $value->links ?? 'NA' }}" target="_blank">
                                        <div class="link-box mb-3 block">
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <div class="left-section">
                                                        <img src="{{ assets('uploads/business-service/'.$value->image) }}" alt="image" class="img-fluid">
                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="right-section">
                                                        <h4 class="black-color mb-4 f-600">{!! $value->title ?? 'NA' !!}</h4>
                                                        <p class="text-color">{!! $value->description ?? 'NA' !!}</p>
                                                        <br>
                                                        <!-- <a href="{{ $value->links ?? 'NA' }}" target="_blank"><button class="btn learn-more-btn mt-2">Learn More<i class="bi bi-arrow-right ms-3"></i></button></a> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    @empty
                                    @endforelse
                                    
                                </div>
                            </div>
                        </div>
                </section>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editFile" tabindex="-1" aria-labelledby="editFileLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="text-capitalize text-center letter-space f-600 black-color">Edit Business Link</h4>

                <form action="{{ route('admin.business.links.update') }}" method="post" enctype="multipart/form-data" id="update_form">
                    @csrf
                    <div class="edit-ebook">
                        <div class="common-card">
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <div class="mb-3 field_error">
                                        <label for="editTitle" class="form-label black-color f-600">Enter Title</label>
                                        <input type="text" name="title" class="form-control" id="editTitle" value="" aria-describedby="banner_title" placeholder="Enter Title">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="mb-3 field_error">
                                            <label for="editDescription" class="form-label black-color f-600">Enter Description</label>
                                            <textarea name="description" id="editDescription" placeholder="Enter Description" class="form-control" cols="30" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" id="editId" name="id" value="">
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="editImageInput" class="form-label black-color f-600">Upload Image</label>
                                        <div class="file-upload d-flex align-items-center mb-3 field">
                                            <div class="file btn black-color upload-btn">
                                                <span id="edit_image_name">
                                                    Upload Image
                                                </span>
                                                <i class="bi bi-file-image ms-2 main-color"></i>
                                                <input type="file" name="image" accept="image/png, image/jpg, image/jpeg" id="editImageInput" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="mb-3 field_error">
                                            <label for="editDesignation" class="form-label black-color f-600">Enter Redirect URL</label>
                                            <input type="url" name="link" class="form-control" id="editDesignation" value="" aria-describedby="designation" placeholder="Enter Redirect URL">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center mb-3">
                            <button type="button" id="edit-model-close-btn" class="btn common-btn" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="edit-model-submit-btn" class="w-50 btn outline-btn">Update<i class="bi bi-floppy ms-2"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="uploadFile" tabindex="-1" aria-labelledby="uploadFileLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="text-capitalize text-center letter-space f-600 black-color">Add Business Link</h4>

                <form action="{{ route('admin.business.links.save') }}" method="post" enctype="multipart/form-data" id="create_form">
                    @csrf
                    <div class="edit-ebook">
                        <div class="common-card">
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <div class="mb-3 field_error">
                                        <label for="title" class="form-label black-color f-600">Enter Title</label>
                                        <input type="text" name="title" class="form-control" id="title" value="" aria-describedby="banner_title" placeholder="Enter Title">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="mb-3 field_error">
                                            <label for="makeMeSummerNote5" class="form-label black-color f-600">Enter Description</label>
                                            <textarea name="description" id="makeMeSummerNote5" class="form-control" placeholder="Enter Description" cols="30" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="imageInput12" class="form-label black-color f-600">Upload Image</label>
                                        <div class="file-upload d-flex align-items-center mb-3 field">
                                            <div class="file btn black-color upload-btn">
                                                <span id="image_name12">
                                                    Upload Image
                                                </span>
                                                <i class="bi bi-file-image ms-2 main-color"></i>
                                                <input type="file" data-num="12" name="image" accept="image/png, image/jpg, image/jpeg" id="imageInput12" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="mb-3 field_error">
                                            <label for="designation" class="form-label black-color f-600">Enter Redirect URL</label>
                                            <input type="url" name="link" class="form-control" id="designation" value="" aria-describedby="designation" placeholder="Enter Redirect URL">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center mb-3">
                            <button type="button" id="upload-model-close-btn" class="btn common-btn" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="upload-model-submit-btn" class="w-50 btn outline-btn">Create<i class="bi bi-floppy ms-2"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteFile" tabindex="-1" aria-labelledby="deleteFileLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="text-capitalize text-center letter-space f-600 black-color">Are you Sure?</h4>
                <h6 class="text-color text-center mt-3">Do you really want to delete the <b class="main-color">Business Link</b> ?</h6>
                <img src="{{ assets('admin/images/delete.png') }}" alt="image" class="img-fluid delete">
            </div>
            <form action="" method="get" id="delete_form">
                @csrf
                <div class="modal-footer justify-content-center mb-3">
                    <button type="button" class="btn outline-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn common-btn">Yes, Delete</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- End Main -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).on('click', "#imgEditBtn", function() {
        $("#edit_image_name").text($(this).data('img'));
        $("#editId").val($(this).data('id'));
        $("#editTitle").val($(this).data('title'));
        $("#editDescription").summernote({
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
        $("#editDescription").summernote('code', $(this).data('description'));
        $("#editDesignation").val($(this).data('designation'));
        $("#editFile").modal('show');
    });

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
            $(".training").addClass('d-none');
            $(".product").addClass('d-none');
            $(".link").addClass('d-none');
            $("." + name).removeClass('d-none');
            $("#review-modal").modal('show');
        });

        $('#product_form').validate({
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

        $('#training_form').validate({
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

        $('#create_form').validate({
            rules: {
                title: {
                    required: true,
                },
                link: {
                    required: true,
                    url: true
                },
                description: {
                    required: true,
                },
                image: {
                    required: true,
                    filesize: 1
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

        $('#update_form').validate({
            rules: {
                title: {
                    required: true,
                },
                link: {
                    required: true,
                    url: true
                },
                description: {
                    required: true,
                },
                image: {
                    filesize: 1
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
    });
    document.getElementById('editImageInput').addEventListener('change', function(event) {
        const fileInput = event.target;
        if (fileInput.files.length > 0) {
            const selectedFile = fileInput.files[0];
            $("#edit_image_name").text(selectedFile.name);
        }
    });
</script>
@endsection