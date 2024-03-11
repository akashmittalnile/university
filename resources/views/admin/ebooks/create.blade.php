@extends('layouts.admin.app')
@push('css')
    <link rel="stylesheet" href="{{ assets('admin/css/edit-podcast.css') }}" />
@endpush

@section('content')
    <main class="main-container dashboard">
        <div class="main-title d-flex align-items-center">
            <div class="page-title d-flex align-items-center">
                <a href="{{ route('admin.ebooks') }}"><i class="bi bi-arrow-left-circle-fill main-color me-3"></i></a>
                <h3 class="font-weight-bold black-color">Add New E-Book</h3>
            </div>
            <div class="profile-link">
                <a href="#">
                    <div class="d-flex align-items-center">
                        <div class="profile-pic">
                            <img src="{{ isset(auth()->user()->profile) ? assets("uploads/profile/".auth()->user()->profile) : assets('admin/images/no-image.jpg')}}" alt="profile image"
                                class="img-fluid me-2">
                        </div>
                        <div class="button-link">
                            <a href="{{ route('admin.profile') }}" class="profile-name">{{auth()->user()->name ?? 'Admin Profile'}}<i
                                    class="bi bi-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row ">
            <div class="page-content">
                <form action="{{ route('admin.ebooks.store') }}" method="post" enctype="multipart/form-data" id="create_form">
                    @csrf
                    <div class="edit-ebook">
                        <input type="hidden" id="redirect_url" value="{{ route('admin.ebooks') }}">
                        <div class="common-card">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <div class="mb-3 field_error">
                                        <label for="name" class="form-label black-color f-600">Enter E-Book Name</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            value="{{ $ebook ? $ebook->name : '' }}" aria-describedby="name"
                                            placeholder="Enter E-Book Name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="name" class="form-label black-color f-600">Browse & Upload E-PUB or
                                            PDF</label>
                                        <div class="file-upload d-flex align-items-center mb-3 field">
                                            <div class="file btn black-color upload-btn"> 
                                                <span id="audio_name">
                                                    @if(isset($ebook->pdf_file))
                                                        {{ $ebook->pdf_file ?? "" }}
                                                    @else
                                                        Upload E-PUB or PDF
                                                    @endif
                                                </span>
                                                <i class="bi bi-file-earmark-arrow-up ms-2 main-color"></i>
                                                <input type="file" name="pdf_file" accept=".pdf" id="audioInput" />
                                            </div>
                                            @if(isset($ebook->pdf_file))
                                            <a target="_black" class="mx-2" id="pdfredirect" href="{{ assets("uploads/ebooks/$ebook->pdf_file") }}"><img src="{{ assets('admin/images/pdf.svg') }}" width="30" alt="No pdf found"></a>
                                            @else
                                            <a target="_black" class="d-none mx-2" id="pdfredirect" href=""><img src="{{ assets('admin/images/pdf.svg') }}" width="30" alt="No pdf found"></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="name" class="form-label black-color f-600">Upload Thumbnail
                                            Photos</label>
                                        <div class="file-upload d-flex align-items-center mb-3 field">
                                            <div class="file btn black-color upload-btn">
                                                <span id="image_name">
                                                    @if(isset($ebook->thumbnail))
                                                        {{ $ebook->thumbnail ?? "" }}
                                                    @else
                                                        Upload Photos
                                                    @endif
                                                </span> 
                                                <i class="bi bi-file-image ms-2 main-color"></i>
                                                <input type="file" name="thumbnail" accept="image/png, image/jpg, image/jpeg" id="imageInput" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <div class="book-img">
                                                <img src="{{ $ebook ? assets("uploads/ebooks/$ebook->thumbnail") : assets('admin/images/book.jpg') }}"
                                                    alt="image" id="imageDisplay" class="img-fluid" />
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-check">
                                                <h6 class="black-color f-600">Select Plans</h6>
                                                <div class="row">
                                                    @foreach ($plans as $item)
                                                        <div class="col-md-4">
                                                            <div class="rounded shadow bg-white p-2 d-flex my-2">
                                                                <div class="form-group my-auto">
                                                                    <input type="radio" name="plans"
                                                                        @if ($ebook && in_array($item->id, $ebook->plans)) checked @endif
                                                                        value="{{ $item->id }}"
                                                                        id="plan{{ $item->id }}">
                                                                    <label
                                                                        for="plan{{ $item->id }}">{{ $item->name }}
                                                                        ({{ strtoupper($item->currency) . ' ' . $item->price }})
                                                                    </label>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1"
                                            class="form-label black-color f-600">Description</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="5"
                                            placeholder="Type your description">{{ $ebook ? $ebook->description : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div>
                                        <label for="exampleFormControlTextarea1"
                                            class="form-label black-color f-600">Cancellation Policy</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="cancellation_policy" rows="3"
                                            placeholder="Enter cancellation policy">{{ $ebook ? $ebook->cancellation_policy : '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex mt-3 mb-4">
                            <a href="{{ route('admin.ebooks') }}"><button type="button" class="outline-btn" type="button">Cancel</button></a>
                            <a><button class="common-btn ms-2">Create New E-Book<i class="bi bi-floppy ms-2"></i></button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="{{ assets('admin/js/dashboard.js') }}"></script>
    <script>
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
                    free: {
                        required: true,
                        maxlength: 191,

                    },
                    pdf_file: {
                        required: true,
                        maxlength: 191,

                    },
                    thumbnail: {
                        required: true,
                        filesize: 1
                    },
                    plans: {
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
                        beforeSend: function () {
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
        document.getElementById('audioInput').addEventListener('change', function(event) {
            const fileInput = event.target;
            const audioPlayer = document.getElementById('audioPlayer');

            if (fileInput.files.length > 0) {
                const selectedFile = fileInput.files[0];
                const objectURL = URL.createObjectURL(selectedFile);
                $("#audio_name").text(selectedFile.name);
                $("#pdfredirect").removeClass('d-none');
                $("#pdfredirect").css({'z-index': 1000});
                $("#pdfredirect").attr({"href": URL.createObjectURL(event.target.files[0])});
                // Set the audio source to the selected file
            }
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
    </script>
@endsection
