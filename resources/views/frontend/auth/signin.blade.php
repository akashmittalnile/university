@extends('layouts.frontend.app')
@push('css')
    <link rel="stylesheet" href="{{ assets('frontend/css/sign-in.css') }}">
@endpush
@section('content')
    <section class="sign-up">
        <div class="container">
            <div class="sign-up-contents">
                <div class="row">
                    <div class="col-md-7">
                        <div class="img-box">
                            <div class="sign-up-head">
                                <h1 class="text-center white-color">Sign In</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <form action="{{ route('admin.signin.post') }}" method="POST" id="signin_form">
                            @csrf
                            <input type="hidden" id="redirect_url" value="{{ route('admin.dashboard') }}">
                            <h3 class="main-color f-600">Great!!</h3>
                            <h6 class="mb-4">Enter your Email & Password to login</h6>
                            <div class="field">
                                <div class="form-floating mb-3">
                                    <input type="email" name="email" class="form-control" id="floatingInput"
                                        placeholder="Enter your email Id">
                                    <label for="floatingInput">Email</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="form-floating mb-3">
                                    <input type="password" name="password" class="form-control" id="floatingInput"
                                        placeholder="Enter Password">
                                    <label for="floatingInput">Password</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <a href="#"><button class="btn common-btn mb-3">Sign In</button></a>
                                <a href="{{ route('forgot.password') }}" class="text-center black-color f-600 mb-2 forgot-password">Forgot
                                    Password?</a>
                                <p class="text-center black-color f-600 mb-2">Or</p>
                                <p class="text-center black-color mt-0">Already have an account? <a
                                        href="{{ route('signup') }}" class="main-color sign-link f-600">Sign Up</a></p>
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
        $(document).ready(function() {
            $('#signin_form').validate({
                rules: {
                    email: {
                        required: true,
                        maxlength: 191,
                        email: true
                    },
                    password: {
                        required: true,
                        maxlength: 191,
                        minlength: 6
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
