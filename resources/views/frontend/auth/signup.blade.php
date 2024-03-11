@extends('layouts.frontend.app')
@push('css')
    <link rel="stylesheet" href="{{ assets('frontend/css/sign-up.css') }}">
@endpush
@section('content')
    <section class="sign-up">
        <div class="container">
            <div class="sign-up-contents">
                <div class="row">
                    <div class="col-md-7">
                        <div class="img-box">
                            <div class="sign-up-head">
                                <h1 class="text-center white-color">Sign Up</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <form action="{{ route('user.register') }}" method="POST" id="signin_form">
                            @csrf
                            <input type="hidden" id="redirect_url" value="{{ route('signin') }}">
                            <h5 class="black-color f-500">Please Enter Your Basic Details</h5>
                            <div class="field">
                                <div class="form-floating mb-3 mt-3">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter your name">
                                    <label for="name">Name</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control" id="phone" name="phone"
                                        maxlength="15" placeholder="Enter your number">
                                    <label for="phone">Phone</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter your email Id">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Create New Password">
                                    <label for="password">Create New Password</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="cnf_password"
                                        name="password_confirmation" placeholder="Confirm Password">
                                    <label for="cnf_password">Confirm Password</label>
                                </div>
                            </div>

                            <!-- <div class="file-upload form-floating d-flex align-items-center mb-3">
                                <div class="file btn black-color upload-btn">
                                    <div id="file-upload-img">
                                        Upload Photo <i class="bi bi-file-image ms-2 main-color"></i>
                                    </div>
                                    <div>
                                        <input type="file" name="file" id="upload-img" accept="image/png, image/jpg, image/jpeg"/>
                                        
                                    </div>
                                </div>
                            </div> -->

                            <div class="form-floating mb-3">
                                <div class="file-upload d-flex align-items-center field">
                                    <div class="file btn black-color upload-btn">
                                        <div id="file-upload-img">
                                            Upload Profile Photo
                                        </div>
                                        <input type="file" name="file" id="upload-img" accept="image/png, image/jpg, image/jpeg"/>
                                        <img style="width: 120px !important" class="m-3 img-fluid img-thumbnail rounded d-none" src="{{assets('admin/images/profile-image.jpg')}}" id="display-img" alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <a href="#"><button class="btn common-btn mb-3">Sign Up</button></a>
                                <p class="text-center black-color f-600 mb-2">Or</p>
                                <p class="text-center black-color mt-0">Already have an account? <a
                                        href="{{ route('signin') }}" class="main-color f-600 sign-link">Sign In</a></p>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        $(document).on('click', '#file-upload-img', function(){
            $("#upload-img").get(0).click();
        })
        $(document).on("change", "#upload-img", function(e){
            $("#display-img").removeClass('d-none');
            $("#display-img").attr("src", URL.createObjectURL(event.target.files[0]));
        })
        $(document).ready(function() {
            $.validator.addMethod('password_match', function(value) {
                return $("input[name=password]").val() == value;
            });

            $.validator.addMethod("AtLeastOnenumber", function(value) {
                return /(?=.*[0-9])/.test(value);
            }, 'At least 1 number is required.');

            $.validator.addMethod("AtLeastOneUpperChar", function(value) {
                return /^(?=.*[A-Z])/.test(value);
            }, 'At least 1 uppercase character is required.');

            $.validator.addMethod("AtLeastOneSpecialChar", function(value) {
                return !/^[A-Za-z0-9 ]+$/.test(value);
            }, 'At least 1 special character is required.');

            $.validator.addMethod("AtLeastOneLowerChar", function(value) {
                return /^(?=.*[a-z])/.test(value);
            }, 'At least 1 lower character is required.');

            $.validator.addMethod("phoneValidate", function(value) {
                return /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im.test(value);
            }, 'Please enter valid phone number.');

            $('#signin_form').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    phone: {
                        required: true,
                        phoneValidate: true,
                    },
                    file: {
                        required: true,
                    },
                    email: {
                        required: true,
                        maxlength: 191,
                        email: true
                    },
                    password: {
                        required: true,
                        maxlength: 191,
                        minlength: 6,
                        AtLeastOnenumber: true,
                        AtLeastOneUpperChar: true,
                        AtLeastOneLowerChar: true,
                        AtLeastOneSpecialChar: true
                    },
                    password_confirmation: {
                        required: true,
                        maxlength: 191,
                        minlength: 6,
                        equalTo: "input[name='password']"
                    },
                },
                errorElement: "span",
                errorPlacement: function(error, element) {
                    // error.addClass("invalid-feedback");
                    element.closest(".file").addClass("border border-danger");
                    element.addClass("border border-danger")
                    error.addClass("invalid-feedback");
                    element.closest(".form-floating").append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $('.please-wait').hide();
                    $(element).addClass("is-invalid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    // $(element).removeClass("text-danger");
                    $(element).removeClass("border border-danger");
                    $(element).closest(".file").removeClass("border border-danger");
                    $(element).removeClass("is-invalid");
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    let formData = new FormData(form);

                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "disableTimeOut": true,
                    }

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
                                var form = $("#signin_form");
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

                                toastr.error(data.statusText);
                                return false;
                            }
                        }
                    });
                }
            });
        });
    </script>
@endpush
