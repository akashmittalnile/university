@extends('layouts.admin.app')
@section('heading', 'Manage About US')
@push('css')
<link rel="stylesheet" href="{{ assets('admin/css/admin-home.css') }}" />
<link rel="stylesheet" href="{{ assets('admin/css/edit-podcast.css') }}" />
<link rel="stylesheet" href="{{ assets('frontend/css/about.css') }}">
@endpush
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css">

<div class="pmu-content-list mt-5">
    <div class="pmu-content">
        <div class="row">
            <div class="">
                <input type="hidden" name="type_mode" id="type_mode" value="" />
                <div class="col-md-12">
                    <div class="pmu-courses-form-section pmu-addcourse-form">
                        <div class="pmu-courses-form column edit-ebook">

                            <!-- Vision  -->
                            <div class="edit-pmu-form-item">
                                <div class="edit-pmu-heading">
                                    <div class="edit-pmu-text d-flex flex-row align-items-center">
                                        <div class="edit-pmu-text-title mx-2">
                                            <h3 data-bs-toggle="collapse" data-bs-target="#collapseVision">
                                                <span class="edit-pmu-collapse-icon"><i class="bi bi-card-image"></i></span> {{ $data1->title ?? 'Our Vision & Purpose' }} <i class="bi bi-chevron-down"></i>
                                            </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)" class="preview" data-name="vision"><button class="common-btn ms-2"> Preview </button></a>
                                    </div>
                                </div>
                                <div class="edit-pmu-section collapse-course-form collapse" id="collapseVision">
                                    <form action="{{ route('admin.about.vision.save') }}" method="post" enctype="multipart/form-data" id="vision_form">@csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3 field_error">
                                                    <label for="title" class="form-label black-color f-600">Enter Title</label>
                                                    <input type="text" required class="form-control" name="vision_title" id="title" value="{{ $data1->title ?? '' }}" aria-describedby="title" placeholder="Enter Title" />
                                                    @if(isset($data1->id))
                                                    <input type="hidden" name="vision_id" value="{{ encrypt_decrypt('encrypt', $data1->id) }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="@if(isset($data1->image1)) col-md-5 @else col-md-6 @endif">
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
                                                            <input type="file" @if(!isset($data1->image1)) required @endif data-num="{{ $data1->id ?? 452 }}" name="vision_image" accept="image/png, image/jpg, image/jpeg" id="imageInput{{ $data1->id ?? 452 }}" />
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
                                                    <label for="description" class="form-label black-color f-600">Enter Description</label>
                                                    <textarea class="post-area form-control" required id="description" name="vision_description" rows="3" placeholder="Enter Description">{{ $data1->description ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="d-flex mt-3 mb-4">
                                                <button type="submit" data-id="vision_form" class="common-btn ms-2">Update<i class="bi bi-floppy ms-2"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- My Story -->
                            <div class="edit-pmu-form-item">
                                <div class="edit-pmu-heading">
                                    <div class="edit-pmu-text d-flex flex-row align-items-center">
                                        <div class="edit-pmu-text-title mx-2">
                                            <h3 data-bs-toggle="collapse" data-bs-target="#collapseStory">
                                                <span class="edit-pmu-collapse-icon"><i class="bi bi-card-image"></i></span> {{ $data2->title ?? 'My Story' }} <i class="bi bi-chevron-down"></i>
                                            </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)" class="preview" data-name="story"><button class="common-btn ms-2"> Preview </button></a>
                                    </div>
                                </div>
                                <div class="edit-pmu-section collapse-course-form collapse" id="collapseStory">
                                    <form action="{{ route('admin.about.story.save') }}" method="post" enctype="multipart/form-data" id="story_form">@csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3 field_error">
                                                    <label for="title" class="form-label black-color f-600">Enter Title</label>
                                                    <input type="text" required class="form-control" name="story_title" id="title" value="{{ $data2->title ?? '' }}" aria-describedby="title" placeholder="Enter Title" />
                                                    @if(isset($data2->id))
                                                    <input type="hidden" name="story_id" value="{{ encrypt_decrypt('encrypt', $data2->id) }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="@if(isset($data2->image1)) col-md-5 @else col-md-6 @endif">
                                                <div class="mb-3">
                                                    <label for="imageInput{{ $data2->id ?? 472 }}" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field flex-column">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name{{ $data2->id ?? 472 }}">
                                                                @if(isset($data2->image1))
                                                                {{ $data2->image1 }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span> <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" @if(!isset($data2->image1)) required @endif data-num="{{ $data2->id ?? 472 }}" name="story_image" accept="image/png, image/jpg, image/jpeg" id="imageInput{{ $data2->id ?? 472 }}" />
                                                        </div>
                                                        <div class="alert alert-danger mt-2 text-dark" role="alert">
                                                            Please upload an image greater than or equal to recommended size (1348 X 720)
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($data2->image1))
                                            <div class="col-md-1">
                                                <a target="_blank" href="{{ assets('uploads/about/'.$data2->image1) }}"><img width="50" style="margin-top: 33.5%;" src="{{ assets('admin/images/gallery.png') }}" alt=""></a>
                                            </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="mb-3 field_error">
                                                    <label for="description" class="form-label black-color f-600">Enter Description</label>
                                                    <textarea class="post-area form-control" required id="description" name="story_description" rows="3" placeholder="Enter Description">{{ $data2->description ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="d-flex mt-3 mb-4">
                                                <button type="submit" data-id="story_form" class="common-btn ms-2">Update<i class="bi bi-floppy ms-2"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Team members -->
                            <div class="edit-pmu-form-item">
                                <div class="edit-pmu-heading">
                                    <div class="edit-pmu-text d-flex flex-row align-items-center">
                                        <div class="edit-pmu-text-title mx-2">
                                            <h3 data-bs-toggle="collapse" data-bs-target="#collapseTeam"><span class="edit-pmu-collapse-icon"><i class="bi bi-card-image"></i>
                                                </span> Team Members<i class="bi bi-chevron-down"></i></h3>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)" class="preview" data-name="team"><button class="common-btn ms-2"> Preview </button></a>
                                    </div>
                                </div>
                                <div class="edit-pmu-section collapse-course-form collapse" id="collapseTeam">
                                    <div class="text-end">
                                        <a href="javascript:void(0)" style="width: 15%;"><button data-bs-toggle="modal" data-bs-target="#uploadFileTeam" class="outline-btn">Add Team Members<i class="bi bi-plus-circle ms-2"></i></button></a>
                                    </div>
                                    <div class="transaction-details">
                                        <div class="achievements-scroll">
                                            <div class="owl-carouse row">
                                                @forelse ($team as $item)
                                                <div class="slid col-3 mb-4">
                                                    <div class="box-slid common-card float w-100">
                                                        <div class="img-box" style="height: 75%;">
                                                            <img id style="height: 230px; width: 230px; object-fit:cover; object-position:center;" src="{{ assets("uploads/team/$item->image") }}" alt="image" class="img-fluid">
                                                        </div>
                                                        <p style="overflow: hidden; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; height: 23px;" class="px-3 pt-1 mt-2 text-center">{{ $item->name ?? 'NA' }}</p>
                                                        <div class="d-flex mt-2 justify-content-center">
                                                            <a href="javascript:void(0)"><button class="outline-btn" data-bs-toggle="modal" onclick="$('#delete_form_team').attr('action','{{ route('admin.team.member.delete', encrypt_decrypt('encrypt', $item->id)) }}')" data-bs-target="#deleteFileTeam">Delete</button></a>
                                                            <a href="javascript:void(0)"><button id="imgEditBtnTeam" class="common-btn ms-2" data-id="{{ encrypt_decrypt('encrypt', $item->id) }}" data-name="{{ $item->name }}" data-company="{{ $item->company_name }}" data-designation="{{ $item->designation }}" data-img="{{ $item->image }}">Edit</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @empty
                                                <div class="text-center mt-5">
                                                    <img width="300" src="{{ assets('admin/images/no-data.svg') }}" alt="">
                                                    <h4 class="p-4 text-center my-2 w-100">No team members found</h4>
                                                </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- What we do -->
                            <div class="edit-pmu-form-item">
                                <div class="edit-pmu-heading">
                                    <div class="edit-pmu-text d-flex flex-row align-items-center">
                                        <div class="edit-pmu-text-title mx-2">
                                            <h3 data-bs-toggle="collapse" data-bs-target="#collapseWeDo">
                                                <span class="edit-pmu-collapse-icon"><i class="bi bi-card-image"></i></span> {{ $data3->title ?? 'What We Do' }} <i class="bi bi-chevron-down"></i>
                                            </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)" class="preview" data-name="we_do"><button class="common-btn ms-2"> Preview </button></a>
                                    </div>
                                </div>
                                <div class="edit-pmu-section collapse-course-form collapse" id="collapseWeDo">
                                    <form action="{{ route('admin.about.we_do.save') }}" method="post" enctype="multipart/form-data" id="we_do_form">@csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3 field_error">
                                                    <label for="title" class="form-label black-color f-600">Enter Title</label>
                                                    <input type="text" required class="form-control" name="we_do_title" id="title" value="{{ $data3->title ?? '' }}" aria-describedby="title" placeholder="Enter Title" />
                                                    @if(isset($data3->id))
                                                    <input type="hidden" name="we_do_id" value="{{ encrypt_decrypt('encrypt', $data3->id) }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="@if(isset($data3->image1)) col-md-5 @else col-md-6 @endif">
                                                <div class="mb-3">
                                                    <label for="imageInput{{ $data3->id ?? 875 }}" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field flex-column">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name{{ $data3->id ?? 875 }}">
                                                                @if(isset($data3->image1))
                                                                {{ $data3->image1 }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span> <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" @if(!isset($data3->image1)) required @endif data-num="{{ $data3->id ?? 875 }}" name="we_do_image" accept="image/png, image/jpg, image/jpeg" id="imageInput{{ $data3->id ?? 875 }}" />
                                                        </div>
                                                        <div class="alert alert-danger mt-2 text-dark" role="alert">
                                                            Please upload an image greater than or equal to recommended size (1348 X 500)
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($data3->image1))
                                            <div class="col-md-1">
                                                <a target="_blank" href="{{ assets('uploads/about/'.$data3->image1) }}"><img width="50" style="margin-top: 33.5%;" src="{{ assets('admin/images/gallery.png') }}" alt=""></a>
                                            </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="mb-3 field_error">
                                                    <label for="description" class="form-label black-color f-600">Enter Description</label>
                                                    <textarea class="post-area form-control" required id="description" name="we_do_description" rows="3" placeholder="Enter Description">{{ $data3->description ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="d-flex mt-3 mb-4">
                                                <button type="submit" data-id="we_do_form" class="common-btn ms-2">Update<i class="bi bi-floppy ms-2"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- How We Do It -->
                            <div class="edit-pmu-form-item">
                                <div class="edit-pmu-heading">
                                    <div class="edit-pmu-text d-flex flex-row align-items-center">
                                        <div class="edit-pmu-text-title mx-2">
                                            <h3 data-bs-toggle="collapse" data-bs-target="#collapseHow">
                                                <span class="edit-pmu-collapse-icon"><i class="bi bi-card-image"></i></span> {{ $how->title ?? 'How We Do It' }} <i class="bi bi-chevron-down"></i>
                                            </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)" class="preview" data-name="how"><button class="common-btn ms-2"> Preview </button></a>
                                    </div>
                                </div>
                                <div class="edit-pmu-section collapse-course-form collapse" id="collapseHow">
                                    <form action="{{ route('admin.about.how.save') }}" method="post" enctype="multipart/form-data" id="how_form">@csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3 field_error">
                                                    <label for="title" class="form-label black-color f-600">Enter Heading Title</label>
                                                    <input type="text" required class="form-control" name="how_head_title" id="title" value="{{ $how->title ?? '' }}" aria-describedby="title" placeholder="Enter Heading Title" />
                                                    @if(isset($how->id))
                                                    <input type="hidden" name="how_head_id" value="{{ encrypt_decrypt('encrypt', $how->id) }}">
                                                    @endif
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="col-md-6">
                                                <div class="mb-3 field_error">
                                                    <label for="title" class="form-label black-color f-600">Enter Title</label>
                                                    <input type="text" required class="form-control" name="how_title1" id="title" value="{{ $how1->title ?? '' }}" aria-describedby="title" placeholder="Enter Title" />
                                                    @if(isset($how1->id))
                                                    <input type="hidden" name="how_id1" value="{{ encrypt_decrypt('encrypt', $how1->id) }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="@if(isset($how1->image1)) col-md-5 @else col-md-6 @endif">
                                                <div class="mb-3">
                                                    <label for="imageInput{{ $how1->id ?? 423 }}" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field flex-column">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name{{ $how1->id ?? 423 }}">
                                                                @if(isset($how1->image1))
                                                                {{ $how1->image1 }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span> <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" @if(!isset($how1->image1)) required @endif data-num="{{ $how1->id ?? 423 }}" name="how_image1" accept="image/png, image/jpg, image/jpeg, image/svg" id="imageInput{{ $how1->id ?? 423 }}" />
                                                        </div>
                                                        <div class="alert alert-danger mt-2 text-dark" role="alert">
                                                            Please upload an image greater than or equal to recommended size (500 X 500)
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($how1->image1))
                                            <div class="col-md-1">
                                                <a target="_blank" href="{{ assets('uploads/about/'.$how1->image1) }}"><img width="50" style="margin-top: 33.5%;" src="{{ assets('admin/images/gallery.png') }}" alt=""></a>
                                            </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="mb-3 field_error">
                                                    <label for="description" class="form-label black-color f-600">Enter Description</label>
                                                    <textarea class="post-area form-control" required id="description" name="how_description1" rows="3" placeholder="Enter Description">{{ $how1->description ?? '' }}</textarea>
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="col-md-6">
                                                <div class="mb-3 field_error">
                                                    <label for="title" class="form-label black-color f-600">Enter Title</label>
                                                    <input type="text" required class="form-control" name="how_title2" id="title" value="{{ $how2->title ?? '' }}" aria-describedby="title" placeholder="Enter Title" />
                                                    @if(isset($how2->id))
                                                    <input type="hidden" name="how_id2" value="{{ encrypt_decrypt('encrypt', $how2->id) }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="@if(isset($how2->image1)) col-md-5 @else col-md-6 @endif">
                                                <div class="mb-3">
                                                    <label for="imageInput{{ $how2->id ?? 8460 }}" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field flex-column">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name{{ $how2->id ?? 8460 }}">
                                                                @if(isset($how2->image1))
                                                                {{ $how2->image1 }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span> <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" @if(!isset($how2->image1)) required @endif data-num="{{ $how2->id ?? 8460 }}" name="how_image2" accept="image/png, image/jpg, image/jpeg, image/svg" id="imageInput{{ $how2->id ?? 8460 }}" />
                                                        </div>
                                                        <div class="alert alert-danger mt-2 text-dark" role="alert">
                                                            Please upload an image greater than or equal to recommended size (500 X 500)
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($how2->image1))
                                            <div class="col-md-1">
                                                <a target="_blank" href="{{ assets('uploads/about/'.$how2->image1) }}"><img width="50" style="margin-top: 33.5%;" src="{{ assets('admin/images/gallery.png') }}" alt=""></a>
                                            </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="mb-3 field_error">
                                                    <label for="description" class="form-label black-color f-600">Enter Description</label>
                                                    <textarea class="post-area form-control" required id="description" name="how_description2" rows="3" placeholder="Enter Description">{{ $how2->description ?? '' }}</textarea>
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="col-md-6">
                                                <div class="mb-3 field_error">
                                                    <label for="title" class="form-label black-color f-600">Enter Title</label>
                                                    <input type="text" required class="form-control" name="how_title3" id="title" value="{{ $how3->title ?? '' }}" aria-describedby="title" placeholder="Enter Title" />
                                                    @if(isset($how3->id))
                                                    <input type="hidden" name="how_id3" value="{{ encrypt_decrypt('encrypt', $how3->id) }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="@if(isset($how3->image1)) col-md-5 @else col-md-6 @endif">
                                                <div class="mb-3">
                                                    <label for="imageInput{{ $how3->id ?? 235 }}" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field flex-column">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name{{ $how3->id ?? 235 }}">
                                                                @if(isset($how3->image1))
                                                                {{ $how3->image1 }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span> <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" @if(!isset($how3->image1)) required @endif data-num="{{ $how3->id ?? 235 }}" name="how_image3" accept="image/png, image/jpg, image/jpeg, image/svg" id="imageInput{{ $how3->id ?? 235 }}" />
                                                        </div>
                                                        <div class="alert alert-danger mt-2 text-dark" role="alert">
                                                            Please upload an image greater than or equal to recommended size (500 X 500)
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($how3->image1))
                                            <div class="col-md-1">
                                                <a target="_blank" href="{{ assets('uploads/about/'.$how3->image1) }}"><img width="50" style="margin-top: 33.5%;" src="{{ assets('admin/images/gallery.png') }}" alt=""></a>
                                            </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="mb-3 field_error">
                                                    <label for="description" class="form-label black-color f-600">Enter Description</label>
                                                    <textarea class="post-area form-control" required id="description" name="how_description3" rows="3" placeholder="Enter Description">{{ $how3->description ?? '' }}</textarea>
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="col-md-6">
                                                <div class="mb-3 field_error">
                                                    <label for="title" class="form-label black-color f-600">Enter Title</label>
                                                    <input type="text" required class="form-control" name="how_title4" id="title" value="{{ $how4->title ?? '' }}" aria-describedby="title" placeholder="Enter Title" />
                                                    @if(isset($how4->id))
                                                    <input type="hidden" name="how_id4" value="{{ encrypt_decrypt('encrypt', $how4->id) }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="@if(isset($how4->image1)) col-md-5 @else col-md-6 @endif">
                                                <div class="mb-3">
                                                    <label for="imageInput{{ $how4->id ?? 611 }}" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field flex-column">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name{{ $how4->id ?? 611 }}">
                                                                @if(isset($how4->image1))
                                                                {{ $how4->image1 }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span> <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" @if(!isset($how4->image1)) required @endif data-num="{{ $how4->id ?? 611 }}" name="how_image4" accept="image/png, image/jpg, image/jpeg, image/svg" id="imageInput{{ $how4->id ?? 611 }}" />
                                                        </div>
                                                        <div class="alert alert-danger mt-2 text-dark" role="alert">
                                                            Please upload an image greater than or equal to recommended size (500 X 500)
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($how4->image1))
                                            <div class="col-md-1">
                                                <a target="_blank" href="{{ assets('uploads/about/'.$how4->image1) }}"><img width="50" style="margin-top: 33.5%;" src="{{ assets('admin/images/gallery.png') }}" alt=""></a>
                                            </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="mb-3 field_error">
                                                    <label for="description" class="form-label black-color f-600">Enter Description</label>
                                                    <textarea class="post-area form-control" required id="description" name="how_description4" rows="3" placeholder="Enter Description">{{ $how4->description ?? '' }}</textarea>
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="col-md-6">
                                                <div class="mb-3 field_error">
                                                    <label for="title" class="form-label black-color f-600">Enter Title</label>
                                                    <input type="text" required class="form-control" name="how_title5" id="title" value="{{ $how5->title ?? '' }}" aria-describedby="title" placeholder="Enter Title" />
                                                    @if(isset($how5->id))
                                                    <input type="hidden" name="how_id5" value="{{ encrypt_decrypt('encrypt', $how5->id) }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="@if(isset($how5->image1)) col-md-5 @else col-md-6 @endif">
                                                <div class="mb-3">
                                                    <label for="imageInput{{ $how5->id ?? 565 }}" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field flex-column">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name{{ $how5->id ?? 565 }}">
                                                                @if(isset($how5->image1))
                                                                {{ $how5->image1 }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span> <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" @if(!isset($how5->image1)) required @endif data-num="{{ $how5->id ?? 565 }}" name="how_image5" accept="image/png, image/jpg, image/jpeg, image/svg" id="imageInput{{ $how5->id ?? 565 }}" />
                                                        </div>
                                                        <div class="alert alert-danger mt-2 text-dark" role="alert">
                                                            Please upload an image greater than or equal to recommended size (500 X 500)
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($how5->image1))
                                            <div class="col-md-1">
                                                <a target="_blank" href="{{ assets('uploads/about/'.$how5->image1) }}"><img width="50" style="margin-top: 33.5%;" src="{{ assets('admin/images/gallery.png') }}" alt=""></a>
                                            </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="mb-3 field_error">
                                                    <label for="description" class="form-label black-color f-600">Enter Description</label>
                                                    <textarea class="post-area form-control" required id="description" name="how_description5" rows="3" placeholder="Enter Description">{{ $how5->description ?? '' }}</textarea>
                                                </div>
                                            </div>


                                            <div class="d-flex mt-3 mb-4">
                                                <button type="submit" data-id="how_form" class="common-btn ms-2">Update<i class="bi bi-floppy ms-2"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Why select us -->
                            <div class="edit-pmu-form-item">
                                <div class="edit-pmu-heading">
                                    <div class="edit-pmu-text d-flex flex-row align-items-center">
                                        <div class="edit-pmu-text-title mx-2">
                                            <h3 data-bs-toggle="collapse" data-bs-target="#collapseSelect">
                                                <span class="edit-pmu-collapse-icon"><i class="bi bi-card-image"></i></span> {{ $data4->title ?? 'Why You Select Us?' }} <i class="bi bi-chevron-down"></i>
                                            </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)" class="preview" data-name="select"><button class="common-btn ms-2"> Preview </button></a>
                                    </div>
                                </div>
                                <div class="edit-pmu-section collapse-course-form collapse" id="collapseSelect">
                                    <form action="{{ route('admin.about.select.save') }}" method="post" enctype="multipart/form-data" id="select_form">@csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3 field_error">
                                                    <label for="title" class="form-label black-color f-600">Enter Title</label>
                                                    <input type="text" required class="form-control" name="select_title" id="title" value="{{ $data4->title ?? '' }}" aria-describedby="title" placeholder="Enter Title" />
                                                    @if(isset($data4->id))
                                                    <input type="hidden" name="select_id" value="{{ encrypt_decrypt('encrypt', $data4->id) }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="@if(isset($data4->image1)) col-md-5 @else col-md-6 @endif">
                                                <div class="mb-3">
                                                    <label for="imageInput{{ $data4->id ?? 645 }}" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field flex-column">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name{{ $data4->id ?? 645 }}">
                                                                @if(isset($data4->image1))
                                                                {{ $data4->image1 }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span> <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" @if(!isset($data4->image1)) required @endif data-num="{{ $data4->id ?? 645 }}" name="select_image" accept="image/png, image/jpg, image/jpeg" id="imageInput{{ $data4->id ?? 645 }}" />
                                                        </div>
                                                        <div class="alert alert-danger mt-2 text-dark" role="alert">
                                                            Please upload an image greater than or equal to recommended size (1348 X 720)
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($data4->image1))
                                            <div class="col-md-1">
                                                <a target="_blank" href="{{ assets('uploads/about/'.$data4->image1) }}"><img width="50" style="margin-top: 33.5%;" src="{{ assets('admin/images/gallery.png') }}" alt=""></a>
                                            </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="mb-3 field_error">
                                                    <label for="description" class="form-label black-color f-600">Enter Description</label>
                                                    <textarea class="post-area form-control" required id="description" name="select_description" rows="3" placeholder="Enter Description">{{ $data4->description ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="d-flex mt-3 mb-4">
                                                <button type="submit" data-id="select_form" class="common-btn ms-2">Update<i class="bi bi-floppy ms-2"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- How we differ -->
                            <div class="edit-pmu-form-item">
                                <div class="edit-pmu-heading">
                                    <div class="edit-pmu-text d-flex flex-row align-items-center">
                                        <div class="edit-pmu-text-title mx-2">
                                            <h3 data-bs-toggle="collapse" data-bs-target="#collapseDiffer">
                                                <span class="edit-pmu-collapse-icon"><i class="bi bi-card-image"></i></span> {{ $data5->title ?? 'How We Differ' }} <i class="bi bi-chevron-down"></i>
                                            </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)" class="preview" data-name="differ"><button class="common-btn ms-2"> Preview </button></a>
                                    </div>
                                </div>
                                <div class="edit-pmu-section collapse-course-form collapse" id="collapseDiffer">
                                    <form action="{{ route('admin.about.differ.save') }}" method="post" enctype="multipart/form-data" id="differ_form">@csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3 field_error">
                                                    <label for="title" class="form-label black-color f-600">Enter Title</label>
                                                    <input type="text" required class="form-control" name="differ_title" id="title" value="{{ $data5->title ?? '' }}" aria-describedby="title" placeholder="Enter Title" />
                                                    @if(isset($data5->id))
                                                    <input type="hidden" name="differ_id" value="{{ encrypt_decrypt('encrypt', $data5->id) }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="@if(isset($data5->image1)) col-md-5 @else col-md-6 @endif">
                                                <div class="mb-3">
                                                    <label for="imageInput{{ $data5->id ?? 9464 }}" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field flex-column">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name{{ $data5->id ?? 9464 }}">
                                                                @if(isset($data5->image1))
                                                                {{ $data5->image1 }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span> <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" @if(!isset($data5->image1)) required @endif data-num="{{ $data5->id ?? 9464 }}" name="differ_image1" accept="image/png, image/jpg, image/jpeg" id="imageInput{{ $data5->id ?? 9464 }}" />
                                                        </div>
                                                        <div class="alert alert-danger mt-2 text-dark" role="alert">
                                                            Please upload an image greater than or equal to recommended size (1348 X 720)
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($data5->image1))
                                            <div class="col-md-1">
                                                <a target="_blank" href="{{ assets('uploads/about/'.$data5->image1) }}"><img width="50" style="margin-top: 33.5%;" src="{{ assets('admin/images/gallery.png') }}" alt=""></a>
                                            </div>
                                            @endif
                                            <div class="@if(isset($data5->image2)) col-md-5 @else col-md-6 @endif">
                                                <div class="mb-3">
                                                    <label for="imageInput6554" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field flex-column">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name6554">
                                                                @if(isset($data5->image2))
                                                                {{ $data5->image2 }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span> <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" @if(!isset($data5->image2)) required @endif data-num="6554" name="differ_image2" accept="image/png, image/jpg, image/jpeg" id="imageInput6554" />
                                                        </div>
                                                        <div class="alert alert-danger mt-2 text-dark" role="alert">
                                                            Please upload an image greater than or equal to recommended size (1348 X 720)
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($data5->image2))
                                            <div class="col-md-1">
                                                <a target="_blank" href="{{ assets('uploads/about/'.$data5->image2) }}"><img width="50" style="margin-top: 33.5%;" src="{{ assets('admin/images/gallery.png') }}" alt=""></a>
                                            </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="mb-3 field_error">
                                                    <label for="description" class="form-label black-color f-600">Enter Description</label>
                                                    <textarea class="post-area form-control" required id="description" name="differ_description" rows="3" placeholder="Enter Description">{{ $data5->description ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="d-flex mt-3 mb-4">
                                                <button type="submit" data-id="differ_form" class="common-btn ms-2">Update<i class="bi bi-floppy ms-2"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- who is it for -->
                            <div class="edit-pmu-form-item">
                                <div class="edit-pmu-heading">
                                    <div class="edit-pmu-text d-flex flex-row align-items-center">
                                        <div class="edit-pmu-text-title mx-2">
                                            <h3 data-bs-toggle="collapse" data-bs-target="#collapseWhoIs">
                                                <span class="edit-pmu-collapse-icon"><i class="bi bi-card-image"></i></span> {{ $data6->title ?? 'Who Is It For?' }} <i class="bi bi-chevron-down"></i>
                                            </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)" class="preview" data-name="who_is"><button class="common-btn ms-2"> Preview </button></a>
                                    </div>
                                </div>
                                <div class="edit-pmu-section collapse-course-form collapse" id="collapseWhoIs">
                                    <form action="{{ route('admin.about.who_is.save') }}" method="post" enctype="multipart/form-data" id="who_is_form">@csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3 field_error">
                                                    <label for="title" class="form-label black-color f-600">Enter Title</label>
                                                    <input type="text" required class="form-control" name="who_is_title" id="title" value="{{ $data6->title ?? '' }}" aria-describedby="title" placeholder="Enter Title" />
                                                    @if(isset($data6->id))
                                                    <input type="hidden" name="who_is_id" value="{{ encrypt_decrypt('encrypt', $data6->id) }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="@if(isset($data6->image1)) col-md-5 @else col-md-6 @endif">
                                                <div class="mb-3">
                                                    <label for="imageInput{{ $data6->id ?? 1964 }}" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field flex-column">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name{{ $data6->id ?? 1964 }}">
                                                                @if(isset($data6->image1))
                                                                {{ $data6->image1 }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span> <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" @if(!isset($data6->image1)) required @endif data-num="{{ $data6->id ?? 1964 }}" name="who_is_image" accept="image/png, image/jpg, image/jpeg" id="imageInput{{ $data6->id ?? 1964 }}" />
                                                        </div>
                                                        <div class="alert alert-danger mt-2 text-dark" role="alert">
                                                            Please upload an image greater than or equal to recommended size (1348 X 720)
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($data6->image1))
                                            <div class="col-md-1">
                                                <a target="_blank" href="{{ assets('uploads/about/'.$data6->image1) }}"><img width="50" style="margin-top: 33.5%;" src="{{ assets('admin/images/gallery.png') }}" alt=""></a>
                                            </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="mb-3 field_error">
                                                    <label for="description" class="form-label black-color f-600">Enter Description</label>
                                                    <textarea class="post-area form-control" required id="description" name="who_is_description" rows="3" placeholder="Enter Description">{{ $data6->description ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="d-flex mt-3 mb-4">
                                                <button type="submit" data-id="who_is_form" class="common-btn ms-2">Update<i class="bi bi-floppy ms-2"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Global impact -->
                            <div class="edit-pmu-form-item">
                                <div class="edit-pmu-heading">
                                    <div class="edit-pmu-text d-flex flex-row align-items-center">
                                        <div class="edit-pmu-text-title mx-2">
                                            <h3 data-bs-toggle="collapse" data-bs-target="#collapseGlobal">
                                                <span class="edit-pmu-collapse-icon"><i class="bi bi-card-image"></i></span> {{ $data7->title ?? 'Our Global Impact' }} <i class="bi bi-chevron-down"></i>
                                            </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)" class="preview" data-name="global"><button class="common-btn ms-2"> Preview </button></a>
                                    </div>
                                </div>
                                <div class="edit-pmu-section collapse-course-form collapse" id="collapseGlobal">
                                    <form action="{{ route('admin.about.global.save') }}" method="post" enctype="multipart/form-data" id="global_form">@csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3 field_error">
                                                    <label for="title" class="form-label black-color f-600">Enter Title</label>
                                                    <input type="text" required class="form-control" name="global_title" id="title" value="{{ $data7->title ?? '' }}" aria-describedby="title" placeholder="Enter Title" />
                                                    @if(isset($data7->id))
                                                    <input type="hidden" name="global_id" value="{{ encrypt_decrypt('encrypt', $data7->id) }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="@if(isset($data7->image1)) col-md-5 @else col-md-6 @endif">
                                                <div class="mb-3">
                                                    <label for="imageInput{{ $data7->id ?? 9860 }}" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field flex-column">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name{{ $data7->id ?? 9860 }}">
                                                                @if(isset($data7->image1))
                                                                {{ $data7->image1 }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span> <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" @if(!isset($data7->image1)) required @endif data-num="{{ $data7->id ?? 9860 }}" name="global_image" accept="image/png, image/jpg, image/jpeg" id="imageInput{{ $data7->id ?? 9860 }}" />
                                                        </div>
                                                        <div class="alert alert-danger mt-2 text-dark" role="alert">
                                                            Please upload an image greater than or equal to recommended size (1348 X 720)
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($data7->image1))
                                            <div class="col-md-1">
                                                <a target="_blank" href="{{ assets('uploads/about/'.$data7->image1) }}"><img width="50" style="margin-top: 33.5%;" src="{{ assets('admin/images/gallery.png') }}" alt=""></a>
                                            </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="mb-3 field_error">
                                                    <label for="description" class="form-label black-color f-600">Enter Description</label>
                                                    <textarea class="post-area form-control" required id="description" name="global_description" rows="3" placeholder="Enter Description">{{ $data7->description ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="d-flex mt-3 mb-4">
                                                <button type="submit" data-id="global_form" class="common-btn ms-2">Update<i class="bi bi-floppy ms-2"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Partner -->
                            <div class="edit-pmu-form-item">
                                <div class="edit-pmu-heading">
                                    <div class="edit-pmu-text d-flex flex-row align-items-center">
                                        <div class="edit-pmu-text-title mx-2">
                                            <h3 data-bs-toggle="collapse" data-bs-target="#collapsePartner">
                                                <span class="edit-pmu-collapse-icon"><i class="bi bi-card-image"></i></span> {{ $data8->title ?? 'Partners' }} <i class="bi bi-chevron-down"></i>
                                            </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)" class="preview" data-name="partner"><button class="common-btn ms-2"> Preview </button></a>
                                    </div>
                                </div>
                                <div class="edit-pmu-section collapse-course-form collapse" id="collapsePartner">
                                    <form action="{{ route('admin.about.partner.save') }}" method="post" enctype="multipart/form-data" id="partner_form">@csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3 field_error">
                                                    <label for="title" class="form-label black-color f-600">Enter Title</label>
                                                    <input type="text" required class="form-control" name="partner_title" id="title" value="{{ $data8->title ?? '' }}" aria-describedby="title" placeholder="Enter Title" />
                                                    @if(isset($data8->id))
                                                    <input type="hidden" name="partner_id" value="{{ encrypt_decrypt('encrypt', $data8->id) }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="@if(isset($data8->image1)) col-md-5 @else col-md-6 @endif">
                                                <div class="mb-3">
                                                    <label for="imageInput{{ $data8->id ?? 1407 }}" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field flex-column">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name{{ $data8->id ?? 1407 }}">
                                                                @if(isset($data8->image1))
                                                                {{ $data8->image1 }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span> <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" @if(!isset($data8->image1)) required @endif data-num="{{ $data8->id ?? 1407 }}" name="partner_image" accept="image/png, image/jpg, image/jpeg" id="imageInput{{ $data8->id ?? 1407 }}" />
                                                        </div>
                                                        <div class="alert alert-danger mt-2 text-dark" role="alert">
                                                            Please upload an image greater than or equal to recommended size (1348 X 720)
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($data8->image1))
                                            <div class="col-md-1">
                                                <a target="_blank" href="{{ assets('uploads/about/'.$data8->image1) }}"><img width="50" style="margin-top: 33.5%;" src="{{ assets('admin/images/gallery.png') }}" alt=""></a>
                                            </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="mb-3 field_error">
                                                    <label for="description" class="form-label black-color f-600">Enter Description</label>
                                                    <textarea class="post-area form-control" required id="description" name="partner_description" rows="3" placeholder="Enter Description">{{ $data8->description ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="d-flex mt-3 mb-4">
                                                <button type="submit" data-id="partner_form" class="common-btn ms-2">Update<i class="bi bi-floppy ms-2"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Supporter -->
                            <div class="edit-pmu-form-item">
                                <div class="edit-pmu-heading">
                                    <div class="edit-pmu-text d-flex flex-row align-items-center">
                                        <div class="edit-pmu-text-title mx-2">
                                            <h3 data-bs-toggle="collapse" data-bs-target="#collapseSupport">
                                                <span class="edit-pmu-collapse-icon"><i class="bi bi-card-image"></i></span> {{ $data9->title ?? 'Supporters' }} <i class="bi bi-chevron-down"></i>
                                            </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)" class="preview" data-name="support"><button class="common-btn ms-2"> Preview </button></a>
                                    </div>
                                </div>
                                <div class="edit-pmu-section collapse-course-form collapse" id="collapseSupport">
                                    <form action="{{ route('admin.about.support.save') }}" method="post" enctype="multipart/form-data" id="support_form">@csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3 field_error">
                                                    <label for="title" class="form-label black-color f-600">Enter Title</label>
                                                    <input type="text" required class="form-control" name="support_title" id="title" value="{{ $data9->title ?? '' }}" aria-describedby="title" placeholder="Enter Title" />
                                                    @if(isset($data9->id))
                                                    <input type="hidden" name="support_id" value="{{ encrypt_decrypt('encrypt', $data9->id) }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="@if(isset($data9->image1)) col-md-5 @else col-md-6 @endif">
                                                <div class="mb-3">
                                                    <label for="imageInput{{ $data9->id ?? 6548 }}" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field flex-column">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name{{ $data9->id ?? 6548 }}">
                                                                @if(isset($data9->image1))
                                                                {{ $data9->image1 }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span> <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" @if(!isset($data9->image1)) required @endif data-num="{{ $data9->id ?? 6548 }}" name="support_image" accept="image/png, image/jpg, image/jpeg" id="imageInput{{ $data9->id ?? 1407 }}" />
                                                        </div>
                                                        <div class="alert alert-danger mt-2 text-dark" role="alert">
                                                            Please upload an image greater than or equal to recommended size (1348 X 720)
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($data9->image1))
                                            <div class="col-md-1">
                                                <a target="_blank" href="{{ assets('uploads/about/'.$data9->image1) }}"><img width="50" style="margin-top: 33.5%;" src="{{ assets('admin/images/gallery.png') }}" alt=""></a>
                                            </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="mb-3 field_error">
                                                    <label for="description" class="form-label black-color f-600">Enter Description</label>
                                                    <textarea class="post-area form-control" required id="description" name="support_description" rows="3" placeholder="Enter Description">{{ $data9->description ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="d-flex mt-3 mb-4">
                                                <button type="submit" data-id="support_form" class="common-btn ms-2">Update<i class="bi bi-floppy ms-2"></i></button>
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

                <section class="about-us py-2">
                    <div class="container">
                        <div class="vision-purpose vision d-none">
                            <div class="row align-items-center mb-3">
                                <div class="col-md-4">
                                    <div class="left-section">
                                        <h1 class="text-md-end black-color">
                                            {{ $data1->title ?? 'NA' }}
                                        </h1>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="right-section common-shadow">
                                        <img src="{{ isset($data1->image1) ? assets('uploads/about/'.($data1->image1)) : assets('frontend/images/gallery-2.jpg') }}" alt="image" class="img-fluid" />
                                    </div>
                                </div>
                            </div>
                            <p class="my-story-descr">
                                {{ $data1->description ?? 'NA' }}
                            </p>
                        </div>
                        <div class="my-story story d-none">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="left-section">
                                        <img src="{{ isset($data2->image) ? assets('uploads/about/'.($data2->image)) : assets('frontend/images/who-is-it-1.jpg') }}" class="img-fluid" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="heading-title">
                                        <h1>{{ $data2->title ?? 'NA' }}</h1>
                                    </div>
                                    <p class="my-story-descr">
                                        {{ $data2->description ?? 'NA' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(count($team) > 0)
                    <section class="team-members-section team d-none">
                        <h1>Team Members</h1>
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="TeamMembers" class="owl-carousel">

                                        @forelse($team as $key => $val)
                                        <div class="item">
                                            <div class="team-members-card">

                                                <div class="row align-items-center">
                                                    <div class="col-md-6">
                                                        <div class="team-members-card-image">
                                                            <img src="{{ assets('uploads/team/'.$val->image) }}" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="team-members-card-content">
                                                            <div class="team-quotes">"</div>
                                                            <div class="team-members-card-content-innner">
                                                                <p>" {{ $val->company_name ?? 'NA' }} "</p>
                                                                <h4>{{ $val->name ?? 'NA' }}</h4>
                                                                <h6><i class="bi bi-dash-lg me-2"></i>{{ $val->designation ?? 'NA' }}</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        @endforelse

                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @if(isset($data3->image1))
                    <div class="what-we-do we_do d-none" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('../public/uploads/about/{{($data3->image1 ?? null)}}' ); background-repeat: no-repeat; background-size: cover;"> @else <div class="what-we-do we_do d-none" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('../public/frontend/images/conference.jpg'); background-repeat: no-repeat; background-size: cover;"> @endif
                        <div class="container">
                            <h1 class="text-center white-color">
                                {{ $data3->title ?? 'NA' }}
                            </h1>
                            <div class="what-we-do-box common-shadow">
                                <p class="white-color sub-text text-center">{{ $data3->description ?? 'NA' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="why-you-select select d-none">
                        <div class="container">
                            <h1 class="black-color head-1 mb-4">
                                {{ $data4->title ?? 'NA' }}
                            </h1>
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="left-section">
                                        <img src="{{ isset($data4->image1) ? assets('uploads/about/'.($data4->image1)) : assets('frontend/images/why-choose.jpg') }}" alt="image" class="img-fluid" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="why-you-select-box common-shadow">
                                        <p>
                                            {{ $data4->description ?? 'NA' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="how-we-offer differ d-none">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="left-section">
                                        <img src="{{ isset($data5->image1) ? assets('uploads/about/'.($data5->image1)) : assets('frontend/images/affiliate-slider-1.jpg') }}" alt="image" class="img-fluid" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h1 class="black-color head-1 mb-4">
                                        {{ $data5->title ?? 'NA' }}
                                    </h1>
                                    <div class="right-section">
                                        <img src="{{ isset($data5->image2) ? assets('uploads/about/'.($data5->image2)) : assets('frontend/images/blog-img.jpg') }}" alt="image" class="img-fluid" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="how-we-offer-box mt-md-4 mt-sm-0">
                                        <p>
                                            {{ $data5->description ?? 'NA' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="who-is-it-for who_is d-none">
                        <div class="container">
                            <div class="who-is-it-for-contents">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="left-section">
                                            <img src="{{ isset($data6->image1) ? assets('uploads/about/'.($data6->image1 ?? null)) : assets('frontend/images/who-is-it-1.jpg') }}" alt="image" class="img-fluid" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="right-section">
                                            <h1 class="black-color head-1 mb-4">
                                                {{ $data6->title ?? 'NA' }}
                                            </h1>
                                            <p class="global-descr  text-justify">
                                                {{ $data6->description ?? 'NA' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="global-impact global d-none">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="left-section">
                                        <h1 class="black-color text-md-end head-1 mb-0 pb-0">
                                            {{ $data7->title ?? 'NA' }}
                                        </h1>
                                        <p class="global-descr text-md-end">
                                            {{ $data7->description ?? 'NA' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="right-section">
                                        <img src="{{ isset($data7->image1) ? assets('uploads/about/'.($data7->image1 ?? null)) : assets('frontend/images/global-impact.jpg') }}" alt="image" class="img-fluid" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="why-you-select partner d-none">
                        <div class="container">
                            <h1 class="black-color head-1 mb-4">
                                {{ $data8->title ?? 'NA' }}
                            </h1>
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="left-section">
                                        <img src="{{ isset($data8->image1) ? assets('uploads/about/'.($data8->image1 ?? null)) : assets('frontend/images/community-2.jpg') }}" alt="image" class="img-fluid" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="why-you-select-box common-shadow">
                                        <p class="global-descr">
                                            {{ $data8->description ?? 'NA' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="global-impact support d-none">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="left-section">
                                        <h1 class="heading-title-text text-end">
                                            {{ $data9->title ?? 'NA' }}
                                        </h1>
                                        <p class="global-descr text-md-end">
                                            {{ $data9->description ?? 'NA' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="right-section">
                                        <img src="{{ isset($data9->image1) ? assets('uploads/about/'.($data9->image1 ?? null)) : assets('frontend/images/community-1.jpg') }}" alt="image" class="img-fluid" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="how d-none">
                        <div class="how-we-do">
                            <div class="container">
                                <h1 class="text-center black-color">
                                    {{ $how->title ?? 'NA' }}
                                </h1>
                                <div class="row">
                                    <div class="col-md-6 bottom-margin">
                                        <div class="how-we-do-box common-shadow h-100 float">
                                            <img src="{{ isset($how1->image1) ? assets('uploads/about/'.($how1->image1 ?? null)) : assets('frontend/images/requirement.svg') }}" alt="image" class="img-fluid" />
                                            <h3 class="text-capitalize main-color mb-3">
                                                {{ $how1->title ?? 'NA' }}
                                            </h3>
                                            <p class="black-color">
                                                {{ $how1->description ?? 'NA' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 bottom-margin">
                                        <div class="how-we-do-box common-shadow h-100 float">
                                            <img src="{{ isset($how2->image1) ? assets('uploads/about/'.($how2->image1 ?? null)) : assets('frontend/images/we-create.svg') }}" alt="image" class="img-fluid" />
                                            <h3 class="text-capitalize main-color mb-3">
                                                {{ $how2->title ?? 'NA' }}
                                            </h3>
                                            <p class="black-color">
                                                {{ $how2->description ?? 'NA' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="how-we-do-cards">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4 bottom-margin">
                                        <div class="card common-shadow float">
                                            <div class="img-bg">
                                                <img src="{{ isset($how3->image1) ? assets('uploads/about/'.($how3->image1 ?? null)) : assets('frontend/images/growth.svg') }}" alt="image" class="img-fluid" />
                                            </div>
                                            <h5 class="f-600 mt-3">{{ $how3->title ?? 'NA' }}</h5>
                                            <p class="mt-3">
                                                {{ $how3->description ?? 'NA' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 bottom-margin">
                                        <div class="card common-shadow float">
                                            <div class="img-bg">
                                                <img src="{{ isset($how4->image1) ? assets('uploads/about/'.($how4->image1 ?? null)) : assets('frontend/images/innovation.svg') }}" alt="image" class="img-fluid" />
                                            </div>
                                            <h5 class="f-600 mt-3">
                                                {{ $how4->title ?? 'NA' }}
                                            </h5>
                                            <p class="mt-3">
                                                {{ $how4->description ?? 'NA' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 bottom-margin">
                                        <div class="card common-shadow float">
                                            <div class="img-bg">
                                                <img src="{{ isset($how5->image1) ? assets('uploads/about/'.($how5->image1 ?? null)) : assets('frontend/images/change.svg') }}" alt="image" class="img-fluid" />
                                            </div>
                                            <h5 class="f-600 mt-3">{{ $how5->title ?? 'NA' }}</h5>
                                            <p class="mt-3">
                                                {{ $how5->description ?? 'NA' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editFileTeam" tabindex="-1" aria-labelledby="editFileLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="text-capitalize text-center letter-space f-600 black-color mb-3">Edit Team Member</h4>

                <form action="{{ route('admin.team.member.update') }}" method="post" enctype="multipart/form-data" id="update_form_team">
                    @csrf
                    <div class="edit-ebook">
                        <input type="hidden" id="redirect_url" value="{{ route('admin.team.member') }}">
                        <div class="common-card" style="box-shadow: none;">
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <div class="mb-3 field_error">
                                        <label for="editNameTeam" class="form-label black-color f-600">Enter Name</label>
                                        <input type="text" name="name" class="form-control" id="editNameTeam" value="" aria-describedby="banner_name" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="editImageInputTeam" class="form-label black-color f-600">Upload Image</label>
                                        <div class="file-upload d-flex align-items-center mb-3 field">
                                            <div class="file btn black-color upload-btn">
                                                <span id="edit_image_name_team">
                                                    Upload Image
                                                </span>
                                                <i class="bi bi-file-image ms-2 main-color"></i>
                                                <input type="file" name="image" accept="image/png, image/jpg, image/jpeg" id="editImageInputTeam" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="mb-3 field_error">
                                            <label for="editDesignationTeam" class="form-label black-color f-600">Enter Designation</label>
                                            <input type="text" name="designation" class="form-control" id="editDesignationTeam" value="" aria-describedby="designation" placeholder="Enter Designation">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="mb-3 field_error">
                                            <label for="editCompanyTeam" class="form-label black-color f-600">Enter Company Name</label>
                                            <textarea name="company_name" id="editCompanyTeam" placeholder="Enter Company Name" class="form-control" cols="30" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" id="editIdTeam" name="id" value="">
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

<div class="modal fade" id="uploadFileTeam" tabindex="-1" aria-labelledby="uploadFileLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="text-capitalize text-center letter-space f-600 black-color mb-3">Add Team Member</h4>

                <form action="{{ route('admin.team.member.save') }}" method="post" enctype="multipart/form-data" id="create_form_team">
                    @csrf
                    <div class="edit-ebook">
                        <input type="hidden" id="redirect_url" value="{{ route('admin.team.member') }}">
                        <div class="common-card" style="box-shadow: none;">
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <div class="mb-3 field_error">
                                        <label for="name" class="form-label black-color f-600">Enter Name</label>
                                        <input type="text" name="name" class="form-control" id="name" value="" aria-describedby="banner_name" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="imageInput52" class="form-label black-color f-600">Upload Image</label>
                                        <div class="file-upload d-flex align-items-center mb-3 field">
                                            <div class="file btn black-color upload-btn">
                                                <span id="image_name52">
                                                    Upload Image
                                                </span>
                                                <i class="bi bi-file-image ms-2 main-color"></i>
                                                <input type="file" name="image" data-num="52" accept="image/png, image/jpg, image/jpeg" id="imageInput52" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="mb-3 field_error">
                                            <label for="designation" class="form-label black-color f-600">Enter Designation</label>
                                            <input type="text" name="designation" class="form-control" id="designation" value="" aria-describedby="designation" placeholder="Enter Designation">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="mb-3 field_error">
                                            <label for="company_name" class="form-label black-color f-600">Enter Company Name</label>
                                            <textarea name="company_name" id="company_name" class="form-control" placeholder="Enter Company Name" cols="30" rows="3"></textarea>
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

<div class="modal fade" id="deleteFileTeam" tabindex="-1" aria-labelledby="deleteFileLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="text-capitalize text-center letter-space f-600 black-color">Are you Sure?</h4>
                <h6 class="text-color text-center mt-3">Do you really want to delete the <b class="main-color">Team Member</b> ?</h6>
                <img src="{{ assets('admin/images/delete.png') }}" alt="image" class="img-fluid delete">
            </div>
            <form action="" method="get" id="delete_form_team">
                @csrf
                <div class="modal-footer justify-content-center mb-3">
                    <button type="button" class="btn outline-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn common-btn">Yes, Delete</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $("#TeamMembers").owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            responsive: {
                1000: {
                    items: 1
                },
            }
        });

        $(document).on('click', "#imgEditBtnTeam", function() {
            $("#edit_image_name_team").text($(this).data('img'));
            $("#editIdTeam").val($(this).data('id'));
            $("#editNameTeam").val($(this).data('name'));
            $("#editCompanyTeam").val($(this).data('company'));
            $("#editDesignationTeam").val($(this).data('designation'));
            $("#editFileTeam").modal('show');
        });

        $(document).on('click', ".preview", function() {
            let name = $(this).data('name');
            $(".vision").addClass('d-none');
            $(".story").addClass('d-none');
            $(".team").addClass('d-none');
            $(".we_do").addClass('d-none');
            $(".select").addClass('d-none');
            $(".differ").addClass('d-none');
            $(".who_is").addClass('d-none');
            $(".global").addClass('d-none');
            $(".partner").addClass('d-none');
            $(".support").addClass('d-none');
            $(".how").addClass('d-none');
            $("." + name).removeClass('d-none');
            $("#review-modal").modal('show');
        });

        $.validator.addMethod('filesize', function(value, element, param) {
            return this.optional(element) || (element.files[0].size <= param * 1000000)
        }, 'File size must be less than {0} MB');

        $('#vision_form').validate({
            rules: {
                vision_title: {
                    required: true,
                },
                vision_description: {
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

        $('#story_form').validate({
            rules: {
                story_title: {
                    required: true,
                },
                story_description: {
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

        $('#we_do_form').validate({
            rules: {
                we_do_title: {
                    required: true,
                },
                we_do_description: {
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

        $('#select_form').validate({
            rules: {
                select_title: {
                    required: true,
                },
                select_description: {
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

        $('#differ_form').validate({
            rules: {
                differ_title: {
                    required: true,
                },
                differ_description: {
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

        $('#who_is_form').validate({
            rules: {
                who_is_title: {
                    required: true,
                },
                who_is_description: {
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

        $('#global_form').validate({
            rules: {
                global_title: {
                    required: true,
                },
                global_description: {
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

        $('#support_form').validate({
            rules: {
                support_title: {
                    required: true,
                },
                support_description: {
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

        $('#how_form').validate({
            rules: {
                how_head_title: {
                    required: true,
                },
                how_title1: {
                    required: true,
                },
                how_description1: {
                    required: true,
                },
                how_title2: {
                    required: true,
                },
                how_description2: {
                    required: true,
                },
                how_title3: {
                    required: true,
                },
                how_description3: {
                    required: true,
                },
                how_title4: {
                    required: true,
                },
                how_description4: {
                    required: true,
                },
                how_title5: {
                    required: true,
                },
                how_description5: {
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

        $('#create_form_team').validate({
            rules: {
                name: {
                    required: true,
                },
                company_name: {
                    required: true,
                },
                designation: {
                    required: true,
                },
                image: {
                    required: true,
                    filesize: 1
                },
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                // error.addClass("invalid-feedback");
                element.addClass("border border-danger");
                element.closest(".file").addClass("border border-danger");
                element.closest(".form-check").addClass("border border-danger");
            },
            highlight: function(element, errorClass, validClass) {
                $('.please-wait').hide();

            },
            unhighlight: function(element, errorClass, validClass) {
                // $(element).removeClass("text-danger");
                $(element).removeClass("border border-danger");
                $(element).closest(".file").removeClass("border border-danger");
                $(element).closest(".form-check").removeClass("border border-danger");
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                form.submit();
            }
        });

        $('#update_form_team').validate({
            rules: {
                name: {
                    required: true,
                },
                company_name: {
                    required: true,
                },
                designation: {
                    required: true,
                },
                image: {
                    filesize: 1
                },
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                // error.addClass("invalid-feedback");
                element.addClass("border border-danger");
                element.closest(".file").addClass("border border-danger");
                element.closest(".form-check").addClass("border border-danger");
            },
            highlight: function(element, errorClass, validClass) {
                $('.please-wait').hide();

            },
            unhighlight: function(element, errorClass, validClass) {
                // $(element).removeClass("text-danger");
                $(element).removeClass("border border-danger");
                $(element).closest(".file").removeClass("border border-danger");
                $(element).closest(".form-check").removeClass("border border-danger");
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                form.submit();
            }
        });
    });

    $(document).on("change", "*[id^='imageInput']", function(event) {
        let num = $(this).data('num');
        const fileInput = event.target;
        if (fileInput.files.length > 0) {
            const selectedFile = fileInput.files[0];
            $("#image_name" + num).text(selectedFile.name);
        }
    })

    document.getElementById('editImageInputTeam').addEventListener('change', function(event) {
        const fileInput = event.target;
        if (fileInput.files.length > 0) {
            const selectedFile = fileInput.files[0];
            $("#edit_image_name_team").text(selectedFile.name);
        }
    });
</script>

@endsection