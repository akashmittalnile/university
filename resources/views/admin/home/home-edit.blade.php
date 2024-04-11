@extends('layouts.admin.app')
@section('heading', 'Manage '. $home->section_code ?? 'NA')
@section('back', route('admin.manage.home'))
@push('css')
<link rel="stylesheet" href="{{ assets('admin/css/add-new-podcast.css') }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropzone@5.9.2/dist/min/dropzone.min.css">
@endpush
@push('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.3.2/ckeditor.js"></script>
<script>
    CKEDITOR.replace("post_text", {
        language: "en",
        uiColor: "#dddddd",
        height: 250,
        resize_dir: 'vertical'
    });
    CKEDITOR.instances['post_text'].on('change', function() { 
        let value = CKEDITOR.instances['post_text'].getData().trim();
        if(value!=undefined && value!=null && value!=''){
            $(".cke_1.cke_chrome").removeAttr("style")
        } else $(".cke_1.cke_chrome").attr("style", "border: 1px solid red !important;")
    });
</script>
<script src="https://cdn.ckeditor.com/4.23.0-lts/standard/ckeditor.js"></script>
@endpush
@section('content')

    <div class="row">
        <div class="page-content">
            <form action="{{ route('admin.manage.home.save') }}" method="post" enctype="multipart/form-data" id="create_form">
                @csrf
                <input type="hidden" id="redirect_url" value="{{ route('admin.manage.home') }}">
                <div class="edit-ebook">
                    <div class="common-card">

                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="mb-3 field_error">
                                    <label for="title" class="form-label black-color f-600">Enter Title</label>
                                    <input type="text" class="form-control" name="title" id="title" value="{{ $home->title ?? '' }}" aria-describedby="title" placeholder="Enter Title" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="imageInput" class="form-label black-color f-600">Upload Image</label>
                                    <div class="file-upload d-flex align-items-center mb-3 field">
                                        <div class="file btn black-color upload-btn">
                                            <span id="image_name">
                                                @if(isset($home->image))
                                                    {{ $home->image }}
                                                @else
                                                    Upload Image
                                                @endif
                                            </span> <i class="bi bi-file-image ms-2 main-color"></i>
                                            <input type="file" name="image" accept="image/png, image/jpg, image/jpeg" id="imageInput" />
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="{{ encrypt_decrypt('encrypt', $home->id) }}">
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 field_error">
                                    <label for="description" class="form-label black-color f-600">Enter Description</label>
                                    <textarea class="post-area form-control" id="description" name="description" rows="5" placeholder="Enter Description">{{ $home->description ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="d-flex mt-3 mb-4">
                        <a href="{{ route('admin.manage.home') }}"><button type="button" class="outline-btn">
                                Cancel
                            </button></a>
                        <button type="submit" class="common-btn ms-2">Update<i class="bi bi-floppy ms-2"></i></button>
                    </div>
                </div>
                <form>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.0/dropzone.js"></script>
<script type="text/javascript">

    $(document).ready(function() {
        $.validator.addMethod('filesize', function (value, element, param) {
            return this.optional(element) || (element.files[0].size <= param * 1000000)
        }, 'File size must be less than {0} MB');
        $('#create_form').validate({
            rules: {
                title: {
                    required: true,
                },
                description: {
                    required: true,
                },
                @if(isset($home->image))
                image: {
                    filesize: 1
                },
                @else
                image: {
                    required: true,
                    filesize: 1
                },
                @endif
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                element.addClass("border border-danger");
                element.closest(".file").addClass("border border-danger");
            },
            highlight: function(element, errorClass, validClass) {
                $('.please-wait').hide();

            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass("border border-danger");
                $(element).closest(".file").removeClass("border border-danger");
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                form.submit();
            }
        });
    });

    $(document).on('change', '#imageInput', function(event) {
        const fileInput = event.target;
        if (fileInput.files.length > 0) {
            const selectedFile = fileInput.files[0];
            $("#image_name").text(selectedFile.name);
        }
    });
</script>
@endsection