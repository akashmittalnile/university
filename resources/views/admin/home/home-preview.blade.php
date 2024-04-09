<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ isset(adminData()->business_logo) ? assets('uploads/logo/'.adminData()->business_logo) : assets('frontend/images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- -------testimonial-------- -->
    <link rel="stylesheet" type="text/css" href="{{ assets('plugins/OwlCarousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ assets('frontend/css/common.css') }}">
    <link rel="stylesheet" href="{{ assets('frontend/css/home.css') }}">
    <link rel="stylesheet" href="{{ assets('frontend/css/mark-network.css') }}">

    <link rel="stylesheet" href="{{ assets('frontend/css/header-footer.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <title>University PMO</title>
    <style>
        .swal2-confirm {
            background: #3FAB40 !important;
        }
    </style>
</head>

<body>
    @if($home->section_code == 'banner')
    <section class="banner" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('public/uploads/content/{{$home->image}}' ), background-repeat: no-repeat;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="left-section">
                        <h1 class="white-color f-600">{{ $home->title ?? 'NA' }}</h1>
                        <!-- <p class="white-color mt-3 f-500 text-capitalize">We help you deliver them with confidence</p> -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-section">
                        <h5 class="text-capitalize white-color">{{ $home->description ?? 'NA' }}</h5>
                        <a href="javascript:void(0)"><button class="btn common-btn mt-4">Sign Up</button></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if($home->section_code == 'testimonial')
    @if(count($test) > 0)
    <section class="testimonials">
        <h1 class="mt-4 text-center f-600">Testimonials<b class="main-color"></b></h1>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="customers-testimonials" class="owl-carousel">

                        @forelse($test as $key => $val)
                        <div class="item">
                            <div class="customers-testimonials-card">
                                <div class="customers-testimonials-image">
                                    <img src="{{ assets('uploads/testimonial/'.$val->image) }}" alt="">
                                </div>
                                <div class="customers-testimonials-content">
                                    <h6 class="main-color mt-2 text-left">{{ $val->title ?? 'NA' }}</h6>
                                    <p>{{ $val->description ?? 'NA' }}</p>
                                    <hr class="main-color">
                                    <h4 class="client-name black-color f-500"><i class="bi bi-dash-lg me-2 main-color"></i>{{ $val->designation ?? 'NA' }}</h4>
                                </div>
                            </div>
                        </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    @endif

    @if($home->section_code == 'video')
    @if(count($video) > 0)
    <section class="youtube">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="owl-carousel owl-theme pmoCarousel">
                        @forelse($video as $key => $val)
                        <div class="item">
                            <div class="shadow-effect">
                                <iframe src="{{ $val->link ?? 'https://www.youtube.com/embed/XV1cOGaZUq0?si=LMIXLag_k_VxIP1k' }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                <!-- <img style="margin: 0; max-width: 350px" class="img-circle img-fluid rounded"
                                    src="{{ assets('uploads/testimonial/'.$val->image) }}"
                                    alt=""> -->
                                <h6 class="main-color mt-2 text-left">{{ $val->title ?? 'NA' }}</h6>
                                <!-- <p>{{ $val->description ?? 'NA' }}</p>
                                <hr class="main-color">
                                <h4 class="client-name black-color f-500"><i class="bi bi-dash-lg me-2 main-color"></i>{{ $val->designation ?? 'NA' }}</h4> -->
                            </div>
                        </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    @endif

    @if($home->section_code == 'badge')
    @if(count($badges) > 0)
    <section class="testimonial">
        <h1 class="mt-4 text-center f-600">Affiliate <b class="main-color"> Badges</b></h1>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="customers-testimonials1" class="owl-carousel">

                        @forelse($badges as $key => $val)
                        <div class="item">
                            <div class="affiliate-badges-card">
                                <div class="affiliate-c-media">
                                    <img src="{{ assets('uploads/badges/'.$val->path) }}" alt="">
                                </div>
                                <div class="affiliate-Badges-media">
                                    <h6 class="main-color mt-2 text-left">{{ $val->title ?? '' }}</h6>
                                    <p>{{ $val->description ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                        @empty
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    @endif

    @if($home->section_code == 'community')
    <div class="become-a-member" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('public/uploads/content/{{$home->image}}' ), background-repeat: no-repeat;">
        <div class="container">
            <h1 class="mb-4 white-color text-center">{{ $home->title ?? 'NA' }}</h1>
            <p class="text-center white-color">{{ $home->description ?? 'NA' }}</p>
        </div>
    </div>
    @endif

    <script src="{{ assets('frontend/js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="{{ assets('plugins/OwlCarousel/owl.carousel.min.js') }}" type="text/javascript"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="{{ assets('/frontend/js/script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <script src="{{ assets('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script>
        $('.pmoCarousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            responsive: {
                1000: {
                    items: 1
                },
            }
        });
    </script>
</body>