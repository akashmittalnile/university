@extends('layouts.admin.app')
@push('css')
<link rel="stylesheet" href="{{ assets('admin/css/admin-home.css') }}" />

<link rel="stylesheet" href="{{ assets('admin/css/manage-podcasts.css') }}" />
<link rel="stylesheet" href="{{ assets('admin/css/edit-podcast.css') }}" />

<link rel="stylesheet" href="{{ assets('frontend/css/home.css') }}">
<link rel="stylesheet" href="{{ assets('frontend/css/mark-network.css') }}">
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

    <div class="pmu-content-list mt-5">
        <div class="pmu-content">
            <div class="row">
                <div class="">
                    <input type="hidden" name="type_mode" id="type_mode" value="" />
                    <div class="col-md-12">
                        <div class="pmu-courses-form-section pmu-addcourse-form">
                            <div class="pmu-courses-form column edit-ebook">
                                @if ($datas->isEmpty())
                                <tr>
                                    <td colspan="10">
                                        <h5 style="text-align: center">No Record Found</h5>
                                    </td>
                                </tr>
                                @else

                                @foreach ($datas as $data)
                                @if($data->section_code == 'banner')
                                <div class="edit-pmu-form-item">
                                    <div class="edit-pmu-heading">
                                        <div class="edit-pmu-text d-flex flex-row align-items-center">
                                            <div class="edit-pmu-text-title mx-2">
                                                <h3 data-bs-toggle="collapse" data-bs-target="#collapse{{$data->id}}">Banner<i class="bi bi-chevron-down" style="margin-left: 15px;"></i></h3>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0)" class="preview" data-name="banner"><button class="common-btn ms-2"> Preview </button></a>
                                        </div>
                                    </div>
                                    <div class="edit-pmu-section collapse-course-form collapse" id="collapse{{$data->id}}">
                                        <form action="{{ route('admin.manage.home.banner.save') }}" method="post" enctype="multipart/form-data" id="create_form{{ $data->id }}">@csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3 field_error">
                                                        <label for="title" class="form-label black-color f-600">Enter Title</label>
                                                        <input type="text" required class="form-control" name="banner_title" id="title" value="{{ $data->title ?? '' }}" aria-describedby="title" placeholder="Enter Title" />
                                                        <input type="hidden" name="banner_id" value="{{ encrypt_decrypt('encrypt', $data->id) }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="imageInput{{ $data->id }}" class="form-label black-color f-600">Upload Image</label>
                                                        <div class="file-upload d-flex align-items-center mb-3 field">
                                                            <div class="file btn black-color upload-btn">
                                                                <span id="image_name{{ $data->id }}">
                                                                    @if(isset($data->image))
                                                                    {{ $data->image }}
                                                                    @else
                                                                    Upload Image
                                                                    @endif
                                                                </span> <i class="bi bi-file-image ms-2 main-color"></i>
                                                                <input type="file" data-num="{{ $data->id }}" name="banner_image" accept="image/png, image/jpg, image/jpeg" id="imageInput{{ $data->id }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3 field_error">
                                                        <label for="description" class="form-label black-color f-600">Enter Description</label>
                                                        <textarea class="post-area form-control" required id="description" name="banner_description" rows="3" placeholder="Enter Description">{{ $data->description ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="d-flex mt-3 mb-4">
                                                    <button type="button" data-id="create_form{{ $data->id }}" class="common-btn ms-2">Update<i class="bi bi-floppy ms-2"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @elseif($data->section_code == 'community')
                                <div class="edit-pmu-form-item">
                                    <div class="edit-pmu-heading">
                                        <div class="edit-pmu-text d-flex flex-row align-items-center">
                                            <div class="edit-pmu-text-title mx-2">
                                                <h3 data-bs-toggle="collapse" data-bs-target="#collapse{{$data->id}}">Community<i class="bi bi-chevron-down" style="margin-left: 15px;"></i></h3>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0)" class="preview" data-name="become-a-member"><button class="common-btn ms-2"> Preview </button></a>
                                        </div>
                                    </div>
                                    <div class="edit-pmu-section collapse-course-form collapse" id="collapse{{$data->id}}">
                                        <form action="{{ route('admin.manage.home.community.save') }}" method="post" enctype="multipart/form-data" id="create_form{{ $data->id }}">@csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3 field_error">
                                                        <label for="community_title" class="form-label black-color f-600">Enter Title</label>
                                                        <input type="text" required class="form-control" name="community_title" id="community_title" value="{{ $data->title ?? '' }}" aria-describedby="community_title" placeholder="Enter Title" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="imageInput{{ $data->id }}" class="form-label black-color f-600">Upload Image</label>
                                                        <div class="file-upload d-flex align-items-center mb-3 field">
                                                            <div class="file btn black-color upload-btn">
                                                                <span id="image_name{{ $data->id }}">
                                                                    @if(isset($data->image))
                                                                    {{ $data->image }}
                                                                    @else
                                                                    Upload Image
                                                                    @endif
                                                                </span> <i class="bi bi-file-image ms-2 main-color"></i>
                                                                <input type="file" data-num="{{ $data->id }}" name="community_image" accept="image/png, image/jpg, image/jpeg" id="imageInput{{ $data->id }}" />
                                                                <input type="hidden" name="community_id" value="{{ encrypt_decrypt('encrypt', $data->id) }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3 field_error">
                                                        <label for="community_description" class="form-label black-color f-600">Enter Description</label>
                                                        <textarea class="post-area form-control" required id="community_description" name="community_description" rows="3" placeholder="Enter Description">{{ $data->description ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="d-flex mt-3 mb-4">
                                                    <button type="button" data-id="create_form{{ $data->id }}" class="common-btn ms-2">Update<i class="bi bi-floppy ms-2"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @elseif($data->section_code == 'testimonial')
                                <div class="edit-pmu-form-item">
                                    <div class="edit-pmu-heading">
                                        <div class="edit-pmu-text d-flex flex-row align-items-center">
                                            <div class="edit-pmu-text-title mx-2">
                                                <h3 data-bs-toggle="collapse" data-bs-target="#collapse{{$data->id}}">Testimonials<i class="bi bi-chevron-down" style="margin-left: 15px;"></i></h3>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0)" class="preview" data-name="testimonials"><button class="common-btn ms-2"> Preview </button></a>
                                        </div>
                                    </div>
                                    <div class="edit-pmu-section collapse-course-form collapse" id="collapse{{$data->id}}">
                                        <div class="text-end">
                                            <a href="javascript:void(0)" style="width: 19%;"><button data-bs-toggle="modal" data-bs-target="#uploadFile" class="outline-btn ms-2">Add Testimonial<i class="bi bi-plus-circle ms-2"></i></button></a>
                                        </div>
                                        <div class="transaction-details">
                                            <div class="">
                                                <div class="owl-carouse row">
                                                    @forelse ($test as $item)
                                                    <div class="slid col-4 mb-4">
                                                        <div class="box-slid common-card float w-100">
                                                            <div class="img-box" style="height: 75%;">
                                                                <img id style="height: 100%;" src="{{ assets("uploads/testimonial/$item->image") }}" alt="image" class="img-fluid">
                                                            </div>
                                                            <p style="overflow: hidden; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; height: 23px;" class="px-3 mt-2">{{ $item->title ?? 'NA' }}</p>
                                                            <div class="d-flex mt-2">
                                                                <a href="javascript:void(0)"><button class="outline-btn" data-bs-toggle="modal" onclick="$('#delete_form').attr('action','{{ route('admin.manage.testimonial.delete', encrypt_decrypt('encrypt', $item->id)) }}')" data-bs-target="#deleteFile">Delete</button></a>
                                                                <a href="javascript:void(0)"><button id="imgEditBtn" class="common-btn ms-2" data-id="{{ encrypt_decrypt('encrypt', $item->id) }}" data-title="{{ $item->title }}" data-description="{{ $item->description }}" data-designation="{{ $item->designation }}" data-img="{{ $item->image }}">Edit Testimonial</button></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @empty
                                                    <div class="text-center mt-5">
                                                        <img width="300" src="{{ assets('admin/images/no-data.svg') }}" alt="">
                                                        <h4 class="p-4 text-center my-2 w-100">No testimonials found</h4>
                                                    </div>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @elseif($data->section_code == 'achievement')
                                <div class="edit-pmu-form-item">
                                    <div class="edit-pmu-heading">
                                        <div class="edit-pmu-text d-flex flex-row align-items-center">
                                            <div class="edit-pmu-text-title mx-2">
                                                <h3 data-bs-toggle="collapse" data-bs-target="#collapse{{$data->id}}">Achievements<i class="bi bi-chevron-down" style="margin-left: 15px;"></i></h3>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0)" class="preview" data-name="testimonial"><button class="common-btn ms-2"> Preview </button></a>
                                        </div>
                                    </div>
                                    <div class="edit-pmu-section collapse-course-form collapse" id="collapse{{$data->id}}">
                                        <div class="text-end">
                                            <a href="javascript:void(0)" style="width: 17%;"><button data-bs-toggle="modal" data-bs-target="#uploadFileAchieve" class="outline-btn ms-2">Add Achievement<i class="bi bi-plus-circle ms-2"></i></button></a>
                                        </div>
                                        <div class="transaction-details">
                                            <div class="">
                                                <div class="owl-carouse row">
                                                    @forelse ($badges as $item)
                                                    <div class="slid col-4 mb-4">
                                                        <div class="box-slid common-card float w-100">
                                                            <div class="img-box" style="height: 75%;">
                                                                <img id style="height: 100%;" src="{{ assets("uploads/badges/$item->path") }}" alt="image" class="img-fluid">
                                                            </div>
                                                            <p style="overflow: hidden; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; height: 23px;" class="px-3 mt-2">{{ $item->title ?? 'NA' }}</p>
                                                            <div class="d-flex mt-2">
                                                                <a href="javascript:void(0)"><button class="outline-btn" data-bs-toggle="modal" onclick="$('#delete_form_achieve').attr('action','{{ route('admin.manage.affiliate-badges.delete', encrypt_decrypt('encrypt', $item->id)) }}')" data-bs-target="#deleteFileAchieve">Delete</button></a>
                                                                <a href="javascript:void(0)"><button style="width: 137px;" id="imgEditBtnAchieve" class="common-btn ms-2" data-id="{{ encrypt_decrypt('encrypt', $item->id) }}" data-title="{{ $item->title }}" data-description="{{ $item->description }}" data-img="{{ $item->path }}">Edit Achievement</button></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @empty
                                                    <div class="text-center mt-5">
                                                        <img width="300" src="{{ assets('admin/images/no-data.svg') }}" alt="">
                                                        <h4 class="p-4 text-center my-2 w-100">No achievements found</h4>
                                                    </div>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @elseif($data->section_code == 'video')
                                <div class="edit-pmu-form-item">
                                    <div class="edit-pmu-heading">
                                        <div class="edit-pmu-text d-flex flex-row align-items-center">
                                            <div class="edit-pmu-text-title mx-2">
                                                <h3 data-bs-toggle="collapse" data-bs-target="#collapse{{$data->id}}">Youtube Video<i class="bi bi-chevron-down" style="margin-left: 15px;"></i></h3>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0)" class="preview" data-name="youtube"><button class="common-btn ms-2"> Preview </button></a>
                                        </div>
                                    </div>
                                    <div class="edit-pmu-section collapse-course-form collapse" id="collapse{{$data->id}}">
                                        <div class="text-end">
                                            <a href="javascript:void(0)" style="width: 15%;"><button data-bs-toggle="modal" data-bs-target="#uploadFileVideo" class="outline-btn">Add Video<i class="bi bi-plus-circle ms-2"></i></button></a>
                                        </div>
                                        <div class="transaction-details">
                                            <div class="">
                                                <div class="owl-carouse row">
                                                    @forelse ($video as $item)
                                                    <div class="slid col-4 mb-4">
                                                        <div class="box-slid common-card float w-100">
                                                            <div class="img-box">
                                                                <iframe src="{{ $item->link }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                                            </div>
                                                            <p style="overflow: hidden; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; height: 23px;" class="px-3 mt-2">{{ $item->title ?? 'NA' }}</p>
                                                            <div class="d-flex mt-2">
                                                                <a href="javascript:void(0)"><button class="outline-btn" data-bs-toggle="modal" onclick="$('#delete_form_video').attr('action','{{ route('admin.manage.videos.delete', encrypt_decrypt('encrypt', $item->id)) }}')" data-bs-target="#deleteFileVideo">Delete</button></a>
                                                                <a href="javascript:void(0)"><button id="imgEditBtnVideo" class="common-btn ms-2" data-id="{{ encrypt_decrypt('encrypt', $item->id) }}" data-title="{{ $item->title }}" data-link="{{ $item->link }}">Edit Video</button></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @empty
                                                    <div class="text-center mt-5">
                                                        <img width="300" src="{{ assets('admin/images/no-data.svg') }}" alt="">
                                                        <h4 class="p-4 text-center my-2 w-100">No videos found</h4>
                                                    </div>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif


                                @endforeach
                                @endif

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
                    <section class="banner d-none" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('public/uploads/content/{{$home->image}}' ), background-repeat: no-repeat;">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="left-section">
                                        <h1 class="white-color f-600">{{ $home->title ?? 'NA' }}</h1>
                                        <!-- <p class="white-color mt-3 f-500 text-capitalize">We help you deliver them with confidence</p> -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="right-section">
                                        <h5 class="text-capitalize white-color">{{ $home->description ?? 'NA' }}</h5>
                                        <!-- <a href="javascript:void(0)"><button class="btn common-btn mt-4">Sign Up</button></a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    @if(count($test) > 0)
                    <section class="testimonials d-none">
                        <h1 class="mt-4 text-center f-600">Testimonials<b class="main-color"></b></h1>
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="customers-testimonials" class="owl-carousel">

                                        @forelse($test as $key => $val)
                                        <div class="item">
                                            <div class="customers-testimonials-card">
                                                <div class="customers-testimonials-image">
                                                    <img src="{{ assets('uploads/testimonial/'.$val->image) }}" alt="">
                                                </div>
                                                <div class="customers-testimonials-content">
                                                    <h6 class="main-color mt-2 text-left">{{ $val->title ?? 'NA' }}</h6>
                                                    <p>{{ $val->description ?? 'NA' }}</p>
                                                    <hr class="main-color">
                                                    <h4 class="client-name black-color f-500"><i class="bi bi-dash-lg me-2 main-color"></i>{{ $val->designation ?? 'NA' }}</h4>
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

                    @if(count($video) > 0)
                    <section class="youtube d-none">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="owl-carousel owl-theme pmoCarousel">
                                        @forelse($video as $key => $val)
                                        <div class="item">
                                            <div class="shadow-effect">
                                                <iframe src="{{ $val->link ?? 'https://www.youtube.com/embed/XV1cOGaZUq0?si=LMIXLag_k_VxIP1k' }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                                <h6 class="main-color mt-2 text-left">{{ $val->title ?? 'NA' }}</h6>
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

                    @if(count($badges) > 0)
                    <section class="testimonial d-none">
                        <h1 class="mt-4 text-center f-600">Achievements</h1>
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="customers-testimonials1" class="owl-carousel">

                                        @forelse($badges as $key => $val)
                                        <div class="item">
                                            <div class="affiliate-badges-card">
                                                <div class="affiliate-c-media">
                                                    <img src="{{ assets('uploads/badges/'.$val->path) }}" alt="">
                                                </div>
                                                <div class="affiliate-Badges-media">
                                                    <h6 class="main-color mt-2 text-left">{{ $val->title ?? '' }}</h6>
                                                    <p>{{ $val->description ?? '' }}</p>
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

                    <div class="become-a-member d-none" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('public/uploads/content/{{$community->image}}' ), background-repeat: no-repeat;">
                        <div class="container">
                            <h1 class="mb-4 white-color text-center">{{ $community->title ?? 'NA' }}</h1>
                            <p class="text-center white-color">{{ $community->description ?? 'NA' }}</p>
                        </div>
                    </div>
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
                    <h4 class="text-capitalize text-center letter-space f-600 black-color mb-3">Edit Testimonial</h4>

                    <form action="{{ route('admin.manage.testimonial.update') }}" method="post" enctype="multipart/form-data" id="update_form">
                        @csrf
                        <div class="edit-ebook">
                            <input type="hidden" id="redirect_url" value="{{ route('admin.manage.testimonial') }}">
                            <div class="common-card" style="box-shadow: none;">
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
                                                <label for="editDesignation" class="form-label black-color f-600">Enter Designation</label>
                                                <input type="text" name="designation" class="form-control" id="editDesignation" value="" aria-describedby="designation" placeholder="Enter Designation">
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
                    <h4 class="text-capitalize text-center letter-space f-600 black-color mb-3">Add Testimonial</h4>

                    <form action="{{ route('admin.manage.testimonial.save') }}" method="post" enctype="multipart/form-data" id="create_form">
                        @csrf
                        <div class="edit-ebook">
                            <input type="hidden" id="redirect_url" value="{{ route('admin.manage.testimonial') }}">
                            <div class="common-card" style="box-shadow: none;">
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
                                                <label for="description" class="form-label black-color f-600">Enter Description</label>
                                                <textarea name="description" id="description" class="form-control" placeholder="Enter Description" cols="30" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="imageInput200" class="form-label black-color f-600">Upload Image</label>
                                            <div class="file-upload d-flex align-items-center mb-3 field">
                                                <div class="file btn black-color upload-btn">
                                                    <span id="image_name200">
                                                        Upload Image
                                                    </span>
                                                    <i class="bi bi-file-image ms-2 main-color"></i>
                                                    <input type="file" data-num="200" name="image" accept="image/png, image/jpg, image/jpeg" id="imageInput200" />
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
                    <h6 class="text-color text-center mt-3">Do you really want to delete the <b class="main-color">Testimonial</b> ?</h6>
                    <img src="{{ assets('admin/images/delete.png') }}" alt="image" class="img-fluid">
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

    <div class="modal fade" id="editFileVideo" tabindex="-1" aria-labelledby="editFileLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="text-capitalize text-center letter-space f-600 black-color mb-3">Edit Video</h4>

                    <form action="{{ route('admin.manage.videos.update') }}" method="post" enctype="multipart/form-data" id="update_form_video">
                        @csrf
                        <div class="edit-ebook">
                            <input type="hidden" id="redirect_url" value="{{ route('admin.manage.videos') }}">
                            <div class="common-card" style="box-shadow: none;">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <div class="mb-3 field_error">
                                            <label for="editTitle" class="form-label black-color f-600">Enter Youtube Title</label>
                                            <input type="text" name="title" class="form-control" id="editTitleVideo" value="" aria-describedby="banner_title" placeholder="Enter Youtube Title">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="mb-3 field_error">
                                                <label for="editDescription" class="form-label black-color f-600">Enter Youtube Video Embed (link/src)</label>
                                                <input type="url" name="link" id="editLinkVideo" placeholder="Enter Youtube Video Embed (link/src)" class="form-control"></input>
                                            </div>
                                        </div>
                                        <input type="hidden" id="editIdVideo" name="id" value="">
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

    <div class="modal fade" id="uploadFileVideo" tabindex="-1" aria-labelledby="uploadFileLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="text-capitalize text-center letter-space f-600 black-color mb-3">Add Video</h4>
                    <form action="{{ route('admin.manage.videos.save') }}" enctype="multipart/form-data" method="post" id="create_form_video">
                        @csrf
                        <div class="edit-ebook">
                            <input type="hidden" id="redirect_url" value="{{ route('admin.manage.videos') }}">
                            <div class="common-card" style="box-shadow: none;">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <div class="mb-3 field_error">
                                            <label for="title" class="form-label black-color f-600">Enter Youtube Title</label>
                                            <input type="text" name="title" class="form-control" id="title" value="" aria-describedby="banner_title" placeholder="Enter Youtube Title">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3 field_error">
                                            <label for="description" class="form-label black-color f-600">Enter Youtube Video Embed (link/src)</label>
                                            <input type="url" name="link" class="form-control" id="link" value="" aria-describedby="link" placeholder="Enter Youtube Video Embed (link/src)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-center mb-3">
                                <button type="button" id="upload-model-close-btn" class="btn common-btn" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" id="upload-model-submit-btn" class="w-50 btn outline-btn">Add<i class="bi bi-floppy ms-2"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteFileVideo" tabindex="-1" aria-labelledby="deleteFileLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="text-capitalize text-center letter-space f-600 black-color">Are you Sure?</h4>
                    <h6 class="text-color text-center mt-3">Do you really want to delete the <b class="main-color">Video</b> ?</h6>
                    <img src="{{ assets('admin/images/delete.png') }}" alt="image" class="img-fluid">
                </div>
                <form action="" method="get" id="delete_form_video">
                    @csrf
                    <div class="modal-footer justify-content-center mb-3">
                        <button type="button" class="btn outline-btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn common-btn">Yes, Delete</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="editFileAchieve" tabindex="-1" aria-labelledby="editFileLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="text-capitalize text-center letter-space f-600 black-color mb-3">Edit Badges</h4>

                    <form action="{{ route('admin.manage.affiliate-badges.update') }}" method="post" enctype="multipart/form-data" id="update_form_achieve">
                        @csrf
                        <div class="edit-ebook">
                            <input type="hidden" id="redirect_url" value="{{ route('admin.manage.affiliate-badges') }}">
                            <div class="common-card" style="box-shadow: none;">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <div class="mb-3 field_error">
                                            <label for="editTitle" class="form-label black-color f-600">Enter Title</label>
                                            <input type="text" name="title" class="form-control" id="editTitleAchieve" value="" aria-describedby="banner_title" placeholder="Enter Title">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="mb-3 field_error">
                                                <label for="editDescription" class="form-label black-color f-600">Enter Description</label>
                                                <textarea name="description" id="editDescriptionAchieve" placeholder="Enter Description" class="form-control" cols="30" rows="5"></textarea>
                                            </div>
                                        </div>
                                        <input type="hidden" id="editIdAchieve" name="id" value="">
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="editImageInput" class="form-label black-color f-600">Upload Image</label>
                                            <div class="file-upload d-flex align-items-center mb-3 field">
                                                <div class="file btn black-color upload-btn">
                                                    <span id="edit_image_name_achieve">
                                                        Upload Image
                                                    </span>
                                                    <i class="bi bi-file-image ms-2 main-color"></i>
                                                    <input type="file" name="image" accept="image/png, image/jpg, image/jpeg" id="editImageInputAchieve" />
                                                </div>
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

    <div class="modal fade" id="uploadFileAchieve" tabindex="-1" aria-labelledby="uploadFileLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="text-capitalize text-center letter-space f-600 black-color mb-3">Add Achievement</h4>

                    <form action="{{ route('admin.manage.affiliate-badges.save') }}" method="post" enctype="multipart/form-data" id="create_form_achieve">
                        @csrf
                        <div class="edit-ebook">
                            <input type="hidden" id="redirect_url" value="{{ route('admin.manage.affiliate-badges') }}">
                            <div class="common-card" style="box-shadow: none;">
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
                                                <label for="description" class="form-label black-color f-600">Enter Description</label>
                                                <textarea name="description" id="description" class="form-control" placeholder="Enter Description" cols="30" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="imageInput100" class="form-label black-color f-600">Upload Image</label>
                                            <div class="file-upload d-flex align-items-center mb-3 field">
                                                <div class="file btn black-color upload-btn">
                                                    <span id="image_name100">
                                                        Upload Image
                                                    </span>
                                                    <i class="bi bi-file-image ms-2 main-color"></i>
                                                    <input type="file" data-num="100" name="image" accept="image/png, image/jpg, image/jpeg" id="imageInput100" />
                                                </div>
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

    <div class="modal fade" id="deleteFileAchieve" tabindex="-1" aria-labelledby="deleteFileLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="text-capitalize text-center letter-space f-600 black-color">Are you Sure?</h4>
                    <h6 class="text-color text-center mt-3">Do you really want to delete the <b class="main-color">Achievement</b> ?</h6>
                    <img src="{{ assets('admin/images/delete.png') }}" alt="image" class="img-fluid">
                </div>
                <form action="" method="get" id="delete_form_achieve">
                    @csrf
                    <div class="modal-footer justify-content-center mb-3">
                        <button type="button" class="btn outline-btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn common-btn">Yes, Delete</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</main>
<!-- End Main -->
<script>
    $('#uploadFile, #uploadFileVideo, #uploadFileAchieve').on('hidden.bs.modal', function(e) {
        $("#image_name200").text("Upload Image");
        $("#image_name100").text("Upload Image");
        $(this).find('form').trigger('reset');
    })

    $(document).on('click', "#imgEditBtn", function() {
        $("#edit_image_name").text($(this).data('img'));
        $("#editId").val($(this).data('id'));
        $("#editTitle").val($(this).data('title'));
        $("#editDescription").val($(this).data('description'));
        $("#editDesignation").val($(this).data('designation'));
        $("#editFile").modal('show');
    });

    $(document).on('click', "#imgEditBtnVideo", function() {
        $("#editIdVideo").val($(this).data('id'));
        $("#editTitleVideo").val($(this).data('title'));
        $("#editLinkVideo").val($(this).data('link'));
        $("#editFileVideo").modal('show');
    });

    $(document).on('click', "#imgEditBtnAchieve", function() {
        $("#edit_image_name_achieve").text($(this).data('img'));
        $("#editIdAchieve").val($(this).data('id'));
        $("#editTitleAchieve").val($(this).data('title'));
        $("#editDescriptionAchieve").val($(this).data('description'));
        $("#editDesignationAchieve").val($(this).data('designation'));
        $("#editFileAchieve").modal('show');
    });


    $(document).ready(function() {
        $(document).on('click', ".common-btn", function() {
            $("#" + $(this).data('id')).submit();
        });

        $(document).on('click', ".preview", function() {
            let name = $(this).data('name');
            $(".banner").addClass('d-none');
            $(".become-a-member").addClass('d-none');
            $(".testimonial").addClass('d-none');
            $(".youtube").addClass('d-none');
            $(".testimonials").addClass('d-none');
            $("." + name).removeClass('d-none');
            $("#review-modal").modal('show');
        });

        $('.pmoCarousel').owlCarousel({
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

        $.validator.addMethod('filesize', function(value, element, param) {
            return this.optional(element) || (element.files[0].size <= param * 1000000)
        }, 'File size must be less than {0} MB');
        $('#create_form').validate({
            rules: {
                title: {
                    required: true,
                },
                designation: {
                    required: true,
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
                designation: {
                    required: true,
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
        $('#create_form_video').validate({
            rules: {
                title: {
                    required: true,
                },
                link: {
                    required: true,
                    url: true
                },
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                // error.addClass("invalid-feedback");
                element.addClass("border border-danger");
                element.closest(".form-check").addClass("border border-danger");
            },
            highlight: function(element, errorClass, validClass) {
                $('.please-wait').hide();

            },
            unhighlight: function(element, errorClass, validClass) {
                // $(element).removeClass("text-danger");
                $(element).removeClass("border border-danger");
                $(element).closest(".form-check").removeClass("border border-danger");
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                form.submit();
            }
        });
        $('#update_form_video').validate({
            rules: {
                title: {
                    required: true,
                },
                link: {
                    required: true,
                    url: true
                },
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                // error.addClass("invalid-feedback");
                element.addClass("border border-danger");
                element.closest(".form-check").addClass("border border-danger");
            },
            highlight: function(element, errorClass, validClass) {
                $('.please-wait').hide();

            },
            unhighlight: function(element, errorClass, validClass) {
                // $(element).removeClass("text-danger");
                $(element).removeClass("border border-danger");
                $(element).closest(".form-check").removeClass("border border-danger");
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                form.submit();
            }
        });
        $('#create_form_achieve').validate({
            rules: {
                title: {
                    required: true,
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
        $('#update_form_achieve').validate({
            rules: {
                title: {
                    required: true,
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


    const validateForm = () => {
        let val = CKEDITOR.instances['post_text'].getData().trim();
        if (val != undefined && val != null && val != '') {
            return true;
        }
        $(".cke_1.cke_chrome").attr("style", "border: 1px solid red !important;");
        return false;
    }

    document.getElementById('editImageInput').addEventListener('change', function(event) {
        const fileInput = event.target;
        if (fileInput.files.length > 0) {
            const selectedFile = fileInput.files[0];
            $("#edit_image_name").text(selectedFile.name);
        }
    });
    document.getElementById('editImageInputAchieve').addEventListener('change', function(event) {
        const fileInput = event.target;
        if (fileInput.files.length > 0) {
            const selectedFile = fileInput.files[0];
            $("#edit_image_name_achieve").text(selectedFile.name);
        }
    });

    $(document).on("change", "*[id^='imageInput']", function(event) {
        let num = $(this).data('num');
        const fileInput = event.target;
        if (fileInput.files.length > 0) {
            const selectedFile = fileInput.files[0];
            // Display the audio image
            const objectURL = URL.createObjectURL(selectedFile);
            $("#image_name" + num).text(selectedFile.name);
        }
    })
</script>
@endsection