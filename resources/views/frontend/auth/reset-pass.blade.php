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
                            <h1 class="text-center white-color">Reset Password</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <form action="{{ route('update.password') }}" method="POST" id="signin_form">
                        @csrf
                        <input type="hidden" id="redirect_url" value="{{ route('signin') }}">
                        <input type="hidden" name="email" value="{{ $email }}">
                        <h3 class="main-color f-600">Great!!</h3>
                        <h6 class="mb-4">Enter your new password</h6>
                        <div class="field">
                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control" id="floatingInput"
                                    placeholder="New Password">
                                <label for="floatingInput">NewPassword</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="form-floating mb-3">
                                <input type="password" name="new_password" class="form-control" id="floatingInput"
                                    placeholder="Confirm Password">
                                <label for="floatingInput">Confirm Password</label>
                            </div>
                        </div>
                        <div class="my-3">
                            <a href="#"><button class="btn common-btn mb-3">Reset Password</button></a>
                            <p class="text-center black-color mt-0"><a href="{{ route('signin') }}" class="main-color sign-link f-600">Sign In</a></p>
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
    $('.inputstab').keyup(function(e) {
        if (this.value.length === this.maxLength) {
            let next = $(this).data('next');
            $('#n' + next).focus();
        }
    });

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

        $('#signin_form').validate({
            rules: {
                password: {
                    required: true,
                    AtLeastOnenumber: true,
                    AtLeastOneUpperChar: true,
                    AtLeastOneLowerChar: true,
                    AtLeastOneSpecialChar: true
                },
                new_password: {
                    required: true,
                    password_match: true
                }
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
                        } else {

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