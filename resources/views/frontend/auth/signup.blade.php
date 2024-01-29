@extends('layouts.frontend.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/sign-up.css') }}">
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
                            <h5 class="black-color f-500">Please Enter You Basic Details</h5>
                            <div class="field">
                                <div class="form-floating mb-3 mt-3">
                                    <input type="text" class="form-control" id="floatingInput" name="name"
                                        placeholder="Enter your name">
                                    <label for="floatingInput">Name</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control" id="floatingInput" name="phone"
                                        maxlength="15" placeholder="Enter your number">
                                    <label for="floatingInput">Phone</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="floatingInput" name="email"
                                        placeholder="Enter your email Id">
                                    <label for="floatingInput">Email</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingInput" name="password"
                                        placeholder="Create New Password">
                                    <label for="floatingInput">Create New Password</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingInput"
                                        name="password_confirmation" placeholder="Confirm Password">
                                    <label for="floatingInput">Confirm Password</label>
                                </div>
                            </div>

                            <div class="file-upload form-floating d-flex align-items-center mb-3">
                                <div class="file btn black-color upload-btn">
                                    <div id="file-upload-img">
                                        Upload Photo <i class="bi bi-file-image ms-2 main-color"></i>
                                    </div>
                                    <div>
                                        <input type="file" name="file" id="upload-img" accept="image/png, image/jpg, image/jpeg"/>
                                        <img style="width: 120px !important" class="m-3 img-fluid img-thumbnail rounded d-none" src="{{asset('admin/images/profile-image.jpg')}}" id="display-img" alt="">
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
            $.validator.addMethod("passwordCheck",
                function(value, element) {
                    var password = value;

                    // Define a regular expression pattern to check for at least one uppercase letter,
                    // one number, and one special character.
                    var pattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/;

                    if (pattern.test(password)) {
                        return true;
                    } else {
                        return false;
                    }
                },
                "Password is not valid. It should contain at least one uppercase letter, one number, and one special character."
            );
            $('#signin_form').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    phone: {
                        required: true,
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
                        passwordCheck: true
                    },
                    password_confirmation: {
                        required: true,
                        maxlength: 191,
                        minlength: 6,
                        password_match: true

                    },
                },
                errorElement: "span",
                errorPlacement: function(error, element) {
                    // error.addClass("invalid-feedback");
                    // element.closest(".field").append(error);
                    element.addClass("border border-danger")
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
