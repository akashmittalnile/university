@extends('layouts.frontend.app')
@push('css')
<link rel="stylesheet" href="{{ assets('frontend/css/user-details.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<style>
    .cancel .outline-btn{
        border: 1px solid #e83030;
        color: #e83030;
    }
    .cancel .outline-btn:hover{
        background-color: #e83030;
        color: white;
    }
</style>
@endpush
@push('js')
<script src="{{ assets('frontend/js/user-details.js') }}"></script>
<script src="{{ assets('admin/js/profile.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
@endpush
@section('content')
<style>
    .profile-info .profile-img img{width: 260px;
    height: 260px;border: 1px solid rgb(209, 209, 209);
    border-radius: 50%; object-fit: cover;margin: 0 auto;display: block;}
    .profile-info .profile-img {padding: 20px;}
</style>
<section class="user-details" style="padding-top: 6.6% !important;">
    <div class="my-info mt-0 pt-5">
        <h2 class="black-color text-center font-weight-bolder mb-5">User <b class="main-color">Details</b></h2>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 profile-info">
                    <div class="left-section profile-img" style="background-color: transparent !important;">
                        @if(isset($user->profile))
                        <img src="{{ assets('uploads/profile/'.$user->profile) }}" class="img-fluid">
                        @else
                        <img src="{{ assets('frontend/images/profile-image.jpg') }}" class="img-fluid">
                        @endif
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="head mb-1">
                        <h2 class="black-color mb-0 pb-0">{{ $user->name }}</h2>
                    </div>
                    <div class="d-flex mt-3 mt-md-3 mail-info align-items-center">
                        <img src="{{ assets('frontend/images/telephone.png') }}" alt="image" class="img-fluid me-2">
                        <p class="black-color f-600 m-0 p-0">{{ $user->phone }}</p>
                    </div>
                    <div class="d-flex mt-3 phone-info align-items-center">
                        <img src="{{ assets('frontend/images/letter.png') }}" alt="image" class="img-fluid me-2">
                        <h6 class="black-color f-600 m-0 p-0">{{ $user->email }}</h6>
                    </div>
                    <div class="d-flex flex-row mt-4">
                        <div class="">
                            <a href="javascript:void(0)">
                                <button class="common-btn" data-bs-toggle="modal" data-bs-target="#edit-profile-modal">Edit Details</button>
                            </a>
                        </div>
                        <div class="mx-3">
                            <a href="javascript:void(0)">
                                <button class="common-btn" data-bs-toggle="modal" data-bs-target="#change-password-modal">Change Password</button>
                            </a>
                        </div>
                        @if(isset($currentPlanId))
                        <div class="cancel">
                            <a href="javascript:void(0)">
                                <button class="btn outline-btn" onclick="$('#delete_form').attr('action','{{ route('user.cancel.subscription', encrypt_decrypt('encrypt', $currentPlanId)) }}')" data-bs-toggle="modal" data-bs-target="#deleteFile">Cancel Subscription</button>
                            </a>
                        </div>
                        @endif
                    </div>
                    
                </div>
                <div class="col-md-12 mt-5 mb-3">
                    <h5 class="sub-head text-capitalize">My <b class="main-color">Subscription</b> Plan & <b class="main-color">payment</b> Details</h5>
                </div>
                <div class="col-md-4  h-100">
                    <div class="card float common-shadow">
                        @if ($currentPlan)
                        <img src="{{ assets('frontend/images/subscription-plan.png') }}" alt="image" class="img-fluid">
                        <h5 class="text-color mt-3">${{ number_format($currentPlan->price ?? 0, 2, '.', ',') }}/{{ ucfirst($currentPlan->type) }}
                        </h5>
                        <h3 class="main-color f-600 mt-3">{{ $currentPlan->name }}</h3>
                        @else
                        <h3 class="main-color f-600 mt-3">No Active Plan</h3>
                        @endif

                    </div>
                </div>
                <div class="col-md-4  h-100">
                    <div class="card float common-shadow">
                        <img src="{{ assets('frontend/images/transaction.png') }}" alt="image" class="img-fluid">
                        <h5 class="text-color mt-3">Total Subscription Payment</h5>
                        <h3 class="main-color f-600 mt-3">${{ number_format($total, 2, '.', ',') }}</h3>
                    </div>
                </div>
                <div class="col-md-4 h-100 d-none">
                    <div class="card float common-shadow">
                        <img src="{{ assets('frontend/images/e-book.png') }}" alt="image" class="img-fluid">
                        <h5 class="text-color mt-3">Total E-book purchasement Payment</h5>
                        <h3 class="main-color f-600 mt-3">$345.23</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="deleteFile" tabindex="-1" aria-labelledby="deleteFileLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="text-capitalize text-center letter-space f-600 black-color">Are you Sure?</h4>
                <h6 class="text-color text-center mt-3">Do you really want to cancel the <b class="main-color">Subscription</b></h6>
            </div>
            <form action="" method="get" id="delete_form">
                @csrf
                <div class="modal-footer justify-content-center mb-3 cancel">
                    <button type="button" class="btn outline-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn common-btn">Yes, Cancel</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="edit-profile-modal" tabindex="-1" aria-labelledby="edit-profile-modalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.profile.post') }}" method="post" id="profile_form" enctype="multipart/form-data"> @csrf
                <div class="modal-body">
                    <h5 class="black-color text-center mb-3 f-600 letter-space">Edit <b class="main-color">P</b>rofile
                        Details</h5>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput1" placeholder="Name" value="{{ auth()->user()->name ?? '' }}" name="name">
                        <label for="floatingInput1">Full Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput2" placeholder="Email" value="{{ auth()->user()->email ?? '' }}" name="email" disabled>
                        <label for="floatingInput2">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control code" id="floatingInput3" placeholder="Phone" value="{{ auth()->user()->phone ?? '' }}" name="phone">
                        <label for="floatingInput3">Phone</label>
                    </div>
                    <div class="file-upload form-floating d-flex align-items-center mb-3">
                        <div class="file btn black-color upload-btn">
                            <div id="file-upload-img">
                                Upload Photo <i class="bi bi-file-image ms-2 main-color"></i>
                            </div>
                            <div>
                                <input type="file" name="file" id="upload-img" accept="image/png, image/jpg, image/jpeg" />
                                @if(isset(auth()->user()->profile))
                                <img width="150" class="m-3 img-fluid img-thumbnail rounded" src="{{assets("uploads/profile/".auth()->user()->profile)}}" id="display-img" alt="">
                                @else
                                <img width="150" class="m-3 img-fluid img-thumbnail rounded" src="{{assets('admin/images/profile-image.jpg')}}" id="display-img" alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="address" placeholder="Address" id="floatingTextarea2" style="height: 100px">{{ auth()->user()->address ?? '' }}</textarea>
                        <label for="floatingTextarea2">Address</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="edit-profile-cancel-btn" class="btn outline-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn common-btn">Update Details</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- change-password-modal -->
<div class="modal fade" id="change-password-modal" tabindex="-1" aria-labelledby="change-password-modalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.profile.post') }}" method="post" id="password_form">@csrf
                <div class="modal-body">
                    <h5 class="black-color text-center mb-4 f-600 letter-space">Change <b class="main-color">P</b>assword</h5>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingInput4" name="current_password" placeholder="Current Password">
                        <label for="floatingInput4">Enter Old Password</label>
                        <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingInput5" name="password" placeholder="New Password">
                        <label for="floatingInput5">Create New Password</label>
                        <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingInput6" name="new_password" placeholder="Re-enter New Password">
                        <label for="floatingInput6">Confirm New Password</label>
                        <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="change-password-cancel-btn" class="btn outline-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn common-btn">Update Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $("#edit-profile-cancel-btn").on('click', function() {
        $("#profile_form")[0].reset();
        $("#profile_form input").removeClass('border-danger');
    });

    $("#change-password-cancel-btn").on('click', function() {
        $("#password_form")[0].reset();
        $("#password_form input").removeClass('border-danger');
    });

    $(document).on('click', '#file-upload-img', function() {
        $("#upload-img").get(0).click();
    })
    $(document).on("change", "#upload-img", function(e) {
        $("#display-img").attr("src", URL.createObjectURL(event.target.files[0]))
    })

    $(document).ready(function() {
        $('.code').mask('(000) 000-0000');

        $.validator.addMethod("phoneValidate", function(value) {
            return /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im.test(value);
        }, 'Please enter valid phone number.');

        $('#profile_form').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 200,
                },
                phone: {
                    required: true,
                    phoneValidate: true
                },
                address: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                // error.addClass("invalid-feedback");
                element.addClass("border border-danger");

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
                    beforeSend: function() {
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
                            console.log(data);
                            var form = $("#profile_form");
                            const input = form.find(
                                `input[name=${data.errors}]`
                            );
                            console.log(input);
                            if (input.next('small').length) {
                                input.next('small').html(data.message);
                            } else {
                                input.after(
                                    `<small class='text-danger'>${data.message}</small>`
                                );
                            }
                            li_htm += `<li>${data.message}</li>`;
                            

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
            },
        });

        $.validator.addMethod("notEqual", function(value, element, param) {
            return this.optional(element) || value != $(param).val();
        }, 'Old password and New password should not same.');

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

        $('#password_form').validate({
            rules: {
                current_password: {
                    required: true,
                    minlength: 6,
                    remote: {
                        type: 'get',
                        url: "{{ route('user.check.password') }}",
                        dataType: 'json'
                    }
                },
                password: {
                    required: true,
                    maxlength: 15,
                    minlength: 6,
                    notEqual: "input[name='current_password']",
                    AtLeastOnenumber: true,
                    AtLeastOneUpperChar: true,
                    AtLeastOneLowerChar: true,
                    AtLeastOneSpecialChar: true
                },
                new_password: {
                    required: true,
                    equalTo: "input[name='password']"
                },
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                // error.addClass("invalid-feedback");
                element.addClass("border border-danger");
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
                    beforeSend: function() {
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
            },
        });

    });
</script>
@endsection