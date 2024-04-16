@extends('layouts.admin.app')
@section('heading', 'Manage Home')
@push('css')
<link rel="stylesheet" href="{{ assets('admin/css/admin-home.css') }}" />

<link rel="stylesheet" href="{{ assets('admin/css/manage-podcasts.css') }}" />
<link rel="stylesheet" href="{{ assets('admin/css/edit-podcast.css') }}" />

<link rel="stylesheet" href="{{ assets('frontend/css/home.css') }}">
<link rel="stylesheet" href="{{ assets('frontend/css/mark-network.css') }}">
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
                                                <h3 data-bs-toggle="collapse" data-bs-target="#collapseBanner">
                                                    <span class="edit-pmu-collapse-icon"><i class="bi bi-card-image"></i></span> {{ $banner->title ?? 'Banner' }}<i class="bi bi-chevron-down" ></i></h3>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0)" class="preview" data-name="banner"><button class="common-btn ms-2"> Preview </button></a>
                                        </div>
                                    </div>
                                    <div class="edit-pmu-section collapse-course-form collapse" id="collapseBanner">
                                        <form action="{{ route('admin.manage.home.banner.save') }}" method="post" enctype="multipart/form-data" id="banner_form">@csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3 field_error">
                                                        <label for="title" class="form-label black-color f-600">Enter Title</label>
                                                        <input type="text" required class="form-control" name="banner_title" id="title" value="{{ $banner->title ?? '' }}" aria-describedby="title" placeholder="Enter Title" />
                                                        @if(isset($banner->id))
                                                        <input type="hidden" name="banner_id" value="{{ encrypt_decrypt('encrypt', $banner->id) }}">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="@if(isset($banner->image)) col-md-5 @else col-md-6 @endif">
                                                    <div class="mb-3">
                                                        <label for="imageInput{{ $banner->id ?? 452 }}" class="form-label black-color f-600">Upload Image</label>
                                                        <div class="file-upload d-flex align-items-center mb-3 field flex-column">
                                                            <div class="file btn black-color upload-btn">
                                                                <span id="image_name{{ $banner->id ?? 452 }}">
                                                                    @if(isset($banner->image))
                                                                    {{ $banner->image }}
                                                                    @else
                                                                    Upload Image
                                                                    @endif
                                                                </span> <i class="bi bi-file-image ms-2 main-color"></i>
                                                                <input type="file" @if(!isset($banner->image)) required @endif data-num="{{ $banner->id ?? 452 }}" name="banner_image" accept="image/png, image/jpg, image/jpeg" id="imageInput{{ $banner->id ?? 452 }}" />
                                                            </div>
                                                            <div class="alert alert-danger mt-2 text-dark" role="alert">
                                                                Please upload an image greater than or equal to recommended size (1348 X 600)
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if(isset($banner->image))
                                                <div class="col-md-1">
                                                    <a target="_blank" href="{{ assets('uploads/home/'.$banner->image) }}"><img width="50" style="margin-top: 33.5%;" src="{{ assets('admin/images/gallery.png') }}" alt=""></a>
                                                </div>
                                                @endif
                                                <div class="col-md-12">
                                                    <div class="mb-3 field_error">
                                                        <label for="description" class="form-label black-color f-600">Enter Description</label>
                                                        <textarea class="post-area form-control" required id="description" name="banner_description" rows="3" placeholder="Enter Description">{{ $banner->description ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="d-flex mt-3 mb-4">
                                                    <button type="button" data-id="banner_form" class="common-btn ms-2">Update<i class="bi bi-floppy ms-2"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                
                                <div class="edit-pmu-form-item">
                                    <div class="edit-pmu-heading">
                                        <div class="edit-pmu-text d-flex flex-row align-items-center">
                                            <div class="edit-pmu-text-title mx-2">
                                                <h3 data-bs-toggle="collapse" data-bs-target="#collapseTestimonial"><span class="edit-pmu-collapse-icon"><i class="bi bi-person-vcard"></i>
                                                    </span> Testimonials<i class="bi bi-chevron-down" ></i></h3>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0)" class="preview" data-name="testimonials"><button class="common-btn ms-2"> Preview </button></a>
                                        </div>
                                    </div>
                                    <div class="edit-pmu-section collapse-course-form collapse" id="collapseTestimonial">
                                        <div class="text-end">
                                            <a href="javascript:void(0)" style="width: 19%;"><button data-bs-toggle="modal" data-bs-target="#uploadFile" class="outline-btn ms-2">Add Testimonial<i class="bi bi-plus-circle ms-2"></i></button></a>
                                        </div>
                                        <div class="transaction-details">
                                            <div class="achievements-scroll">
                                                <div class="owl-carouse row">
                                                    @forelse ($test as $item)
                                                    <div class="slid col-md-3 mb-4">
                                                        <div class="testimonials-box-slid">
                                                            <div class="testimonials-image">
                                                                <img  src="{{ assets("uploads/testimonial/$item->image") }}" >
                                                            </div>
                                                            <p class="testimonials-title">{{ $item->title ?? 'NA' }}</p>
                                                            <div class="testimonials-action">
                                                                <button class="outline-delete-btn" data-bs-toggle="modal" onclick="$('#delete_form').attr('action','{{ route('admin.manage.testimonial.delete', encrypt_decrypt('encrypt', $item->id)) }}')" data-bs-target="#deleteFile">Delete</button>
                                                                <button id="imgEditBtn" class="Edit-btn" data-id="{{ encrypt_decrypt('encrypt', $item->id) }}" data-title="{{ $item->title }}" data-description="{{ $item->description }}" data-designation="{{ $item->designation }}" data-img="{{ $item->image }}">Edit Testimonial</button>
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

                                <div class="edit-pmu-form-item">
                                    <div class="edit-pmu-heading">
                                        <div class="edit-pmu-text d-flex flex-row align-items-center">
                                            <div class="edit-pmu-text-title mx-2">
                                                <h3 data-bs-toggle="collapse" data-bs-target="#collapseVideo"><span class="edit-pmu-collapse-icon"><i class="bi bi-play-btn"></i>
                                                    </span> Youtube Video<i class="bi bi-chevron-down" ></i></h3>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0)" class="preview" data-name="youtube"><button class="common-btn ms-2"> Preview </button></a>
                                        </div>
                                    </div>
                                    <div class="edit-pmu-section collapse-course-form collapse" id="collapseVideo">
                                        <div class="text-end">
                                            <a href="javascript:void(0)" style="width: 15%;"><button data-bs-toggle="modal" data-bs-target="#uploadFileVideo" class="outline-btn">Add Video<i class="bi bi-plus-circle ms-2"></i></button></a>
                                        </div>
                                        <div class="transaction-details">
                                            <div class="achievements-scroll">
                                                <div class="owl-carouse row">
                                                    @forelse ($video as $item)
                                                    <div class="slid col-md-3 mb-4">
                                                        <div class="video-box-slid">
                                                            <div class="video-media">
                                                                <iframe src="{{ $item->link }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                                            </div>
                                                            <p  class="videos-title">{{ $item->title ?? 'NA' }}</p>
                                                            <div class="videos-action">
                                                                <button class="outline-delete-btn" data-bs-toggle="modal" onclick="$('#delete_form_video').attr('action','{{ route('admin.manage.videos.delete', encrypt_decrypt('encrypt', $item->id)) }}')" data-bs-target="#deleteFileVideo">Delete</button>
                                                                <button id="imgEditBtnVideo" class="Edit-btn" data-id="{{ encrypt_decrypt('encrypt', $item->id) }}" data-title="{{ $item->title }}" data-link="{{ $item->link }}">Edit Video</button>
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
                                
                                <div class="edit-pmu-form-item">
                                    <div class="edit-pmu-heading">
                                        <div class="edit-pmu-text d-flex flex-row align-items-center">
                                            <div class="edit-pmu-text-title mx-2">
                                                <h3 data-bs-toggle="collapse" data-bs-target="#collapseAchieve">
                                                    <span class="edit-pmu-collapse-icon"><i class="bi bi-award"></i>
                                                    </span> Key Achievements<i class="bi bi-chevron-down" ></i></h3>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0)" class="preview" data-name="testimonial"><button class="common-btn ms-2"> Preview </button></a>
                                        </div>
                                    </div>
                                    <div class="edit-pmu-section collapse-course-form collapse" id="collapseAchieve">
                                        <div class="text-end">
                                            <a href="javascript:void(0)" style="width: 17%;"><button data-bs-toggle="modal" data-bs-target="#uploadFileAchieve" class="outline-btn ms-2">Add Key Achievement<i class="bi bi-plus-circle ms-2"></i></button></a>
                                        </div>
                                        <div class="transaction-details">
                                            <div class="achievements-scroll">
                                                <div class="owl-carouse row">
                                                    @forelse ($badges as $item)
                                                    <div class="slid col-md-3 mb-4">
                                                        <div class="achievements-box-slid">
                                                            <div class="achievements-img" >
                                                                <img  src="{{ assets("uploads/badges/$item->path") }}">
                                                            </div>
                                                            <p class="achievements-title">{{ $item->title ?? 'NA' }}</p>
                                                            <div class="achievements-action">
                                                                <button class="outline-delete-btn" data-bs-toggle="modal" onclick="$('#delete_form_achieve').attr('action','{{ route('admin.manage.affiliate-badges.delete', encrypt_decrypt('encrypt', $item->id)) }}')" data-bs-target="#deleteFileAchieve">Delete</button>
                                                               <button  id="imgEditBtnAchieve" class="Edit-btn" data-id="{{ encrypt_decrypt('encrypt', $item->id) }}" data-title="{{ $item->title }}" data-description="{{ $item->description }}" data-img="{{ $item->path }}">Edit Key Achievement</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @empty
                                                    <div class="text-center mt-5">
                                                        <img width="300" src="{{ assets('admin/images/no-data.svg') }}" alt="">
                                                        <h4 class="p-4 text-center my-2 w-100">No key achievements found</h4>
                                                    </div>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="edit-pmu-form-item">
                                    <div class="edit-pmu-heading">
                                        <div class="edit-pmu-text d-flex flex-row align-items-center">
                                            <div class="edit-pmu-text-title mx-2">
                                                <h3 data-bs-toggle="collapse" data-bs-target="#collapseCommunity">
                                                    <span class="edit-pmu-collapse-icon"><i class="bi bi-person-gear"></i>
                                                    </span> {{ $data->title ?? 'Community' }}<i class="bi bi-chevron-down" ></i></h3>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0)" class="preview" data-name="become-a-member"><button class="common-btn ms-2"> Preview </button></a>
                                        </div>
                                    </div>
                                    <div class="edit-pmu-section collapse-course-form collapse" id="collapseCommunity">
                                        <form action="{{ route('admin.manage.home.community.save') }}" method="post" enctype="multipart/form-data" id="community_form">@csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3 field_error">
                                                        <label for="community_title" class="form-label black-color f-600">Enter Title</label>
                                                        <input type="text" required class="form-control" name="community_title" id="community_title" value="{{ $data->title ?? '' }}" aria-describedby="community_title" placeholder="Enter Title" />
                                                    </div>
                                                </div>
                                                <div class="@if(isset($data->image)) col-md-5 @else col-md-6 @endif">
                                                    <div class="mb-3">
                                                        <label for="imageInput{{ $data->id ?? 225 }}" class="form-label black-color f-600">Upload Image</label>
                                                        <div class="file-upload d-flex align-items-center mb-3 field">
                                                            <div class="file btn black-color upload-btn">
                                                                <span id="image_name{{ $data->id ?? 225 }}">
                                                                    @if(isset($data->image))
                                                                    {{ $data->image }}
                                                                    @else
                                                                    Upload Image
                                                                    @endif
                                                                </span> <i class="bi bi-file-image ms-2 main-color"></i>
                                                                <input type="file" @if(!isset($data->image)) required @endif data-num="{{ $data->id ?? 225 }}" name="community_image" accept="image/png, image/jpg, image/jpeg" id="imageInput{{ $data->id ?? 225 }}" />
                                                                @if(isset($data->id))
                                                                <input type="hidden" name="community_id" value="{{ encrypt_decrypt('encrypt', $data->id) }}">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if(isset($data->image))
                                                <div class="col-md-1">
                                                    <a target="_blank" href="{{ assets('uploads/home/'.$data->image) }}"><img width="50" style="margin-top: 33.5%;" src="{{ assets('admin/images/gallery.png') }}" alt=""></a>
                                                </div>
                                                @endif
                                                <div class="col-md-12">
                                                    <div class="mb-3 field_error">
                                                        <label for="community_description" class="form-label black-color f-600">Enter Description</label>
                                                        <textarea class="post-area form-control" required id="community_description" name="community_description" rows="3" placeholder="Enter Description">{{ $data->description ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="d-flex mt-3 mb-4">
                                                    <button type="button" data-id="community_form" class="common-btn ms-2">Update<i class="bi bi-floppy ms-2"></i></button>
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
                    @if(isset($home->image))
                    <section class="banner d-none" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('../public/uploads/home/{{$home->image}}' ); background-repeat: no-repeat; background-size: cover;">
                    @else
                    <section class="banner d-none" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('../public/frontend/images/8.jpg' ); background-repeat: no-repeat; background-size: cover;">
                    @endif
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
                        <h1 class="mt-4 text-center f-600">Key Achievements</h1>
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
                                                <div class="affiliate-Badges-content">
                                                    <h6>{{ $val->title ?? '' }}</h6>
                                                    <div>{!! $val->description ?? '' !!}</div>
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

                    @if(isset($community->image))
                    <div class="become-a-member d-none" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('../public/uploads/home/{{$community->image}}' ); background-repeat: no-repeat; background-size: cover;">
                    @else
                    <div class="become-a-member d-none" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('../public/frontend/images/membership-1.jpg' ); background-repeat: no-repeat; background-size: cover;">
                    @endif
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
                                            <div class="file-upload d-flex flex-column align-items-center mb-3 field">
                                                <div class="file btn black-color upload-btn">
                                                    <span id="edit_image_name">
                                                        Upload Image
                                                    </span>
                                                    <i class="bi bi-file-image ms-2 main-color"></i>
                                                    <input type="file" name="image" accept="image/png, image/jpg, image/jpeg" id="editImageInput" />
                                                </div>
                                                <div class="alert alert-danger mt-2 text-dark w-100" role="alert">
                                                    Please upload an image greater than or equal to recommended size (370 X 180)
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
                                            <div class="file-upload d-flex flex-column align-items-center mb-3 field">
                                                <div class="file btn black-color upload-btn">
                                                    <span id="image_name200">
                                                        Upload Image
                                                    </span>
                                                    <i class="bi bi-file-image ms-2 main-color"></i>
                                                    <input type="file" data-num="200" name="image" accept="image/png, image/jpg, image/jpeg" id="imageInput200" />
                                                </div>
                                                <div class="alert alert-danger mt-2 text-dark w-100" role="alert">
                                                    Please upload an image greater than or equal to recommended size (370 X 180)
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
                                                <label for="editDescriptionAchieve" class="form-label black-color f-600">Enter Description</label>
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
                    <h4 class="text-capitalize text-center letter-space f-600 black-color mb-3">Add Key Achievement</h4>

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
                                                <label for="makeMeSummernote1" class="form-label black-color f-600">Enter Description</label>
                                                <textarea name="description" id="makeMeSummernote1" class="form-control" placeholder="Enter Description" cols="50" rows="20"></textarea>
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
                    <h6 class="text-color text-center mt-3">Do you really want to delete the <b class="main-color">Key Achievement</b> ?</h6>
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

<!-- End Main -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
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
        $("#editDesignationAchieve").val($(this).data('designation'));
        $("#editDescriptionAchieve").summernote({
            height: 200
        });
        $("#editDescriptionAchieve").summernote('code', $(this).data('description'));
        $("#editFileAchieve").modal('show');
    });


    $(document).ready(function() {
        $("#makeMeSummernote1").summernote({
            height: 200
        });
        
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

        $('#customers-testimonials1').owlCarousel({
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
        $('#banner_form').validate({
            rules: {
                banner_title: {
                    required: true,
                },
                banner_description: {
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
                    filesize: 5
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
                    filesize: 5
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
                    filesize: 5
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
                    filesize: 5
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