@extends('layouts.admin.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/add-new-podcast.css') }}" />
@endpush
@push('js')
    <script src="{{ asset('admin/js/edit-podcast.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.23.0-lts/standard/ckeditor.js"></script>
@endpush
@section('content')
    <main class="main-container dashboard">
        <div class="main-title d-flex align-items-center">
            <div class="page-title d-flex align-items-center">
                <a href="{{ route('admin.podcasts') }}"><i class="bi bi-arrow-left-circle-fill main-color me-3"></i></a>
                <h3 class="font-weight-bold black-color">
                    Edit Podcast
                </h3>
            </div>
            <div class="profile-link">
                <a href="#">
                    <div class="d-flex align-items-center">
                        <div class="profile-pic">
                            <img src="{{ isset(auth()->user()->profile) ? asset("uploads/profile/".auth()->user()->profile) : asset('admin/images/no-image.jpg')}}" alt="profile image"
                                class="img-fluid me-2" />
                        </div>
                        <div class="button-link">
                            <a href="{{ route('admin.profile') }}" class="profile-name">{{auth()->user()->name ?? 'Admin Profile'}}<i
                                    class="bi bi-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="page-content">
                <form action="{{ route('admin.podcasts.update', encrypt_decrypt('encrypt', $podcast->id)) }}"
                    method="post" enctype="multipart/form-data" id="create_form">
                    @csrf
                    <input type="hidden" id="redirect_url"
                        value="{{ route('admin.podcasts') }}">
                    <div class="edit-ebook">
                        <div class="common-card">

                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="mb-3 field_error">
                                        <label for="name" class="form-label black-color f-600">Podcast Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ $podcast ? $podcast->name : '' }}" aria-describedby="name"
                                            placeholder="Enter Podcast Name" />
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="name" class="form-label black-color f-600">Browse & Upload Podcast
                                            Audio File</label>
                                        <div class="file-upload d-flex align-items-center mb-3 field">
                                            <div class="file btn black-color upload-btn">
                                                <span id="audio_name">
                                                    @if(isset($podcast->audio_file))
                                                        {{ $podcast->audio_file ?? '' }}
                                                    @else
                                                        Upload File
                                                    @endif
                                                </span> <i
                                                    class="bi bi-file-earmark-arrow-up ms-2 main-color"></i>
                                                <input type="file" name="audio_file" accept="audio/*" id="audioInput" />
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label black-color f-600">Upload Podcast Thumbnail
                                            Photos</label>
                                        <div class="file-upload d-flex align-items-center mb-3 field">
                                            <div class="file btn black-color upload-btn">
                                                <span id="image_name">
                                                    @if(isset($podcast->thumbnail))
                                                        {{ $podcast->thumbnail ?? '' }}
                                                    @else
                                                        Upload Photos
                                                    @endif
                                                </span> <i
                                                    class="bi bi-file-image ms-2 main-color"></i>
                                                <input type="file" name="thumbnail" accept="image/png, image/jpg, image/jpeg" id="imageInput" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="book-img">
                                        <img src="{{ $podcast ? asset("uploads/podcasts/$podcast->thumbnail") : asset('admin/images/book.jpg') }}"
                                            alt="image" id="imageDisplay" class="img-fluid" />
                                        <div class="cancel-icon">
                                            <div class="top-right">
                                                <a href="#" id="resetBtn">
                                                    <div class="icon-bg">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <audio controls class="mt-3 custom-audio" id="audioPlayer">
                                        <source
                                            src="{{ $podcast ? asset("uploads/podcasts/$podcast->audio_file") : asset('images/audio.mp3') }}"
                                            type="audio/mp3" />
                                        Your browser does not support
                                        the audio element.
                                    </audio>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-check">
                                        <h6 class="black-color f-600">Select Plans</h6>
                                        <div class="row">
                                            @foreach ($plans as $item)
                                                <div class="col-md-3">
                                                    <div class="rounded shadow bg-white p-2 d-flex my-2">
                                                        <div class="form-group-box my-auto">
                                                            <input type="checkbox" name="plans[]"
                                                                @if ($podcast && in_array($item->id, $podcast->plans)) checked @endif
                                                                value="{{ $item->id }}" id="plan{{ $item->id }}">
                                                            <label for="plan{{ $item->id }}">{{ $item->name }}
                                                                ({{ strtoupper($item->currency) . ' ' . $item->price }})
                                                            </label>
                                                        </div>

                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-check">
                                        <h6 class="black-color f-600">Select File Type</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="rounded shadow bg-white p-2 d-flex my-2">
                                                    <div class="form-group-radio my-auto">
                                                        <input type="radio" name="fileType"
                                                            value="1" id="audio" @if($podcast->file_type=='1') checked @endif>
                                                        <label for="audio">
                                                            Audio File
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="rounded shadow bg-white p-2 d-flex my-2">
                                                    <div class="form-group-radio my-auto">
                                                        <input type="radio" name="fileType"
                                                            value="2" id="youtube" @if($podcast->file_type=='2') checked @endif>
                                                        <label for="youtube">
                                                            Youtube Link
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-7 @if($podcast->file_type=='2') d-none @endif" id="audio-form-input">
                                    <div class="mb-3">
                                        <label for="name" class="form-label black-color f-600">Browse & Upload Podcast Audio File</label>
                                        <div class="file-upload d-flex align-items-center mb-3 field">
                                            <div class="file btn black-color upload-btn">
                                                <span id="audio_name">
                                                    @if($podcast->file_type=='1' && isset($podcast->audio_file))
                                                        {{ $podcast->audio_file ?? '' }}
                                                    @else
                                                        Upload File
                                                    @endif
                                                </span> <i class="bi bi-file-earmark-arrow-up ms-2 main-color"></i>
                                                <span id="audio_file_container">
                                                    <input type="file" name="audio_file" accept="audio/*" id="audioInput" />
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-7 @if($podcast->file_type=='1') d-none @endif" id="youtube-form-input">
                                    <div class="mb-3">
                                        <label for="name" class="form-label black-color f-600">Youtube Embed Code</label>
                                        <input type="text" class="form-control" name="audio_file" required value="@if($podcast->file_type=='2' && isset($podcast->audio_file)) {{$podcast->audio_file ?? ''}} @endif" aria-describedby="audio_file" placeholder="Enter Code" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1"
                                            class="form-label black-color f-600">Description</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="5"
                                            placeholder="Type your description"> {{ $podcast ? $podcast->description : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div>
                                        <label for="exampleFormControlTextarea1"
                                            class="form-label black-color f-600">Cancellation Policy</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="cancellation_policy" rows="3"
                                            placeholder="Enter cancellation policy">{{ $podcast ? $podcast->cancellation_policy : '' }}</textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="d-flex mt-3 mb-4">
                            <a href="{{ route('admin.podcasts') }}"><button type="button" class="outline-btn">
                                    Cancel
                                </button></a>
                            <a><button class="common-btn ms-2">
                                    Update<i class="bi bi-floppy ms-2"></i></button></a>
                        </div>
                    </div>
                    <form>
            </div>
        </div>
    </main>
    <script>
        $(document).on("change", "input[name='fileType']", function(){
            let value = $(this).val();
            if(value==1) {
                $("#audio-form-input").removeClass('d-none');   
                $("#youtube-form-input").addClass('d-none');   
            } else {
                $("#audio-form-input").addClass('d-none');   
                $("#youtube-form-input").removeClass('d-none');
            }
        });

        $(document).ready(function() {
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
                    @if (!$podcast)
                    thumbnail: {
                            required: true,
                            maxlength: 191,
                        },
                    @endif


                    description: {
                        required: true,
                        maxlength: 191,

                    },

                },
                errorElement: "span",
                errorPlacement: function(error, element) {
                    // error.addClass("invalid-feedback");
                    element.closest(".field").addClass("border border-danger");
                    element.closest(".field_error").append(error);

                },
                highlight: function(element, errorClass, validClass) {
                    $('.please-wait').hide();

                },
                unhighlight: function(element, errorClass, validClass) {
                    // $(element).removeClass("text-danger");
                    $(element).removeClass("border border-danger");

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
                // Set the audio source to the selected file
                audioPlayer.src = objectURL;
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



        document.getElementById('resetBtn').addEventListener('click', function(event) {


            const audioPlayer = document.getElementById('audioPlayer');
            const audioInput = document.getElementById('audioInput');
            $("#audio_name").text("Upload File");
            audioPlayer.src = "";
            audioInput.reset();

        });
    </script>
@endsection
