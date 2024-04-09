@extends('layouts.admin.app')
@push('css')
<link rel="stylesheet" href="{{ assets('admin/css/manage-podcasts.css') }}" />
<link rel="stylesheet" href="{{ assets('admin/css/edit-podcast.css') }}" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.3.2/ckeditor.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropzone@5.9.2/dist/min/dropzone.min.css">
@endpush
@push('js')
<script src="{{ assets('admin/js/text-editor.js') }}"></script>
@endpush
@section('content')
<!-- Main -->
<!-- Main -->
<main class="main-container dashboard">
    <div class="main-title d-flex align-items-center">
        <div class="page-title d-flex align-items-center">
            <a href="{{ route('admin.manage.home') }}"><i class="bi bi-arrow-left-circle-fill main-color me-3"></i></a>
            <h3 class="font-weight-bold black-color">Manage Youtube Videos</h3>
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
    <div class="row ">
        <div class="col-md-12">
            <div class="search-items page-content">

                <div class="search-box ms-auto">
                    <!-- <form action="" method="get">
                        <div class="input-group mb-2  ms-auto">
                            <input type="text" class="form-control common-shadow" name="search" value="{{ request()->has('search') ? request('search') : '' }}" placeholder="Search by product title" aria-describedby="basic-addon2">
                            <button class="search-btn"><i class="bi bi-search"></i></button>
                            <button class="search-btn bg-danger" type="button" onclick="location.replace('{{ route('admin.product') }}')"><i class="bi bi-arrow-clockwise"></i></button>
                        </div>
                    </form> -->
                </div>

                <a href="javascript:void(0)" style="width: 15%;"><button data-bs-toggle="modal" data-bs-target="#uploadFile" class="common-btn">Add Video<i class="bi bi-plus-circle ms-2"></i></button></a>
            </div>
            <div class="mt-1">
                <div class="transaction-details">
                    <div class="">
                        <div class="owl-carouse row">
                            @forelse ($data as $item)
                            <div class="slid col-4 mb-4">
                                <div class="box-slid common-card float w-100">
                                    <div class="img-box">
                                        <iframe src="{{ $item->link }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                    </div>
                                    <p style="overflow: hidden; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; height: 23px;" class="px-3 mt-2">{{ $item->title ?? 'NA' }}</p>
                                    <div class="d-flex mt-2">
                                        <a href="javascript:void(0)"><button class="outline-btn" data-bs-toggle="modal" onclick="$('#delete_form').attr('action','{{ route('admin.manage.videos.delete', encrypt_decrypt('encrypt', $item->id)) }}')" data-bs-target="#deleteFile">Delete</button></a>
                                        <a href="javascript:void(0)"><button id="imgEditBtn" class="common-btn ms-2" data-id="{{ encrypt_decrypt('encrypt', $item->id) }}" data-title="{{ $item->title }}" data-link="{{ $item->link }}">Edit Video</button></a>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center mt-5">
                                <img width="300" src="{{ assets('admin/images/no-data.svg') }}" alt="">
                                <h4 class="p-4 text-center my-2 w-100">No videos found</h4>
                            </div>
                            @endforelse
                            <div class="d-flex justify-content-center">
                                {{$data->appends(Request::except('page'))->links('pagination::bootstrap-4')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="editFile" tabindex="-1" aria-labelledby="editFileLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="text-capitalize text-center letter-space f-600 black-color mb-3">Edit Video</h4>
                
                <form action="{{ route('admin.manage.videos.update') }}" method="post" enctype="multipart/form-data" id="update_form">
                    @csrf
                    <div class="edit-ebook">
                        <input type="hidden" id="redirect_url" value="{{ route('admin.manage.videos') }}">
                        <div class="common-card" style="box-shadow: none;">
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <div class="mb-3 field_error">
                                        <label for="editTitle" class="form-label black-color f-600">Enter Youtube Title</label>
                                        <input type="text" name="title" class="form-control" id="editTitle" value="" aria-describedby="banner_title" placeholder="Enter Youtube Title">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="mb-3 field_error">
                                            <label for="editDescription" class="form-label black-color f-600">Enter Youtube Video Embed (link/src)</label>
                                            <input type="url" name="link" id="editLink" placeholder="Enter Youtube Video Embed (link/src)" class="form-control"></input>
                                        </div>
                                    </div>
                                    <input type="hidden" id="editId" name="id" value="">
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
                <h4 class="text-capitalize text-center letter-space f-600 black-color mb-3">Add Video</h4>
                <form action="{{ route('admin.manage.videos.save') }}" enctype="multipart/form-data" method="post" id="create_form">
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

<div class="modal fade" id="deleteFile" tabindex="-1" aria-labelledby="deleteFileLabel" aria-hidden="true">
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
<style>
    .dz-image-preview .dz-image {
        height: 150px !important;
    }

    .dz-image-preview .dz-image img {
        object-fit: cover !important;
        object-position: center !important;
        width: 120px !important;
        height: 120px !important;
        border-radius: 20px;
        position: relative;
        display: block;
        overflow: hidden;
        z-index: 10;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.0/dropzone.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script type="text/javascript">

    $('#uploadFile').on('hidden.bs.modal', function(e) {
        $(this).find('form').trigger('reset');
    })

    $(function() {
        $('[data-bs-toggle="tooltip"]').tooltip();
    });

    $(document).on('click', "#imgEditBtn", function() {
        $("#editId").val($(this).data('id'));
        $("#editTitle").val($(this).data('title'));
        $("#editLink").val($(this).data('link'));
        $("#editFile").modal('show');
    });

    $(document).ready(function() {
        $('#create_form').validate({
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
                let formData = new FormData(form);
                $.ajax({
                    type: 'post',
                    url: form.action,
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $("#preloader").show()
                    },
                    complete: function() {
                        $("#preloader").hide()
                    },
                    success: function(response) {
                        if (response.status == 200) {


                            Swal.fire(
                                'Success',
                                response.message,
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    var url = $('#redirect_url').val();
                                    if (response.redirect) {
                                        window.location = response.route;
                                    }
                                    if (url !== undefined || url != null) {
                                        window.location = url;
                                    } else {
                                        location.reload(true);
                                    }
                                }
                            });;

                            return false;
                        }

                        if (response.status == 201) {

                            Swal.fire(
                                'Error',
                                response.message,
                                'error'
                            );

                            console.log(response.message);
                            return false;
                        }
                    },
                    error: function(data) {
                        if (data.status == 422) {
                            let li_htm = '';
                            var form = $("#create_form");
                            $.each(data.responseJSON.errors, function(k, v) {
                                const $input = form.find(
                                    `input[name=${k}],select[name=${k}],textarea[name=${k}]`
                                );
                                if ($input.next('small').length) {
                                    $input.next('small').html(v);
                                    if (k == 'services' || k == 'membership') {
                                        $('#myselect').next('small').html(v);
                                    }
                                } else {
                                    $input.after(
                                        `<small class='text-danger'>${v}</small>`
                                    );
                                    if (k == 'services' || k == 'membership') {
                                        $('#myselect').after(
                                            `<small class='text-danger'>${v[0]}</small>`
                                        );
                                    }
                                }
                                li_htm += `<li>${v}</li>`;
                            });

                            return false;
                        } else {


                            Swal.fire(
                                'Error',
                                data.statusText,
                                'error'
                            );
                            return false;
                        }
                    }
                });
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
                let formData = new FormData(form);
                $.ajax({
                    type: 'post',
                    url: form.action,
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $("#preloader").show()
                    },
                    complete: function() {
                        $("#preloader").hide()
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire(
                                'Success',
                                response.message,
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    var url = $('#redirect_url').val();
                                    if (response.redirect) {
                                        window.location = response.route;
                                    }
                                    if (url !== undefined || url != null) {
                                        window.location = url;
                                    } else {
                                        location.reload(true);
                                    }
                                }
                            });;

                            return false;
                        }

                        if (response.status == 201) {

                            Swal.fire(
                                'Error',
                                response.message,
                                'error'
                            );

                            console.log(response.message);
                            return false;
                        }
                    },
                    error: function(data) {
                        if (data.status == 422) {
                            let li_htm = '';
                            var form = $("#create_form");
                            $.each(data.responseJSON.errors, function(k, v) {
                                const $input = form.find(
                                    `input[name=${k}],select[name=${k}],textarea[name=${k}]`
                                );
                                if ($input.next('small').length) {
                                    $input.next('small').html(v);
                                    if (k == 'services' || k == 'membership') {
                                        $('#myselect').next('small').html(v);
                                    }
                                } else {
                                    $input.after(
                                        `<small class='text-danger'>${v}</small>`
                                    );
                                    if (k == 'services' || k == 'membership') {
                                        $('#myselect').after(
                                            `<small class='text-danger'>${v[0]}</small>`
                                        );
                                    }
                                }
                                li_htm += `<li>${v}</li>`;
                            });

                            return false;
                        } else {


                            Swal.fire(
                                'Error',
                                data.statusText,
                                'error'
                            );
                            return false;
                        }
                    }
                });
            }
        });
    });
</script>
@endsection