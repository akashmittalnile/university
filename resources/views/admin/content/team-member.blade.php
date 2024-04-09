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
            <a href="{{ route('admin.about') }}"><i class="bi bi-arrow-left-circle-fill main-color me-3"></i></a>
            <h3 class="font-weight-bold black-color">Manage Team Member</h3>
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

                <a href="javascript:void(0)" style="width: 21%;"><button data-bs-toggle="modal" data-bs-target="#uploadFile" class="common-btn ms-2">Add Team Member<i class="bi bi-plus-circle ms-2"></i></button></a>
            </div>
            <div class="mt-1">
                <div class="transaction-details">
                    <div class="">
                        <div class="owl-carouse row">
                            @forelse ($data as $item)
                            <div class="slid col-4 mb-4">
                                <div class="box-slid common-card float w-100">
                                    <div class="img-box" style="height: 75%;">
                                        <img id style="height: 350px; width: 350px" src="{{ assets("uploads/team/$item->image") }}" alt="image" class="img-fluid">
                                    </div>
                                    <p style="overflow: hidden; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; height: 23px;" class="px-3 pt-1 mt-2">{{ $item->name ?? 'NA' }}</p>
                                    <div class="d-flex mt-2">
                                        <a href="javascript:void(0)"><button class="outline-btn" data-bs-toggle="modal" onclick="$('#delete_form').attr('action','{{ route('admin.team.member.delete', encrypt_decrypt('encrypt', $item->id)) }}')" data-bs-target="#deleteFile">Delete</button></a>
                                        <a href="javascript:void(0)"><button id="imgEditBtn" class="common-btn ms-2" data-id="{{ encrypt_decrypt('encrypt', $item->id) }}" data-name="{{ $item->name }}" data-company="{{ $item->company_name }}" data-designation="{{ $item->designation }}" data-img="{{ $item->image }}">Edit Detail</button></a>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center mt-5">
                                <img width="300" src="{{ assets('admin/images/no-data.svg') }}" alt="">
                                <h4 class="p-4 text-center my-2 w-100">No team members found</h4>
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
                <h4 class="text-capitalize text-center letter-space f-600 black-color mb-3">Edit Team Member</h4>
                
                <form action="{{ route('admin.team.member.update') }}" method="post" enctype="multipart/form-data" id="update_form">
                    @csrf
                    <div class="edit-ebook">
                        <input type="hidden" id="redirect_url" value="{{ route('admin.team.member') }}">
                        <div class="common-card" style="box-shadow: none;">
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <div class="mb-3 field_error">
                                        <label for="editName" class="form-label black-color f-600">Enter Name</label>
                                        <input type="text" name="name" class="form-control" id="editName" value="" aria-describedby="banner_name" placeholder="Enter Name">
                                    </div>
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
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="mb-3 field_error">
                                            <label for="editCompany" class="form-label black-color f-600">Enter Company Name</label>
                                            <textarea name="company_name" id="editCompany" placeholder="Enter Company Name" class="form-control" cols="30" rows="3"></textarea>
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
                <h4 class="text-capitalize text-center letter-space f-600 black-color mb-3">Add Team Member</h4>

                <form action="{{ route('admin.team.member.save') }}" method="post" enctype="multipart/form-data" id="create_form">
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
                                        <label for="imageInput" class="form-label black-color f-600">Upload Image</label>
                                        <div class="file-upload d-flex align-items-center mb-3 field">
                                            <div class="file btn black-color upload-btn">
                                                <span id="image_name">
                                                    Upload Image
                                                </span>
                                                <i class="bi bi-file-image ms-2 main-color"></i>
                                                <input type="file" name="image" accept="image/png, image/jpg, image/jpeg" id="imageInput" />
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

<div class="modal fade" id="deleteFile" tabindex="-1" aria-labelledby="deleteFileLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="text-capitalize text-center letter-space f-600 black-color">Are you Sure?</h4>
                <h6 class="text-color text-center mt-3">Do you really want to delete the <b class="main-color">Team Member</b> ?</h6>
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
        $("#image_name").text("Upload Image");
        $(this).find('form').trigger('reset');
    })

    $(function() {
        $('[data-bs-toggle="tooltip"]').tooltip();
    });

    $(document).on('click', "#imgEditBtn", function() {
        $("#edit_image_name").text($(this).data('img'));
        $("#editId").val($(this).data('id'));
        $("#editName").val($(this).data('name'));
        $("#editCompany").val($(this).data('company'));
        $("#editDesignation").val($(this).data('designation'));
        $("#editFile").modal('show');
    });

    document.getElementById('imageInput').addEventListener('change', function(event) {
        const fileInput = event.target;
        const imageDisplay = document.getElementById('imageDisplay');

        if (fileInput.files.length > 0) {
            const selectedFile = fileInput.files[0];

            // Display the audio image
            const objectURL = URL.createObjectURL(selectedFile);
            $("#image_name").text(selectedFile.name);
            // Set the audio source to the selected file
            imageDisplay.src = objectURL;
        }
    });

    document.getElementById('editImageInput').addEventListener('change', function(event) {
        const fileInput = event.target;
        if (fileInput.files.length > 0) {
            const selectedFile = fileInput.files[0];
            $("#edit_image_name").text(selectedFile.name);
        }
    });

    $(document).ready(function() {
        $.validator.addMethod('filesize', function(value, element, param) {
            return this.optional(element) || (element.files[0].size <= param * 1000000)
        }, 'File size must be less than {0} MB');
        $('#create_form').validate({
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