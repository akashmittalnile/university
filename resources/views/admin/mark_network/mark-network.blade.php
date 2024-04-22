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
                                    <form action="{{ route('admin.about.mentorship.save') }}" method="post" enctype="multipart/form-data" id="mentorship_form">@csrf
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
                                                    <label for="imageInput{{ $data1->id ?? 452 }}" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field flex-column">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name{{ $data1->id ?? 452 }}">
                                                                @if(isset($data1->image1))
                                                                {{ $data1->image1 }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span> <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" @if(!isset($data1->image1)) required @endif data-num="{{ $data1->id ?? 452 }}" name="mentorship_image" accept="image/png, image/jpg, image/jpeg" id="imageInput{{ $data1->id ?? 452 }}" />
                                                        </div>
                                                        <div class="alert alert-danger mt-2 text-dark" role="alert">
                                                            Please upload an image greater than or equal to recommended size (1348 X 720)
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($data1->image1))
                                            <div class="col-md-1">
                                                <a target="_blank" href="{{ assets('uploads/about/'.$data1->image1) }}"><img width="50" style="margin-top: 33.5%;" src="{{ assets('admin/images/gallery.png') }}" alt=""></a>
                                            </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="mb-3 field_error">
                                                    <label for="makeMeSummernote1" class="form-label black-color f-600">Enter Description</label>
                                                    <textarea class="post-area form-control" required id="makeMeSummernote1" name="mentorship_description" rows="3" placeholder="Enter Description">{{ $data1->description ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="d-flex mt-3 mb-4">
                                                <button type="submit" data-id="mentorship_form" class="common-btn ms-2">Update<i class="bi bi-floppy ms-2"></i></button>
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




<!-- End Main -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>

</script>
@endsection