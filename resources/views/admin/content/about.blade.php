@extends('layouts.admin.app')
@section('heading', 'Manage About Us')
@push('css')
<link rel="stylesheet" href="{{ assets('admin/css/edit-podcast.css') }}" />
@endpush
@section('content')
<!-- Main -->

    <div class="row">
        <div class="col-md-12">
            <div class="main-cards">
                <div class="e-book-details">
                    <div class="d-flex align-items-center justify-content-end mb-3">
                        <a href="{{ route('admin.team.member') }}"><button class="btn common-btn top-btn me-4">Manage Team Member</button></a>
                        <a href="{{ route('admin.how_we_do_it') }}"><button class="btn common-btn top-btn me-4">Manage How We Do It</button></a>
                    </div>
                    <div class="about-us">
                        <form action="{{ route('admin.about.save') }}" method="post" enctype="multipart/form-data" id="create_form">
                            @csrf
                            <div class="edit-ebook">
                                <input type="hidden" id="redirect_url" value="{{ route('admin.about') }}">
                                <div class="common-card">
                                    <div class="row align-items-center">


                                        <h6 class="mb-3 main-color">Section 1</h6>
                                        <div class="border-bottom row">
                                            <div class="col-md-6">
                                                <div class="mb-3 field_error">
                                                    <label for="sec1_title" class="form-label black-color f-600">Enter Title</label>
                                                    <input type="text" name="sec1_title" class="form-control" id="sec1_title" value="{{ $data['sec1_title'] ?? '' }}" aria-describedby="sec1_title" placeholder="Enter Title">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="imageInput1" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name1">
                                                                @if(isset($data['sec1_image']))
                                                                {{ $data['sec1_image'] ?? "" }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span>
                                                            <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" data-num="1" name="sec1_image" accept="image/png, image/jpg, image/jpeg" id="imageInput1" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="mb-3 field_error">
                                                        <label for="sec1_sub_title" class="form-label black-color f-600">Enter Sub-Title</label>
                                                        <textarea name="sec1_sub_title" class="form-control" id="sec1_sub_title" aria-describedby="sec1_sub_title" placeholder="Enter Sub-Title" cols="30" rows="3">{{ $data['sec1_sub_title'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <h6 class="my-3 main-color">Section 2</h6>
                                        <div class="border-bottom row">
                                            <div class="col-md-6">
                                                <div class="mb-3 field_error">
                                                    <label for="sec2_title" class="form-label black-color f-600">Enter Title</label>
                                                    <input type="text" name="sec2_title" class="form-control" id="sec2_title" value="{{ $data['sec2_title'] ?? '' }}" aria-describedby="sec2_title" placeholder="Enter Title">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="imageInput2" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name2">
                                                                @if(isset($data['sec2_image']))
                                                                {{ $data['sec2_image'] ?? "" }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span>
                                                            <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" data-num="2" name="sec2_image" accept="image/png, image/jpg, image/jpeg" id="imageInput2" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="mb-3 field_error">
                                                        <label for="sec2_sub_title" class="form-label black-color f-600">Enter Sub-Title</label>
                                                        <textarea name="sec2_sub_title" class="form-control" id="sec2_sub_title" aria-describedby="sec2_sub_title" placeholder="Enter Sub-Title" cols="30" rows="3">{{ $data['sec2_sub_title'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <h6 class="my-3 main-color">Section 3</h6>
                                        <div class="border-bottom row">
                                            <div class="col-md-6">
                                                <div class="mb-3 field_error">
                                                    <label for="sec3_title" class="form-label black-color f-600">Enter Title</label>
                                                    <input type="text" name="sec3_title" class="form-control" id="sec3_title" value="{{ $data['sec3_title'] ?? '' }}" aria-describedby="sec3_title" placeholder="Enter Title">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="imageInput3" class="form-label black-color f-600">Upload Background Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name3">
                                                                @if(isset($data['sec3_image']))
                                                                {{ $data['sec3_image'] ?? "" }}
                                                                @else
                                                                Upload Background Image
                                                                @endif
                                                            </span>
                                                            <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" data-num="3" name="sec3_image" accept="image/png, image/jpg, image/jpeg" id="imageInput3" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="mb-3 field_error">
                                                        <label for="sec3_sub_title" class="form-label black-color f-600">Enter Sub-Title</label>
                                                        <textarea name="sec3_sub_title" class="form-control" id="sec3_sub_title" aria-describedby="sec3_sub_title" placeholder="Enter Sub-Title" cols="30" rows="3">{{ $data['sec3_sub_title'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <h6 class="my-3 main-color">Section 4</h6>
                                        <div class="border-bottom row">
                                            <div class="col-md-6">
                                                <div class="mb-3 field_error">
                                                    <label for="sec4_title" class="form-label black-color f-600">Enter Title</label>
                                                    <input type="text" name="sec4_title" class="form-control" id="sec4_title" value="{{ $data['sec4_title'] ?? '' }}" aria-describedby="sec4_title" placeholder="Enter Title">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="imageInput4" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name4">
                                                                @if(isset($data['sec4_image']))
                                                                {{ $data['sec4_image'] ?? "" }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span>
                                                            <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" data-num="4" name="sec4_image" accept="image/png, image/jpg, image/jpeg" id="imageInput4" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="mb-3 field_error">
                                                        <label for="sec4_sub_title" class="form-label black-color f-600">Enter Sub-Title</label>
                                                        <textarea name="sec4_sub_title" class="form-control" id="sec4_sub_title" aria-describedby="sec4_sub_title" placeholder="Enter Sub-Title" cols="30" rows="3">{{ $data['sec4_sub_title'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <h6 class="my-3 main-color">Section 5</h6>
                                        <div class="border-bottom row">
                                            <div class="col-md-4">
                                                <div class="mb-3 field_error">
                                                    <label for="sec5_title" class="form-label black-color f-600">Enter Title</label>
                                                    <input type="text" name="sec5_title" class="form-control" id="sec5_title" value="{{ $data['sec5_title'] ?? '' }}" aria-describedby="sec5_title" placeholder="Enter Title">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="imageInput5" class="form-label black-color f-600">Upload Image 1</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name5">
                                                                @if(isset($data['sec5_image']))
                                                                {{ $data['sec5_image'] ?? "" }}
                                                                @else
                                                                Upload Image 1
                                                                @endif
                                                            </span>
                                                            <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" data-num="5" name="sec5_image" accept="image/png, image/jpg, image/jpeg" id="imageInput5" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="imageInput6" class="form-label black-color f-600">Upload Image 2</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name6">
                                                                @if(isset($data['sec6_image']))
                                                                {{ $data['sec6_image'] ?? "" }}
                                                                @else
                                                                Upload Image 2
                                                                @endif
                                                            </span>
                                                            <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" data-num="6" name="sec6_image" accept="image/png, image/jpg, image/jpeg" id="imageInput6" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="mb-3 field_error">
                                                        <label for="sec5_sub_title" class="form-label black-color f-600">Enter Sub-Title</label>
                                                        <textarea name="sec5_sub_title" class="form-control" id="sec5_sub_title" aria-describedby="sec5_sub_title" placeholder="Enter Sub-Title" cols="30" rows="3">{{ $data['sec5_sub_title'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <h6 class="my-3 main-color">Section 6</h6>
                                        <div class="border-bottom row">
                                            <div class="col-md-6">
                                                <div class="mb-3 field_error">
                                                    <label for="sec6_title" class="form-label black-color f-600">Enter Title</label>
                                                    <input type="text" name="sec6_title" class="form-control" id="sec6_title" value="{{ $data['sec6_title'] ?? '' }}" aria-describedby="sec6_title" placeholder="Enter Title">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="imageInput7" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name7">
                                                                @if(isset($data['sec7_image']))
                                                                {{ $data['sec7_image'] ?? "" }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span>
                                                            <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" data-num="7" name="sec7_image" accept="image/png, image/jpg, image/jpeg" id="imageInput7" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="mb-3 field_error">
                                                        <label for="sec6_sub_title" class="form-label black-color f-600">Enter Sub-Title</label>
                                                        <textarea name="sec6_sub_title" class="form-control" id="sec6_sub_title" aria-describedby="sec6_sub_title" placeholder="Enter Sub-Title" cols="30" rows="3">{{ $data['sec6_sub_title'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <h6 class="my-3 main-color">Section 7</h6>
                                        <div class="border-bottom row">
                                            <div class="col-md-6">
                                                <div class="mb-3 field_error">
                                                    <label for="sec7_title" class="form-label black-color f-600">Enter Title</label>
                                                    <input type="text" name="sec7_title" class="form-control" id="sec7_title" value="{{ $data['sec7_title'] ?? '' }}" aria-describedby="sec7_title" placeholder="Enter Title">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="imageInput8" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name8">
                                                                @if(isset($data['sec8_image']))
                                                                {{ $data['sec8_image'] ?? "" }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span>
                                                            <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" data-num="8" name="sec8_image" accept="image/png, image/jpg, image/jpeg" id="imageInput8" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="mb-3 field_error">
                                                        <label for="sec7_sub_title" class="form-label black-color f-600">Enter Sub-Title</label>
                                                        <textarea name="sec7_sub_title" class="form-control" id="sec7_sub_title" aria-describedby="sec7_sub_title" placeholder="Enter Sub-Title" cols="30" rows="3">{{ $data['sec7_sub_title'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <h6 class="my-3 main-color">Section 8</h6>
                                        <div class="border-bottom row">
                                            <div class="col-md-6">
                                                <div class="mb-3 field_error">
                                                    <label for="sec8_title" class="form-label black-color f-600">Enter Title</label>
                                                    <input type="text" name="sec8_title" class="form-control" id="sec8_title" value="{{ $data['sec8_title'] ?? '' }}" aria-describedby="sec8_title" placeholder="Enter Title">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="imageInput9" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name9">
                                                                @if(isset($data['sec9_image']))
                                                                {{ $data['sec9_image'] ?? "" }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span>
                                                            <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" data-num="9" name="sec9_image" accept="image/png, image/jpg, image/jpeg" id="imageInput9" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="mb-3 field_error">
                                                        <label for="sec8_sub_title" class="form-label black-color f-600">Enter Sub-Title</label>
                                                        <textarea name="sec8_sub_title" class="form-control" id="sec8_sub_title" aria-describedby="sec8_sub_title" placeholder="Enter Sub-Title" cols="30" rows="3">{{ $data['sec8_sub_title'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <h6 class="my-3 main-color">Section 9</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3 field_error">
                                                    <label for="sec9_title" class="form-label black-color f-600">Enter Title</label>
                                                    <input type="text" name="sec9_title" class="form-control" id="sec9_title" value="{{ $data['sec9_title'] ?? '' }}" aria-describedby="sec9_title" placeholder="Enter Title">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="imageInput10" class="form-label black-color f-600">Upload Image</label>
                                                    <div class="file-upload d-flex align-items-center mb-3 field">
                                                        <div class="file btn black-color upload-btn">
                                                            <span id="image_name10">
                                                                @if(isset($data['sec10_image']))
                                                                {{ $data['sec10_image'] ?? "" }}
                                                                @else
                                                                Upload Image
                                                                @endif
                                                            </span>
                                                            <i class="bi bi-file-image ms-2 main-color"></i>
                                                            <input type="file" data-num="10" name="sec10_image" accept="image/png, image/jpg, image/jpeg" id="imageInput10" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="mb-3 field_error">
                                                        <label for="sec9_sub_title" class="form-label black-color f-600">Enter Sub-Title</label>
                                                        <textarea name="sec9_sub_title" class="form-control" id="sec9_sub_title" aria-describedby="sec9_sub_title" placeholder="Enter Sub-Title" cols="30" rows="3">{{ $data['sec9_sub_title'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>




                                    </div>
                                </div>
                                <div class="d-flex mt-3 mb-4">
                                    <!-- <a href="{{ route('admin.ebooks') }}"><button type="button" class="outline-btn" type="button">Cancel</button></a> -->
                                    <a><button class="common-btn ms-2">Submit</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- End Main -->
<script>
    $(document).ready(function() {
        $.validator.addMethod('filesize', function (value, element, param) {
            return this.optional(element) || (element.files[0].size <= param * 1000000)
        }, 'File size must be less than {0} MB');
        $('#create_form').validate({
            rules: {
                sec1_title: {
                    required: true,
                },
                sec1_sub_title: {
                    required: true,
                },
                @if(!isset($data['sec1_image']))
                sec1_image: {
                    required: true,
                    filesize: 5
                },
                @else
                sec1_image: {
                    filesize: 5
                },
                @endif
                sec2_title: {
                    required: true,
                },
                sec2_sub_title: {
                    required: true,
                },
                @if(!isset($data['sec2_image']))
                sec2_image: {
                    required: true,
                    filesize: 5
                },
                @else
                sec2_image: {
                    filesize: 5
                },
                @endif

                sec3_title: {
                    required: true,
                },
                sec3_sub_title: {
                    required: true,
                },
                @if(!isset($data['sec3_image']))
                sec3_image: {
                    required: true,
                    filesize: 5
                },
                @else
                sec3_image: {
                    filesize: 5
                },
                @endif

                sec4_title: {
                    required: true,
                },
                sec4_sub_title: {
                    required: true,
                },
                @if(!isset($data['sec4_image']))
                sec4_image: {
                    required: true,
                    filesize: 5
                },
                @else
                sec4_image: {
                    filesize: 5
                },
                @endif

                sec5_title: {
                    required: true,
                },
                sec5_sub_title: {
                    required: true,
                },
                @if(!isset($data['sec5_image']))
                sec5_image: {
                    required: true,
                    filesize: 5
                },
                @else
                sec5_image: {
                    filesize: 5
                },
                @endif

                sec6_title: {
                    required: true,
                },
                sec6_sub_title: {
                    required: true,
                },
                @if(!isset($data['sec6_image']))
                sec6_image: {
                    required: true,
                    filesize: 5
                },
                @else
                sec6_image: {
                    filesize: 5
                },
                @endif

                sec7_title: {
                    required: true,
                },
                sec7_sub_title: {
                    required: true,
                },
                @if(!isset($data['sec7_image']))
                sec7_image: {
                    required: true,
                    filesize: 5
                },
                @else
                sec7_image: {
                    filesize: 5
                },
                @endif

                sec8_title: {
                    required: true,
                },
                sec8_sub_title: {
                    required: true,
                },
                @if(!isset($data['sec8_image']))
                sec8_image: {
                    required: true,
                    filesize: 5
                },
                @else
                sec8_image: {
                    filesize: 5
                },
                @endif

                sec9_title: {
                    required: true,
                },
                sec9_sub_title: {
                    required: true,
                },
                @if(!isset($data['sec9_image']))
                sec9_image: {
                    required: true,
                    filesize: 5
                },
                @else
                sec9_image: {
                    filesize: 5
                },
                @endif

                @if(!isset($data['sec10_image']))
                sec10_image: {
                    required: true,
                    filesize: 5
                },
                @else
                sec10_image: {
                    filesize: 5
                },
                @endif
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

    $(document).on("change", "*[id^='imageInput']", function(event) {
        let num = $(this).data('num');
        const fileInput = event.target;
        if (fileInput.files.length > 0) {
            const selectedFile = fileInput.files[0];
            // Display the audio image
            const objectURL = URL.createObjectURL(selectedFile);
            $("#image_name"+num).text(selectedFile.name);
        }
    })

</script>
@endsection