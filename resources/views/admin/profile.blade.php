@extends('layouts.admin.app')
@push('css')
<link rel="stylesheet" href="{{ assets('admin/css/profile.css') }}" />
@endpush
@push('js')
<script src="{{ assets('admin/js/profile.js') }}"></script>
@endpush
@section('content')
<main class="main-container dashboard">
    <div class="main-title d-flex align-items-center">
        <div class="page-title">
            <h3 class="font-weight-bold black-color">Profile</h3>
        </div>
        <div class="profile-link">
            <a href="javascript:void(0)">
                <div class="d-flex align-items-center">
                    
                </div>
            </a>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-12">
            <div class="main-cards">
                <div class="profile-info">
                    <div class="transation-detail-box ">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="common-card">
                                    <div class="profile-img">
                                        @if(isset(auth()->user()->profile))
                                        <img src="{{assets("uploads/profile/".auth()->user()->profile)}}" alt="image" class="img-fluid">
                                        @else
                                        <img src="{{assets('admin/images/no-image.jpg')}}" alt="image" class="img-fluid">
                                        @endif
                                        <h5 class="black-color text-center mt-3 f-600">{{ auth()->user()->name ?? 'NA' }}</h5>
                                        <div class="text-center mt-4">
                                            <a href="javascript:void(0)">
                                                <button class="common-btn" data-bs-toggle="modal" data-bs-target="#edit-profile-modal">Edit Details</button>
                                            </a>
                                            <a href="javascript:void(0)">
                                                <button class="outline-btn mt-2" data-bs-toggle="modal" data-bs-target="#change-password-modal">Change Password</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="common-card profile-card">
                                    <h5 class="black-color f-600 letter-space">Profile Overview</h5>
                                    <div class="row mt-5">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center">
                                                <div class="img-bg">
                                                    <img src="{{ assets('admin/images/user.png') }}" alt="image" class="img-fluid">
                                                </div>
                                                <div class="texts ms-3">
                                                    <p class="text-color">Full Name</p>
                                                    <h6 class="black-color mt-2">{{ auth()->user()->name ?? 'NA' }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center">
                                                <div class="img-bg">
                                                    <img src="{{ assets('admin/images/letter.png') }}" alt="image" class="img-fluid">
                                                </div>
                                                <div class="texts ms-3">
                                                    <p class="text-color">Email Address</p>
                                                    <h6 class="black-color mt-2">{{ auth()->user()->email ?? 'NA' }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 m-top">
                                            <div class="d-flex align-items-center">
                                                <div class="img-bg">
                                                    <img src="{{ assets('admin/images/telephone.png') }}" alt="image" class="img-fluid">
                                                </div>
                                                <div class="texts ms-3">
                                                    <p class="text-color">Phone</p>
                                                    <h6 class="black-color mt-2">+1 {{ auth()->user()->phone ?? 'NA' }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 m-top">
                                            <div class="d-flex align-items-center">
                                                <div class="img-bg">
                                                    <img src="{{ assets('admin/images/location.png') }}" alt="image" class="img-fluid">
                                                </div>
                                                <div class="texts ms-3">
                                                    <p class="text-color">Address</p>
                                                    <h6 class="black-color mt-2">{{ auth()->user()->address ?? 'NA' }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- edit-profile-modal -->
<div class="modal fade" id="edit-profile-modal" tabindex="-1" aria-labelledby="edit-profile-modalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.profile.post') }}" method="post" id="profile_form" enctype="multipart/form-data"> @csrf
                <div class="modal-body">
                    <h5 class="black-color text-center mb-3 f-600 letter-space">Edit <b class="main-color">P</b>rofile
                        Details</h5>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput1" placeholder="Name" value="{{ auth()->user()->name ?? '' }}" name="name">
                        <label for="floatingInput1">Full Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput2" placeholder="Email" value="{{ auth()->user()->email ?? '' }}" name="email">
                        <label for="floatingInput2">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control" id="floatingInput3" placeholder="Phone" value="{{ auth()->user()->phone ?? '' }}" name="phone">
                        <label for="floatingInput3">Phone</label>
                    </div>
                    <div class="file-upload form-floating d-flex align-items-center mb-3">
                        <div class="file btn black-color upload-btn">
                            <div id="file-upload-img">
                                Upload Photo <i class="bi bi-file-image ms-2 main-color"></i>
                            </div>
                            <div>
                                <input type="file" name="file" id="upload-img" accept="image/png, image/jpg, image/jpeg"/>
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
            <form action="{{ route('admin.profile.post') }}" method="post" id="password_form">@csrf
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
    $("#edit-profile-cancel-btn").on('click', function(){
        $("#profile_form")[0].reset();
        $("#profile_form input").removeClass('border-danger');
    });

    $("#change-password-cancel-btn").on('click', function(){
        $("#password_form")[0].reset();
        $("#password_form input").removeClass('border-danger');
    });
    
    $(document).on('click', '#file-upload-img', function(){
        $("#upload-img").get(0).click();
    })
    $(document).on("change", "#upload-img", function(e){
        $("#display-img").attr("src", URL.createObjectURL(event.target.files[0]))
    })

    $(document).ready(function() {

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

    $(document).ready(function() {

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
                        url: "{{ route('admin.check.password') }}",
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