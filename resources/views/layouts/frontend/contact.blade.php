<section class="contact" id="contact">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="zq_contact-content">
                    <div class="zq_section-area">
                        <h2 class="zq_section-title mb-30">Get Stared with Us. <br>
                            Call Us Now!</h2>
                        <p class="zq_section-text mb-40">The fastest way to convert visitors into leads and sales on your website is with Social Daily Marketing. That's why businesses use Daily.</p>
                    </div>
                    <div class="zq_contact-call">
                        <div class="zq_contact-call-icon">
                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M44.2391 16.9892C41.5369 6.94588 33.3318 0 24 0C14.6965 0 6.46024 6.95718 3.76094 16.9892C1.65176 17.2207 0 18.9995 0 21.1765V32.4706C0 34.2353 1.07859 35.7459 2.60894 36.3812C3.15671 41.3139 7.30447 45.1765 12.3812 45.1765H20.0245C20.6089 46.8169 22.1619 48 24 48H32.4706C34.8056 48 36.7059 46.0998 36.7059 43.7647C36.7059 41.4296 34.8056 39.5294 32.4706 39.5294H24C22.1619 39.5294 20.6089 40.7125 20.0245 42.3529H12.3812C8.97035 42.3529 6.12141 39.9247 5.46635 36.7059H8.47059V33.8824H11.2941V19.7647H8.47059V16.9412H6.75953C9.33741 8.58071 16.224 2.82353 24 2.82353C31.7986 2.82353 38.6626 8.57506 41.2405 16.9412H39.5294V19.7647H36.7059V33.8824H39.5294V36.7059H43.7816C46.1082 36.7059 48 34.8056 48 32.4706V21.1765C48 18.9995 46.3482 17.2207 44.2391 16.9892ZM24 42.3529H32.4706C33.2471 42.3529 33.8824 42.9854 33.8824 43.7647C33.8824 44.544 33.2471 45.1765 32.4706 45.1765H24C23.2235 45.1765 22.5882 44.544 22.5882 43.7647C22.5882 42.9854 23.2235 42.3529 24 42.3529ZM5.64706 33.8824H4.21835C3.45035 33.8824 2.82353 33.2499 2.82353 32.4706V21.1765C2.82353 20.3972 3.45035 19.7647 4.21835 19.7647H5.64706V33.8824ZM45.1765 32.4706C45.1765 33.2499 44.5496 33.8824 43.7816 33.8824H42.3529V19.7647H43.7816C44.5496 19.7647 45.1765 20.3972 45.1765 21.1765V32.4706Z" fill="currentColor"></path>
                            </svg>
                        </div>
                        <div class="zq_contact-call-info">
                            <span>Call Now </span>
                            <a href="tel:(876)285-2626">{{ adminData()->phone ?? "(876) 285-2626" }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- <h2 class="main-color f-600">Contact Us</h2>
                <p class="text-capitalize text-color">Get in touch with us for any questions or assistance</p> -->
                <form action="{{ route('contactSave') }}" method="POST" class="common-shadow mt-4" id="contact_form">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="name"
                                    placeholder="Enter your name">
                                <label for="floatingInput">Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" id="floatingInput"
                                    placeholder="Enter your email Id">
                                <label for="floatingInput">Email</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control code" name="phone" id="floatingInput"
                                    placeholder="Enter your number">
                                <label for="floatingInput">Phone</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <input type="tel" class="form-control" name="address" id="floatingInput"
                                    placeholder="Enter your address">
                                <label for="floatingInput">Address</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="message" placeholder="Type your message" id="floatingTextarea2"
                                    style="height: 100px"></textarea>
                                <label for="floatingTextarea2">Message</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn common-btn">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- <div class="col-md-6 business-hour-section">
                @if(isset(businessHour()['sec1_closed']))
                <div class="d-flex align-items-center">
                    <img src="{{ assets('frontend/images/working-hours.svg') }}" alt="image"
                        class="img-fluid me-2 business-hour">
                    <h2 class="main-color f-600 mt-0 mb-0">Business Hours</h2>
                </div>
                <div class="weeks">
                    <div class="d-flex mb-2 @if(businessHour()['sec1_closed'] == 1) closed @endif">
                        <div class="week-bg">
                            <h6 class="@if(businessHour()['sec1_closed'] == 0) main-color @endif">Mon</h6>
                        </div>
                        <div class="time-bg ms-3">
                            @if(businessHour()['sec1_closed'] == 1)
                            <p class="black-color">Closed</p>
                            @else
                            <p class="black-color">{{ date('h:i A', strtotime(businessHour()['sec1_open'])) }} - {{ date('h:i A', strtotime(businessHour()['sec1_close'])) }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex mb-2 @if(businessHour()['sec2_closed'] == 1) closed @endif">
                        <div class="week-bg">
                            <h6 class="@if(businessHour()['sec2_closed'] == 0) main-color @endif">Tue</h6>
                        </div>
                        <div class="time-bg ms-3">
                            @if(businessHour()['sec2_closed'] == 1)
                            <p class="black-color">Closed</p>
                            @else
                            <p class="black-color">{{ date('h:i A', strtotime(businessHour()['sec2_open'])) }} - {{ date('h:i A', strtotime(businessHour()['sec2_close'])) }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex mb-2 @if(businessHour()['sec3_closed'] == 1) closed @endif">
                        <div class="week-bg">
                            <h6 class="@if(businessHour()['sec3_closed'] == 0) main-color @endif">Wed</h6>
                        </div>
                        <div class="time-bg ms-3">
                            @if(businessHour()['sec3_closed'] == 1)
                            <p class="black-color">Closed</p>
                            @else
                            <p class="black-color">{{ date('h:i A', strtotime(businessHour()['sec3_open'])) }} - {{ date('h:i A', strtotime(businessHour()['sec3_close'])) }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex mb-2 @if(businessHour()['sec4_closed'] == 1) closed @endif">
                        <div class="week-bg">
                            <h6 class="@if(businessHour()['sec4_closed'] == 0) main-color @endif">Thu</h6>
                        </div>
                        <div class="time-bg ms-3">
                            @if(businessHour()['sec4_closed'] == 1)
                            <p class="black-color">Closed</p>
                            @else
                            <p class="black-color">{{ date('h:i A', strtotime(businessHour()['sec4_open'])) }} - {{ date('h:i A', strtotime(businessHour()['sec4_close'])) }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex mb-2 @if(businessHour()['sec5_closed'] == 1) closed @endif">
                        <div class="week-bg">
                            <h6 class="@if(businessHour()['sec5_closed'] == 0) main-color @endif">Fri</h6>
                        </div>
                        <div class="time-bg ms-3">
                            @if(businessHour()['sec5_closed'] == 1)
                            <p class="black-color">Closed</p>
                            @else
                            <p class="black-color">{{ date('h:i A', strtotime(businessHour()['sec5_open'])) }} - {{ date('h:i A', strtotime(businessHour()['sec5_close'])) }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex mb-2 @if(businessHour()['sec6_closed'] == 1) closed @endif">
                        <div class="week-bg">
                            <h6 class="@if(businessHour()['sec6_closed'] == 0) main-color @endif">Sat</h6>
                        </div>
                        <div class="time-bg ms-3">
                            @if(businessHour()['sec6_closed'] == 1)
                            <p class="black-color">Closed</p>
                            @else
                            <p class="black-color">{{ date('h:i A', strtotime(businessHour()['sec6_open'])) }} - {{ date('h:i A', strtotime(businessHour()['sec6_close'])) }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex mb-2 @if(businessHour()['sec7_closed'] == 1) closed @endif">
                        <div class="week-bg">
                            <h6 class="@if(businessHour()['sec7_closed'] == 0) main-color @endif">Sun</h6>
                        </div>
                        <div class="time-bg ms-3">
                            @if(businessHour()['sec7_closed'] == 1)
                            <p class="black-color">Closed</p>
                            @else
                            <p class="black-color">{{ date('h:i A', strtotime(businessHour()['sec7_open'])) }} - {{ date('h:i A', strtotime(businessHour()['sec7_close'])) }}</p>
                            @endif
                        </div>
                    </div>
                    <a href="tel:(876)285-2626"><button class="btn common-btn"><i class="bi bi-telephone-outbound me-2"></i>Call Now - {{ adminData()->phone ?? "(876) 285-2626" }}</button></a>
                </div>
                @endif
                
            </div> -->
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script>
    $(document).ready(function() {
        $('.code').mask('(000) 000-0000');
        $.validator.addMethod("phoneValidate", function(value) {
            return /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im.test(value);
        }, 'Please enter valid phone number.');

        $('#contact_form').validate({
            rules: {
                email: {
                    required: true,
                    maxlength: 191,
                    email: true
                },
                name: {
                    required: true,
                    maxlength: 191,
                    minlength: 2
                },
                phone: {
                    required: true,
                    phoneValidate: true,
                },
                message: {
                    required: true,
                    maxlength: 191,
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
                            var form = $("#contact_form");
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
