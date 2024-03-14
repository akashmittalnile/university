@extends('layouts.admin.app')
@push('css')
<link rel="stylesheet" href="{{ assets('admin/css/user-management.css') }}" />
<link rel="stylesheet" href="{{ assets('admin/css/manage-podcasts.css') }}" />
<link rel="stylesheet" href="{{ assets('admin/css/edit-podcast.css') }}" />
<style>
    a .outline-btn{
        border: 1px solid rgb(236, 70, 70);
        color: rgb(236, 70, 70);
    }
    a .outline-btn:hover{
        background-color: rgb(236, 70, 70);
    }
</style>
@endpush
@push('js')
<script src="{{ assets('admin/js/dashboard.js') }}"></script>
@endpush
@section('content')
<main class="main-container dashboard">
    <div class="main-title d-flex align-items-center">
        <div class="page-title d-flex align-items-center">
            <h3 class="font-weight-bold black-color">
                Manage Social Media Links
            </h3>

        </div>
        <div class="profile-link">
            <a href="#">
                <div class="d-flex align-items-center">
                    <div class="profile-pic">
                        <img src="{{ isset(auth()->user()->profile) ? assets("uploads/profile/".auth()->user()->profile) : assets('admin/images/no-image.jpg')}}" alt="profile image" class="img-fluid me-2" />
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
                <div class="transaction-details">
                    <div class="d-flex align-items-center justify-content-end mb-3">
                        <!-- <a href="{{ route('admin.manage.testimonial') }}"><button class="btn common-btn top-btn me-4">Manage Testimonials</button></a> -->
                        <button data-bs-toggle="modal" data-bs-target="#uploadFile" class="btn common-btn top-btn me-4">Add Social Media Links <i class="bi bi-plus-circle ms-2"></i></button>
                    </div>

                    <div class="transation-detail-box">
                        <div class="pay-details">
                            <table class="table table-hover common-shadow">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-capitalize">
                                            S.No.
                                        </th>
                                        <th scope="col" class="text-capitalize">
                                            Image
                                        </th>
                                        <th scope="col" class="text-capitalize">
                                            Link
                                        </th>
                                        <th scope="col" class="text-capitalize text-center">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $key => $item)
                                    <tr>
                                        <td style="width: 7%;" class="text-capitalize">{{ $key + 1 }}</td>
                                        <td style="width: 7%;"> <img style="object-fit: cover; object-position: center;border: 3px solid #3fab40;border-radius: 50%;padding: 3px;" width="50" height="50" src="{{ assets('uploads/socialmedia/'.$item->image) }}" alt=""> </td>
                                        <td style="width: 60%;">{{ $item->link }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <button id="imgEditBtn" data-id="{{ encrypt_decrypt('encrypt', $item->id) }}" data-link="{{ $item->link }}" data-img="{{ $item->image }}" class="common-btn ms-2">
                                                        Edit
                                                    </button>
                                                <a href="javascript:void(0)"><button class="outline-btn ms-2" data-bs-toggle="modal" onclick="$('#delete_form').attr('action','{{ route('admin.social.media.delete', encrypt_decrypt('encrypt', $item->id)) }}')" data-bs-target="#deleteFile" >Delete</button></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td align="center" colspan="5">No records found</td>
                                    </tr>
                                    @endforelse
                            </table>
                        </div>
                        <div class="d-flex justify-content-center">
                            {{$data->appends(Request::except('page'))->links('pagination::bootstrap-4')}}
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
                <h4 class="text-capitalize text-center letter-space f-600 black-color mb-3">Edit Social Media Link</h4>

                <form action="{{ route('admin.social.media.update') }}" method="post" enctype="multipart/form-data" id="update_form">
                    @csrf
                    <div class="edit-ebook">
                        <input type="hidden" id="redirect_url" value="{{ route('admin.social.media') }}">
                        <div class="common-card" style="box-shadow: none;">
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="imageInput" class="form-label black-color f-600">Upload Image</label>
                                        <div class="file-upload d-flex align-items-center mb-3 field">
                                            <div class="file btn black-color upload-btn">
                                                <span id="edit_image_name">
                                                    Upload Image
                                                </span>
                                                <i class="bi bi-file-image ms-2 main-color"></i>
                                                <input type="file" name="file" accept="image/png, image/jpg, image/jpeg" id="editImageInput" />
                                            </div>
                                            <input type="hidden" id="editId" name="id" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="mb-3 field_error">
                                            <label for="editLink" class="form-label black-color f-600">Enter Link</label>
                                            <input type="text" name="link" class="form-control" id="editLink" value="" aria-describedby="link" placeholder="Enter Link">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center mb-3">
                            <button type="button" id="upload-model-close-btn" class="btn common-btn" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="upload-model-submit-btn" class="w-50 btn outline-btn">Update<i class="bi bi-floppy ms-2"></i></button>
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
                <h4 class="text-capitalize text-center letter-space f-600 black-color mb-3">Add Social Media Link</h4>

                <form action="{{ route('admin.social.media.save') }}" method="post" enctype="multipart/form-data" id="create_form">
                    @csrf
                    <div class="edit-ebook">
                        <input type="hidden" id="redirect_url" value="{{ route('admin.social.media') }}">
                        <div class="common-card" style="box-shadow: none;">
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="imageInput" class="form-label black-color f-600">Upload Image</label>
                                        <div class="file-upload d-flex align-items-center mb-3 field">
                                            <div class="file btn black-color upload-btn">
                                                <span id="image_name">
                                                    Upload Image
                                                </span>
                                                <i class="bi bi-file-image ms-2 main-color"></i>
                                                <input type="file" name="file" accept="image/png, image/jpg, image/jpeg" id="imageInput" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="mb-3 field_error">
                                            <label for="link" class="form-label black-color f-600">Enter Link</label>
                                            <input type="text" name="link" class="form-control" id="link" value="" aria-describedby="link" placeholder="Enter Link">
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
                <h6 class="text-color text-center mt-3">Do you really want to delete the social media link ?</h6>
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

<script>
    $(document).on('click', "#imgEditBtn", function() {
        $("#edit_image_name").text($(this).data('img'));
        $("#editId").val($(this).data('id'));
        $("#editLink").val($(this).data('link'));
        $("#editFile").modal('show');
    });
    $(document).ready(function() {
        $('#uploadFile').on('hidden.bs.modal', function(e) {
            $("#image_name").text("Upload Image");
            $(this).find('form').trigger('reset');
        })
    
        $.validator.addMethod('filesize', function(value, element, param) {
            return this.optional(element) || (element.files[0].size <= param * 1000000)
        }, 'File size must be less than {0} MB');

        $('#create_form').validate({
            rules: {
                link: {
                    required: true,
                    url: true
                },
                file: {
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
                        console.log(data);
                    }
                });
            }
        });
        $('#update_form').validate({
            rules: {
                link: {
                    required: true,
                    url: true
                },
                file: {
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
                        console.log(data);
                    }
                });
            }
        });
    });

    document.getElementById('imageInput').addEventListener('change', function(event) {
        const fileInput = event.target;
        if (fileInput.files.length > 0) {
            const selectedFile = fileInput.files[0];
            $("#image_name").text(selectedFile.name);
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