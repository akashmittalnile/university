<section class="contact" id="contact">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="main-color f-600">Contact Us</h2>
                <p class="text-capitalize text-color">Get in touch with us for any questions or assistance</p>
                <form action="{{ route('contactSave') }}" method="POST" class="common-shadow mt-4" id="contact_form">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="name"
                            placeholder="Enter your name">
                        <label for="floatingInput">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="floatingInput"
                            placeholder="Enter your email Id">
                        <label for="floatingInput">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="phone" id="floatingInput"
                            placeholder="Enter your number">
                        <label for="floatingInput">Phone</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control" name="address" id="floatingInput"
                            placeholder="Enter your address">
                        <label for="floatingInput">Address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="message" placeholder="Type your message" id="floatingTextarea2"
                            style="height: 100px"></textarea>
                        <label for="floatingTextarea2">Message</label>
                    </div>
                    <a><button class="btn common-btn">Submit</button></a>
                </form>
            </div>
            <div class="col-md-6 business-hour-section">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('frontend/images/working-hours.svg') }}" alt="image"
                        class="img-fluid me-2 business-hour">
                    <h2 class="main-color f-600 mt-0 mb-0">Business Hours</h2>
                </div>
                <div class="weeks">
                    <div class="d-flex mb-2">
                        <div class="week-bg">
                            <h6 class="main-color">Mon</h6>
                        </div>
                        <div class="time-bg ms-3">
                            <p class="black-color">08:30 AM - 05:00 PM</p>
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="week-bg">
                            <h6 class="main-color">Tue</h6>
                        </div>
                        <div class="time-bg ms-3">
                            <p class="black-color">08:30 AM - 05:00 PM</p>
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="week-bg">
                            <h6 class="main-color">Tue</h6>
                        </div>
                        <div class="time-bg ms-3">
                            <p class="black-color">08:30 AM - 05:00 PM</p>
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="week-bg">
                            <h6 class="main-color">Wd</h6>
                        </div>
                        <div class="time-bg ms-3">
                            <p class="black-color">08:30 AM - 05:00 PM</p>
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="week-bg">
                            <h6 class="main-color">Thu</h6>
                        </div>
                        <div class="time-bg ms-3">
                            <p class="black-color">08:30 AM - 05:00 PM</p>
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="week-bg">
                            <h6 class="main-color">Fri</h6>
                        </div>
                        <div class="time-bg ms-3">
                            <p class="black-color">08:30 AM - 05:00 PM</p>
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="week-bg">
                            <h6 class="main-color">Sat</h6>
                        </div>
                        <div class="time-bg ms-3">
                            <p class="black-color">09:00 AM - 02:00 PM</p>
                        </div>
                    </div>
                    <div class="d-flex mb-2 closed">
                        <div class="week-bg">
                            <h6>Sun</h6>
                        </div>
                        <div class="time-bg ms-3">
                            <p class="black-color">Closed</p>
                        </div>
                    </div>
                    <a href="tel:(876)285-2626"><button class="btn common-btn"><i
                                class="bi bi-telephone-outbound me-2"></i>Call Now - (876) 285-2626</button></a>
                </div>

            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
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
