@extends('layouts.admin.app')
@push('css')
<link rel="stylesheet" href="{{ assets('admin/css/edit-podcast.css') }}" />
@endpush
@push('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.3.2/ckeditor.js"></script>
<script>
    CKEDITOR.replace("post_text", {
        uiColor: "#dddddd",
        height: 500,
        resize_dir: 'vertical'
    });
    CKEDITOR.instances['post_text'].on('change', function() {
        let value = CKEDITOR.instances['post_text'].getData().trim();
        if (value != undefined && value != null && value != '') {
            $(".cke_1.cke_chrome").attr("style", "border: 1px solid #3eda3f !important;")
        } else $(".cke_1.cke_chrome").attr("style", "border: 1px solid red !important;")
    });
</script>
<script src="https://cdn.ckeditor.com/4.23.0-lts/standard/ckeditor.js"></script>
@endpush
@section('content')
<!-- Main -->
<main class="main-container dashboard">
    <div class="main-title d-flex align-items-center">
        <div class="page-title d-flex align-items-center">
            <a href="{{ route('admin.contacts') }}"><i class="bi bi-arrow-left-circle-fill main-color me-3"></i></a>
            <h3 class="font-weight-bold black-color">Manage Business Hour</h3>
        </div>
        <div class="profile-link">
            <a href="#">
                <div class="d-flex align-items-center">
                    <div class="profile-pic">
                        <img src="{{ isset(auth()->user()->profile) ? assets("uploads/profile/".auth()->user()->profile) : assets('admin/images/no-image.jpg')}}" alt="profile image" class="img-fluid me-2">
                    </div>
                    <div class="button-link">
                        <a href="{{ route('admin.profile') }}" class="profile-name">{{auth()->user()->name ?? 'Admin Profile'}}<i class="bi bi-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-12">
            <div class="main-cards">
                <div class="e-book-details">
                    <div class="d-flex align-items-center justify-content-end">

                    </div>
                    <div class="about-us">
                        <form action="{{ route('admin.business.hour.save') }}" method="post" id="hour_form">
                            @csrf
                            <div class="edit-ebook">
                                <input type="hidden" id="redirect_url" value="{{ route('admin.markBurnet') }}">
                                <div class="common-card">
                                    <div class="row align-items-center">

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="mb-3 field_error">
                                                    <label for="sec1_week" class="form-label black-color f-600">Week</label>
                                                    <input type="text" disabled name="sec1_week" class="form-control" id="sec1_week" value="MONDAY" aria-describedby="sec1_week" placeholder="MONDAY">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-chec">
                                                    <label class="form-label black-color f-600">Business</label>
                                                    <div class="row rounded border">
                                                        <div class="col-md-6">
                                                            <div class="p-2 my-1">
                                                                <div class="form-group my-auto d-flex">
                                                                    <input @if(isset($data['sec1_closed']) && $data['sec1_closed']==0) checked @elseif(!isset($data['sec1_closed'])) checked @endif type="radio" value="0" name="sec1_closed" id="sec1_opened">
                                                                    <label for="sec1_opened">Open</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="p-2 my-1">
                                                                <div class="form-group my-auto d-flex">
                                                                    <input @if(isset($data['sec1_closed']) && $data['sec1_closed']==1) checked @endif type="radio" value="1" name="sec1_closed" id="sec1_closed">
                                                                    <label for="sec1_closed">Closed</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3 field_error">
                                                    <label for="sec1_open" class="form-label black-color f-600">Open Time</label>
                                                    <input type="time" max="18:00:00" data-num="1" onchange="timeValidate(event);" name="sec1_open" value="{{ (isset($data['sec1_closed']) && $data['sec1_closed']==1) ? '--:--' : $data['sec1_open'] ?? date('H:i') }}" class="form-control" id="sec1_open" aria-describedby="sec1_open">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3 field_error">
                                                    <label for="sec1_close" class="form-label black-color f-600">Close Time</label>
                                                    <input type="time" name="sec1_close" value="{{ (isset($data['sec1_closed']) && $data['sec1_closed']==1) ? '--:--' : $data['sec1_close'] ?? date('H:i', strtotime('+1hour')) }}" class="form-control" id="sec1_close" aria-describedby="sec1_close">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="mb-3 field_error">
                                                    <label for="sec2_week" class="form-label black-color f-600">Week</label>
                                                    <input type="text" disabled name="sec2_week" class="form-control" id="sec2_week" value="TUESDAY" aria-describedby="sec2_week" placeholder="TUESDAY">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-chec">
                                                    <label class="form-label black-color f-600">Business</label>
                                                    <div class="row rounded border">
                                                        <div class="col-md-6">
                                                            <div class="p-2 my-1">
                                                                <div class="form-group my-auto d-flex">
                                                                    <input @if(isset($data['sec2_closed']) && $data['sec2_closed']==0) checked @elseif(!isset($data['sec2_closed'])) checked @endif type="radio" value="0" name="sec2_closed" id="sec2_opened">
                                                                    <label for="sec2_opened">Open</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="p-2 my-1">
                                                                <div class="form-group my-auto d-flex">
                                                                    <input @if(isset($data['sec2_closed']) && $data['sec2_closed']==1) checked @endif type="radio" value="1" name="sec2_closed" id="sec2_closed">
                                                                    <label for="sec2_closed">Closed</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3 field_error">
                                                    <label for="sec2_open" class="form-label black-color f-600">Open Time</label>
                                                    <input type="time" max="18:00:00" data-num="2" onchange="timeValidate(event);" name="sec2_open" value="{{ (isset($data['sec2_closed']) && $data['sec2_closed']==1) ? '--:--' : $data['sec2_open'] ?? date('H:i') }}" class="form-control" id="sec2_open" aria-describedby="sec2_open">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3 field_error">
                                                    <label for="sec2_close" class="form-label black-color f-600">Close Time</label>
                                                    <input type="time" value="{{ (isset($data['sec2_closed']) && $data['sec2_closed']==1) ? '--:--' : $data['sec2_close'] ?? date('H:i', strtotime('+1hour')) }}" name="sec2_close" class="form-control" id="sec2_close" aria-describedby="sec2_close">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="mb-3 field_error">
                                                    <label for="sec3_week" class="form-label black-color f-600">Week</label>
                                                    <input type="text" disabled name="sec3_week" class="form-control" id="sec3_week" value="WEDNESDAY" aria-describedby="sec3_week" placeholder="WEDNESDAY">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-chec">
                                                    <label class="form-label black-color f-600">Business</label>
                                                    <div class="row rounded border">
                                                        <div class="col-md-6">
                                                            <div class="p-2 my-1">
                                                                <div class="form-group my-auto d-flex">
                                                                    <input @if(isset($data['sec3_closed']) && $data['sec3_closed']==0) checked @elseif(!isset($data['sec3_closed'])) checked @endif type="radio" value="0" name="sec3_closed" id="sec3_opened">
                                                                    <label for="sec3_opened">Open</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="p-2 my-1">
                                                                <div class="form-group my-auto d-flex">
                                                                    <input @if(isset($data['sec3_closed']) && $data['sec3_closed']==1) checked @endif type="radio" value="1" name="sec3_closed" id="sec3_closed">
                                                                    <label for="sec3_closed">Closed</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3 field_error">
                                                    <label for="sec3_open" class="form-label black-color f-600">Open Time</label>
                                                    <input type="time" max="18:00:00" data-num="3" onchange="timeValidate(event);" name="sec3_open" value="{{ (isset($data['sec3_closed']) && $data['sec3_closed']==1) ? '--:--' : $data['sec3_open'] ?? date('H:i') }}" class="form-control" id="sec3_open" aria-describedby="sec3_open">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3 field_error">
                                                    <label for="sec3_close" class="form-label black-color f-600">Close Time</label>
                                                    <input type="time" value="{{ (isset($data['sec3_closed']) && $data['sec3_closed']==1) ? '--:--' : $data['sec3_close'] ?? date('H:i', strtotime('+1hour')) }}" name="sec3_close" class="form-control" id="sec3_close" aria-describedby="sec3_close">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="mb-3 field_error">
                                                    <label for="sec4_week" class="form-label black-color f-600">Week</label>
                                                    <input type="text" disabled name="sec4_week" class="form-control" id="sec4_week" value="THURSDAY" aria-describedby="sec4_week" placeholder="THURSDAY">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-chec">
                                                    <label class="form-label black-color f-600">Business</label>
                                                    <div class="row rounded border">
                                                        <div class="col-md-6">
                                                            <div class="p-2 my-1">
                                                                <div class="form-group my-auto d-flex">
                                                                    <input @if(isset($data['sec4_closed']) && $data['sec4_closed']==0) checked @elseif(!isset($data['sec4_closed'])) checked @endif type="radio" value="0" name="sec4_closed" id="sec4_opened">
                                                                    <label for="sec4_opened">Open</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="p-2 my-1">
                                                                <div class="form-group my-auto d-flex">
                                                                    <input @if(isset($data['sec4_closed']) && $data['sec4_closed']==1) checked @endif type="radio" value="1" name="sec4_closed" id="sec4_closed">
                                                                    <label for="sec4_closed">Closed</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3 field_error">
                                                    <label for="sec4_open" class="form-label black-color f-600">Open Time</label>
                                                    <input type="time" max="18:00:00" data-num="4" onchange="timeValidate(event);" name="sec4_open" value="{{ (isset($data['sec4_closed']) && $data['sec4_closed']==1) ? '--:--' : $data['sec4_open'] ?? date('H:i') }}" class="form-control" id="sec4_open" aria-describedby="sec4_open">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3 field_error">
                                                    <label for="sec4_close" class="form-label black-color f-600">Close Time</label>
                                                    <input type="time" value="{{ (isset($data['sec4_closed']) && $data['sec4_closed']==1) ? '--:--' : $data['sec4_close'] ?? date('H:i', strtotime('+1hour')) }}" name="sec4_close" class="form-control" id="sec4_close" aria-describedby="sec4_close">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="mb-3 field_error">
                                                    <label for="sec5_week" class="form-label black-color f-600">Week</label>
                                                    <input type="text" disabled name="sec5_week" class="form-control" id="sec5_week" value="FRIDAY" aria-describedby="sec5_week" placeholder="FRIDAY">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-chec">
                                                    <label class="form-label black-color f-600">Business</label>
                                                    <div class="row rounded border">
                                                        <div class="col-md-6">
                                                            <div class="p-2 my-1">
                                                                <div class="form-group my-auto d-flex">
                                                                    <input @if(isset($data['sec5_closed']) && $data['sec5_closed']==0) checked @elseif(!isset($data['sec5_closed'])) checked @endif type="radio" value="0" name="sec5_closed" id="sec5_opened">
                                                                    <label for="sec5_opened">Open</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="p-2 my-1">
                                                                <div class="form-group my-auto d-flex">
                                                                    <input @if(isset($data['sec5_closed']) && $data['sec5_closed']==1) checked @endif type="radio" value="1" name="sec5_closed" id="sec5_closed">
                                                                    <label for="sec5_closed">Closed</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3 field_error">
                                                    <label for="sec5_open" class="form-label black-color f-600">Open Time</label>
                                                    <input type="time" value="{{ (isset($data['sec5_closed']) && $data['sec5_closed']==1) ? '--:--' : $data['sec5_open'] ?? date('H:i') }}" max="18:00:00" data-num="5" onchange="timeValidate(event);" name="sec5_open" class="form-control" id="sec5_open" aria-describedby="sec5_open">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3 field_error">
                                                    <label for="sec5_close" class="form-label black-color f-600">Close Time</label>
                                                    <input type="time" value="{{ (isset($data['sec5_closed']) && $data['sec5_closed']==1) ? '--:--' : $data['sec5_close'] ?? date('H:i', strtotime('+1hour')) }}" name="sec5_close" class="form-control" id="sec5_close" aria-describedby="sec5_close">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="mb-3 field_error">
                                                    <label for="sec6_week" class="form-label black-color f-600">Week</label>
                                                    <input type="text" disabled name="sec6_week" class="form-control" id="sec6_week" value="SATURDAY" aria-describedby="sec6_week" placeholder="SATURDAY">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-chec">
                                                    <label class="form-label black-color f-600">Business</label>
                                                    <div class="row rounded border">
                                                        <div class="col-md-6">
                                                            <div class="p-2 my-1">
                                                                <div class="form-group my-auto d-flex">
                                                                    <input @if(isset($data['sec6_closed']) && $data['sec6_closed']==0) checked @elseif(!isset($data['sec6_closed'])) checked @endif type="radio" value="0" name="sec6_closed" id="sec6_opened">
                                                                    <label for="sec6_opened">Open</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="p-2 my-1">
                                                                <div class="form-group my-auto d-flex">
                                                                    <input @if(isset($data['sec6_closed']) && $data['sec6_closed']==1) checked @endif type="radio" value="1" name="sec6_closed" id="sec6_closed">
                                                                    <label for="sec6_closed">Closed</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3 field_error">
                                                    <label for="sec6_open" class="form-label black-color f-600">Open Time</label>
                                                    <input type="time" value="{{ (isset($data['sec6_closed']) && $data['sec6_closed']==1) ? '--:--' : $data['sec6_open'] ?? date('H:i') }}" max="18:00:00" data-num="6" onchange="timeValidate(event);" name="sec6_open" class="form-control" id="sec6_open" aria-describedby="sec6_open">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3 field_error">
                                                    <label for="sec6_close" class="form-label black-color f-600">Close Time</label>
                                                    <input type="time" value="{{ (isset($data['sec6_closed']) && $data['sec6_closed']==1) ? '--:--' : $data['sec6_close'] ?? date('H:i', strtotime('+1hour')) }}" name="sec6_close" class="form-control" id="sec6_close" aria-describedby="sec6_close">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="mb-3 field_error">
                                                    <label for="sec7_week" class="form-label black-color f-600">Week</label>
                                                    <input type="text" disabled name="sec7_week" class="form-control" id="sec7_week" value="SUNDAY" aria-describedby="sec7_week" placeholder="SUNDAY">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-chec">
                                                    <label class="form-label black-color f-600">Business</label>
                                                    <div class="row rounded border">
                                                        <div class="col-md-6">
                                                            <div class="p-2 my-1">
                                                                <div class="form-group my-auto d-flex">
                                                                    <input @if(isset($data['sec7_closed']) && $data['sec7_closed']==0) checked @elseif(!isset($data['sec7_closed'])) checked @endif type="radio" value="0" name="sec7_closed" id="sec7_opened">
                                                                    <label for="sec7_opened">Open</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="p-2 my-1">
                                                                <div class="form-group my-auto d-flex">
                                                                    <input @if(isset($data['sec7_closed']) && $data['sec7_closed']==1) checked @endif type="radio" value="1" name="sec7_closed" id="sec7_closed">
                                                                    <label for="sec7_closed">Closed</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3 field_error">
                                                    <label for="sec7_open" class="form-label black-color f-600">Open Time</label>
                                                    <input type="time" value="{{ (isset($data['sec7_closed']) && $data['sec7_closed']==1) ? '--:--' : $data['sec7_open'] ?? date('H:i') }}" max="18:00:00" data-num="7" onchange="timeValidate(event);" name="sec7_open" class="form-control" id="sec7_open" aria-describedby="sec7_open">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3 field_error">
                                                    <label for="sec7_close" class="form-label black-color f-600">Close Time</label>
                                                    <input type="time" value="{{ (isset($data['sec7_closed']) && $data['sec7_closed']==1) ? '--:--' : $data['sec7_close'] ?? date('H:i', strtotime('+1hour')) }}" name="sec7_close" class="form-control" id="sec7_close" aria-describedby="sec7_close">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="d-flex mt-3 mb-4">
                                    <!-- <a href="{{ route('admin.ebooks') }}"><button type="button" class="outline-btn" type="button">Cancel</button></a> -->
                                    <a><button class="common-btn ms-2">Submit</button></a>
                                </div>
                            </div>
                            <!-- <div class="d-flex">
                                    <a href="javascript:void(0)"><button class="btn common-btn" type="submit">Submit</button></a>
                                </div> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>

</main>
<!-- End Main -->
<script>
    function timeValidate(e) {
        let inputId = e.target.id;
        let num = $("#" + inputId).data('num');
        let hour = e.target.value.split(":")[0];
        let min = e.target.value.split(":")[1];
        hour = parseInt(hour) + 1;
        hour = hour.toString();
        if(hour.length == 1){
            hour = '0'+hour;
        }
        $("#sec" + num + "_close").attr('min', hour + ":" + min);
    }

    $(document).on("change", "input[type='radio']", function() {
        let id = $(this).attr('id');
        let value = $(this).val();
        id = id.split("_")[0];
        let dt = new Date();
        let opentime = (dt.getHours()) + ":" + (dt.getMinutes());
        let closetime = (dt.getHours()+1) + ":" + (dt.getMinutes());
        if(value == 0){
            $("#" + id + "_close").val(closetime);
            $("#" + id + "_open").val(opentime);
        } else {
            console.log("else");
            $("#" + id + "_close").val("--:--");
            $("#" + id + "_open").val("--:--");
        }
    })

    $(document).ready(function() {

        $('#hour_form').validate({
            rules: {

            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                // error.addClass("invalid-feedback");
                element.addClass("border border-danger");
                element.closest(".file").addClass("border border-danger");
                element.closest(".form-check").addClass("border border-danger");
            },
            highlight: function(element, errorClass, validClass) {
                $('.please-wait').hide();

            },
            unhighlight: function(element, errorClass, validClass) {
                // $(element).removeClass("text-danger");
                $(element).removeClass("border border-danger");
                $(element).closest(".file").removeClass("border border-danger");
                $(element).closest(".form-check").removeClass("border border-danger");
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                form.submit();
            }
        });
    })
</script>
@endsection