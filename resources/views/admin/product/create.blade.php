@extends('layouts.admin.app')
@push('css')
<link rel="stylesheet" href="{{ asset('admin/css/add-new-podcast.css') }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropzone@5.9.2/dist/min/dropzone.min.css">
@endpush
@push('js')
{{-- <script src="{{ asset('admin/js/edit-podcast.js') }}"></script> --}}
<script src="https://cdn.ckeditor.com/4.23.0-lts/standard/ckeditor.js"></script>
@endpush
@section('content')
<main class="main-container dashboard">
    <div class="main-title d-flex align-items-center">
        <div class="page-title d-flex align-items-center">
            <a href="{{ route('admin.product') }}"><i class="bi bi-arrow-left-circle-fill main-color me-3"></i></a>
            <h3 class="font-weight-bold black-color">
                Add New Product
            </h3>
        </div>
        <div class="profile-link">
            <a href="#">
                <div class="d-flex align-items-center">
                    <div class="profile-pic">
                        <img src="{{ isset(auth()->user()->profile) ? asset("uploads/profile/".auth()->user()->profile) : asset('admin/images/no-image.jpg')}}" alt="profile image" class="img-fluid me-2" />
                    </div>
                    <div class="button-link">
                        <a href="{{ route('admin.profile') }}" class="profile-name">{{auth()->user()->name ?? 'Admin Profile'}}<i class="bi bi-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="page-content">
            <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data" id="create_form">
                @csrf
                <input type="hidden" id="redirect_url" value="{{ route('admin.product') }}">
                <div class="edit-ebook">
                    <div class="common-card">

                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="mb-3 field_error">
                                    <label for="name" class="form-label black-color f-600">Product Name</label>
                                    <input type="text" class="form-control" name="name" id="name" value="" aria-describedby="name" placeholder="Enter Product Name" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3 field_error">
                                    <label for="name" class="form-label black-color f-600">Product Price</label>
                                    <input type="number" min="0.1" step="0.01" class="form-control" name="price" id="price" value="" aria-describedby="price" placeholder="Enter Product Price" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="name" class="form-label black-color f-600">Upload Product Thumbnail
                                        Photos</label>
                                    <div class="file-upload d-flex align-items-center mb-3 field">
                                        <div class="file btn black-color upload-btn">
                                            <span id="image_name">
                                                Upload Photos
                                            </span> <i class="bi bi-file-image ms-2 main-color"></i>
                                            <input type="file" name="thumbnail" accept="image/png, image/jpg, image/jpeg" id="imageInput" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="book-img">
                                    <img src="{{ asset('admin/images/book.jpg') }}" alt="image" id="imageDisplay" class="img-fluid" />
                                </div>
                            </div>
                            <!-- <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label black-color f-600">Product Image</label>
                                    <div class="dropzone m-3" id="multipleImage">
                                        <div class="dz-default dz-message">
                                            <span>Click once inside the box to upload an image
                                                <br>
                                                <small class="text-danger">Make sure the image size is less than 1 MB</small>
                                            </span>
                                        </div>
                                    </div>
                                    <input type="hidden" id="arrayOfImage" name="array_of_image" value="">
                                </div>
                            </div> -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label black-color f-600">Product Description</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="5" placeholder="Type your description"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label for="exampleFormControlTextarea1" class="form-label black-color f-600">Product Cancellation Policy</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="cancellation_policy" rows="3" placeholder="Enter cancellation policy"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="d-flex mt-3 mb-4">
                        <a href="{{ route('admin.product') }}"><button type="button" class="outline-btn">
                                Cancel
                            </button></a>
                        <a><button class="common-btn ms-2">Create New Product<i class="bi bi-floppy ms-2"></i></button></a>
                    </div>
                </div>
                <form>
        </div>
    </div>
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.0/dropzone.js"></script>
<script type="text/javascript">
    let arrOfImg = [];

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
        url: "{{ route('admin.product.image.upload') }}",
        removedfile: function(file) {
            var name = file.upload.filename;
            $.ajax({
                type: 'post',
                url: '{{ route("admin.product.image.delete") }}',
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
                            $('.dz-default.dz-message').hide();
                        } else $('.dz-default.dz-message').show();
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
                    $('.dz-default.dz-message').hide();
                } else $('.dz-default.dz-message').show();
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
    console.log(arrOfImg);

    $(document).ready(function() {
        $.validator.addMethod('filesize', function (value, element, param) {
            return this.optional(element) || (element.files[0].size <= param * 1000000)
        }, 'File size must be less than {0} MB');
        $('#create_form').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 200,
                },
                price: {
                    required: true,
                },
                description: {
                    required: true,
                    maxlength: 191,
                },
                cancellation_policy: {
                    required: true,
                    maxlength: 191,
                },
                thumbnail: {
                    required: true,
                    filesize: 1
                },
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                // error.addClass("invalid-feedback");
                element.addClass("border border-danger");
                element.closest(".file").addClass("border border-danger");
            },
            highlight: function(element, errorClass, validClass) {
                $('.please-wait').hide();
            },
            unhighlight: function(element, errorClass, validClass) {
                // $(element).removeClass("text-danger");
                $(element).removeClass("border border-danger");
                $(element).closest(".file").removeClass("border border-danger");
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
                    beforeSend: function () {
                        $("#preloader").show()
                    },
                    complete: function() {
                        $("#preloader").hide()
                    },
                    success: function(response) {
                        if (response.status) {
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

                        if (!response.status) {
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

    $(document).on('change', '#imageInput', function(event) {
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



    document.getElementById('resetBtn').addEventListener('click', function(event) {


        const audioPlayer = document.getElementById('audioPlayer');
        const audioInput = document.getElementById('audioInput');
        $("#audio_name").text("Upload File");
        audioPlayer.src = "";

        $("#audio_file_container").html(
            `<input type="file" name="audio_file" accept="audio/*"    id="audioInput" />`)

    });
</script>
@endsection