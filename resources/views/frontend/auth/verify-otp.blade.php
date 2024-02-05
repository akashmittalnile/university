@extends('layouts.frontend.app')
@push('css')
<link rel="stylesheet" href="{{ asset('frontend/css/sign-in.css') }}">
@endpush
@section('content')
<section class="sign-up">
    <div class="container">
        <div class="sign-up-contents">
            <div class="row">
                <div class="col-md-7">
                    <div class="img-box">
                        <div class="sign-up-head">
                            <h1 class="text-center white-color">Verify OTP</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <form action="{{ route('verifying.otp') }}" method="POST" id="signin_form">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <h3 class="main-color f-600">Great!!</h3>
                        <h6 class="mb-4">Enter OTP</h6>
                        <div class="field">
                            <div class="row text-center mx-auto" style="width: 40%;">
                                <div class="col-md-3">
                                    <div class="form-group auth-form-group ">
                                        <input style="padding: 10px; width: 45px; font-size: 1.2rem;" class="form-controls inputstab" name="otp1" type="text" id="n0" maxlength="1" autocomplete="off" autofocus data-next="1" required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group auth-form-group ">
                                        <input style="padding: 10px; width: 45px; font-size: 1.2rem;" class="form-controls inputstab" name="otp2" type="text" id="n1" maxlength="1" autocomplete="off" autofocus data-next="2" required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group auth-form-group ">
                                        <input style="padding: 10px; width: 45px; font-size: 1.2rem;" class="form-controls inputstab" name="otp3" type="text" id="n2" maxlength="1" autocomplete="off" autofocus data-next="3" required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group auth-form-group ">
                                        <input style="padding: 10px; width: 45px; font-size: 1.2rem;" class="form-controls inputstab" name="otp4" type="text" id="n3" maxlength="1" autocomplete="off" autofocus data-next="4" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="my-3">
                            <a href="#"><button class="btn common-btn mb-3">Verify</button></a>
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
        $('#signin_form').validate({
            rules: {
                otp1: {
                    required: true,
                },
                otp2: {
                    required: true,
                },
                otp3: {
                    required: true,
                },
                otp4: {
                    required: true,
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
                                    if (response.data) {
                                        window.location = response.data;
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