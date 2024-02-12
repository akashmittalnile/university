@extends('layouts.admin.app')
@push('css')
<link rel="stylesheet" href="{{ asset('admin/css/manage-podcasts.css') }}" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.3.2/ckeditor.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropzone@5.9.2/dist/min/dropzone.min.css">
@endpush
@push('js')
<script src="{{ asset('admin/js/text-editor.js') }}"></script>
@endpush
@section('content')
<!-- Main -->
<!-- Main -->
<main class="main-container dashboard">
    <div class="main-title d-flex align-items-center">
        <div class="page-title d-flex align-items-center">
            
            <h3 class="font-weight-bold black-color">Manage Image</h3>
        </div>
        <div class="profile-link">
            <a href="#">
                <div class="d-flex align-items-center">
                    <div class="profile-pic">
                        <img src="{{ isset(auth()->user()->profile) ? asset("uploads/profile/".auth()->user()->profile) : asset('admin/images/no-image.jpg')}}" alt="profile image" class="img-fluid me-2">
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


                {{-- <a href="#"><button class="outline-btn ms-2">Podcast Payment Transaction
                            Loans<i class="bi bi-coin ms-2"></i></button></a> --}}
                <a href="javascript:void(0)" style="width: 15%;"><button data-bs-toggle="modal" data-bs-target="#uploadFile" class="common-btn ms-2">Add Image<i class="bi bi-plus-circle ms-2"></i></button></a>
            </div>
            <div class="mt-1">
                <div class="transaction-details">
                    <div class="">
                        <div class="owl-carouse row">
                            @forelse ($gallery as $item)
                            <div class="slid col-4 mb-4">
                                <div class="box-slid common-card float w-100">
                                    <div class="img-box" style="height: 75%;">
                                        <img id style="height: 100%;" src="{{ asset("uploads/images/$item->path") }}" alt="image" class="img-fluid">
                                    </div>
                                    <div class="d-flex mt-4">
                                        <a href="javascript:void(0)"><button class="outline-btn" data-bs-toggle="modal" onclick="$('#delete_form').attr('action','{{ route('admin.uploaded.image.delete', encrypt_decrypt('encrypt', $item->id)) }}')" data-bs-target="#deleteFile">Delete</button></a>
                                        <a href="javascript:void(0)"><button id="imgEditBtn" class="common-btn ms-2" data-id="{{ encrypt_decrypt('encrypt', $item->id) }}" data-img="{{ asset("uploads/images/$item->path") }}">Edit Image</button></a>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Copy Image URL" style="background: #eee; padding: 10px 15px; border-radius: 50%; color: black; margin-left: 15px" href="javascript:void(0)" onclick="copyToClipboard('copy_{{ $item->id }}')"><i class="bi bi-copy"></i></a>
                                        
                                    </div>
                                    <input style="opacity: 0; position: absolute;" type="text" id="copy_{{ $item->id }}" value="{{ asset("uploads/images/$item->path") }}">
                                </div>
                            </div>
                            @empty
                            <div class="text-center mt-5">
                                <img width="300" src="{{ asset('admin/images/no-data.svg') }}" alt="">
                                <h4 class="p-4 text-center my-2 w-100">No Image found</h4>
                            </div>
                            @endforelse
                            <div class="d-flex justify-content-center">
                                {{$gallery->appends(Request::except('page'))->links('pagination::bootstrap-4')}}
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
                <h4 class="text-capitalize text-center letter-space f-600 black-color">Edit Image</h4>
                <div class="col-md-12">
                    <form action="{{ route('admin.image.save') }}" method="post" id="editImgForm" enctype="multipart/form-data">
                        @csrf
                        <div class="file-upload-img d-flex align-items-center mb-3 field w-100">
                            <div class="file btn black-color upload-btn mx-auto">
                                <div>
                                    <img style="width: 160px; height: 160px; object-fit: cover; object-position: center; overflow: hidden; border-radius: 8px" src="" id="editImg" alt="">
                                </div>
                                <div class="text-center mt-3">
                                    <span id="image_name" style="color: #000; cursor: pointer !important;">
                                        Click here to change image
                                    </span>
                                    <input type="hidden" name="update" value="1">
                                    <input type="hidden" id="imgId" name="id" value="">
                                    <input style="cursor: pointer !important;" type="file" name="thumbnail" accept="image/png, image/jpg, image/jpeg" id="imageInput" />
                                </div>
                                
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center mb-3">
                            <button type="button" id="edit-model-close-btn" class="btn common-btn" data-bs-dismiss="modal">Cancel</button>
                            <button disabled type="submit" id="edit-model-submit-btn" class="w-50 btn outline-btn">Update<i class="bi bi-floppy ms-2"></i></button>
                        </div>
                    </form>
                </div>
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
                <h4 class="text-capitalize text-center letter-space f-600 black-color">Add Images</h4>
                <div class="col-md-12">
                    <div class="mb-3">
                        <div class="dropzone m-3" id="multipleImage">
                            <div class="dz-default dz-message">
                                <span>Click once inside the box to upload an image
                                    <br>
                                    <small class="text-danger">Make sure the image size is less than 1 MB</small>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <form action="{{ route('admin.image.save') }}" method="post">
                        @csrf
                        <input type="hidden" name="array_of_image" id="arrayOfImage" value="">
                        <div class="modal-footer justify-content-center mb-3">
                            <button type="button" id="upload-model-close-btn" class="btn common-btn" data-bs-dismiss="modal">Cancel</button>
                            <button disabled type="submit" id="upload-model-submit-btn" class="w-50 btn outline-btn">Create<i class="bi bi-floppy ms-2"></i></button>
                        </div>
                    </form>
                </div>
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
                <h6 class="text-color text-center mt-3">Do you really want to delete the <b class="main-color">Image</b> ?</h6>
                <img src="images/delete.png" alt="image" class="img-fluid">
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
    .dz-image-preview .dz-image{
        height: 150px !important;
    }
    .dz-image-preview .dz-image img{
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
    $(function() {
        $('[data-bs-toggle="tooltip"]').tooltip();
    });

    const copyToClipboard = (id) => {
        document.getElementById(id).select();
        document.execCommand('copy');
    }

    let arrOfImg = [];

    $(document).on('click', "#imgEditBtn", function() {
        $("#editImg").attr('src', $(this).data('img'));
        $("#imgId").val($(this).data('id'));
        $("#imgId").val($(this).data('id'));
        $("#editFile").modal('show');
    });

    $(document).on('change', '#imageInput', function(event) {
        const fileInput = event.target;
        const imageDisplay = document.getElementById('editImg');
        if (fileInput.files.length > 0) {
            const selectedFile = fileInput.files[0];
            const objectURL = URL.createObjectURL(selectedFile);
            imageDisplay.src = objectURL;
        }
        $("#edit-model-submit-btn").attr("disabled", false);
    });

    Dropzone.options.multipleImage = {
        maxFilesize: 1,
        renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
            return time + file.name;
        },
        acceptedFiles: ".jpeg,.jpg,.png",
        timeout: 5000,
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        url: "{{ route('admin.image.upload') }}",
        removedfile: function(file) {
            var name = file.upload.filename;
            $.ajax({
                type: 'post',
                url: '{{ route("admin.image.delete") }}',
                data: {
                    filename: name,
                    _token: "{{csrf_token()}}"
                },
                success: function(data) {
                    if (data.status) {
                        console.log("File deleted successfully!!");
                        if (data.key == 2) {
                            const inde = arrOfImg.indexOf(data.file_name);
                            if (inde > -1) {
                                arrOfImg.splice(inde, 1);
                                $("#arrayOfImage").val(JSON.stringify(arrOfImg));
                            }
                        }
                        let oplength = arrOfImg.length;
                        if (oplength > 0) {
                            $("#upload-model-submit-btn").attr("disabled", false);
                            $('.dz-default.dz-message').hide();
                        } else {
                            $("#upload-model-submit-btn").attr("disabled", true);
                            $('.dz-default.dz-message').show();
                        } 
                    } else {
                        console.log("File not deleted!!");
                    }
                },
                error: function(e) {
                    console.log(e);
                }
            });
            var fileRef;
            return (fileRef = file.previewElement) != null ?
                fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },
        success: function(file, response) {
            if (response.key == 1) {
                arrOfImg.push(response.file_name);
                $("#arrayOfImage").val(JSON.stringify(arrOfImg));
                file.upload.filename = response.file_name;
                let oplength = arrOfImg.length;
                if (oplength > 0) {
                    $("#upload-model-submit-btn").attr("disabled", false);
                    $('.dz-default.dz-message').hide();
                } else {
                    $("#upload-model-submit-btn").attr("disabled", true);
                    $('.dz-default.dz-message').show();
                } 
            }
        },
        error: function(file, response) {
            let oplength = arrOfImg.length;
            if (oplength > 0) {
                $('.dz-default.dz-message').hide();
            } else $('.dz-default.dz-message').show();
            console.log(file.previewElement);
            var fileRef;
            return (fileRef = file.previewElement) != null ? fileRef.parentNode.removeChild(file.previewElement) : null;
        }
    };
</script>
@endsection