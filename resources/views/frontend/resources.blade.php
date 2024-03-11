@extends('layouts.frontend.app')
@push('css')
<link rel="stylesheet" href="{{ assets('frontend/css/resources.css') }}">
@endpush
@section('content')
<section class="resources">
    <div class="resourse-banner">
        <div class="resources-box common-shadow">
            <h1 class="white-color head-1 mb-4 text-center">Our Recent Blogs</h1>
            <p class="text-center white-color mt-4">Giving you the proffessional guidance and expert tools you need to
                execute projects with soaring success to become leaders in business and beyond.</p>
        </div>
    </div>
    <div class="blogs">
        <div class="container">
            <div class="row">
                @forelse($blogs as $key => $val)
                <div class="col-md-4 mb-3 block">
                    <div class="card float">
                        <div class="img-box">
                            @if(isset($val->image))
                            <img src="{{ assets("uploads/blogs/".$val->image) }}" alt="image" class="img-fluid">
                            @else
                            <img src="{{ assets('frontend/images/gallery-1.jpg') }}" alt="image" class="img-fluid">
                            @endif
                        </div>
                        <h5 class="black-color text-capitalize mt-3">{{ $val->title ?? 'NA' }}</h5>
                        <p class="mt-3 text-color text-capitalize m-0 p-0">{!! $val->description !!}</p>
                        @if(isset(auth()->user()->id))
                        <a target="_blank" href="{{ $val->links }}"><button class="btn learn-more-btn">Read me <i class="bi bi-arrow-right ms-2"></i></button></a>
                        @endif
                    </div>
                </div>
                @empty
                @endforelse

            </div>
            <div class="text-center mt-4">
                <a href="{{ route('blogs') }}"><button class="btn common-btn">View More</button></a>
            </div>
        </div>
    </div>
    <div class="e-book">
        <div class="container">
            <h1 class="white-color f-600 text-center mb-5">E-Books</h1>
            <div class="blog">
                <div class="container">
                    <div class="row">
                        @forelse($ebooks as $val)
                        <div class="col-md-4 mb-3">
                            <a href="blog.html">
                                <div class="card float">
                                    <div class="img-box">
                                        <img src="{{ assets("uploads/ebooks/".$val['thumbnail']) }}" alt="image" class="img-fluid">
                                    </div>
                                    <h5 class="black-color mt-3 text-capitalize">{{ $val['name'] ?? 'NA' }}</h5>
                                    <p class="mt-3 text-color text-capitalize m-0 p-0">{!! $val['description'] ?? "NA" !!}</p>
                                    @if(isset(auth()->user()->id))
                                        @if($val['purchase'])
                                        <a target="_blank" href="{{ assets("uploads/ebooks/".$val['pdf_file']) }}"><button class="btn learn-more-btn">View PDF <i class="bi bi-file-earmark-arrow-up"></i></button></a>
                                        @else
                                        <a target="_blank" href="{{ route('user.subscription') }}"><button class="btn learn-more-btn">Subscribe</button></a>
                                        @endif
                                    @endif
                                </div>
                            </a>
                        </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('e_book') }}"><button class="btn load-more">View More</button></a>
            </div>
        </div>
    </div>
    <!-- <div class="news-letter">
        <div class="container">
            <div class="news-letter-box">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="left-section">
                            <img src="{{ assets('frontend/images/newsletter.jpg') }}" alt="image" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="right-section">
                            <h1 class="black-color">Subscribe to the <b class="main-color">Newsletter</b></h1>
                            <p class=" text-color">Most importantly, ECONO-ProjectEX is commited to collaborate with
                                international project management community, and offer tremendous advantages to
                                Micro,Small and Medium-sized enterprises(MSMEs).</p>
                            <form action="#">
                                <div class="form-floating mb-3">
                                    <input type="name" class="form-control" id="floatingInput" placeholder="Enter your name">
                                    <label for="floatingInput">Name</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="email" class="form-control" id="floatingInput" placeholder="Enter your email Id">
                                    <label for="floatingInput">Email address</label>
                                </div>
                                <a href="javascript:void(0)"><button type="button" class="btn common-btn">Submit<i class="bi bi-arrow-right ms-3"></i></button></a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="speaking">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="left-section">
                        <h1 class="black-color f-600">Speaking</h1>
                        <p class="text-color mt-3 text-justify">Most importantly, ECONO-ProjectEX is committed to
                            collaborate with the international project management community, and offer tremendous
                            advantages to Micro, Small and Medium-sized enterprises (MSMEs): Executives/ Sponsors,
                            Entrepreneurs, Consultants, Contractors, Teachers, Students, Project/ Senior Managers,
                            Project Management Offices (PMOs) among others who are eager to shift and serve their
                            industries.</p>
                        <!-- <a href="#"><button class="btn mt-md-3 common-btn">Load More<i class="bi bi-arrow-right ms-3"></i></button></a> -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-section">
                        <img src="{{ assets('frontend/images/event.jpg') }}" alt="image" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="podcast">
        <div class="container">
            <h1 class="white-color f-600 text-center mb-5">Podcasts</h1>
            <div class="blog">
                <div class="container">
                    <div class="row">
                        @forelse($podcasts as $val)
                        <div class="col-md-4 mb-3">
                            <a href="blog.html">
                                <div class="card float">
                                    <div class="img-box">
                                        <img src="{{ assets("uploads/podcasts/".$val['thumbnail']) }}" alt="image" class="img-fluid">
                                    </div>
                                    <h5 class="black-color mt-3 text-capitalize">{{ $val['name'] ?? 'NA' }}</h5>
                                    <p class="mt-3 text-color text-capitalize m-0 p-0">{!! $val['description'] ?? "NA" !!}</p>
                                    @if(isset(auth()->user()->id))
                                        @if($val['purchase'])
                                            @if($val['file_type']=='1')
                                            <a target="_blank" href="{{ assets("uploads/podcasts/".$val['audio_file']) }}"><button class="btn learn-more-btn">Listen <i class="bi bi-play-circle ms-2"></i></button></a>
                                            @else
                                            <a target="_blank" href="{{ route('view.podcast', encrypt_decrypt('encrypt', $val['id'])) }}"><button class="btn learn-more-btn">Listen <i class="bi bi-play-circle ms-2"></i></button></a>
                                            @endif
                                        @else
                                        <a target="_blank" href="{{ route('user.subscription') }}"><button class="btn learn-more-btn">Subscribe</button></a>
                                        @endif
                                    @endif
                                </div>
                            </a>
                        </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('podcast') }}"><button class="btn load-more">View More</button></a>
            </div>
        </div>
    </div>
    <div class="events">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="left-section">
                        <img src="{{ assets('frontend/images/event.jpg') }}" alt="image" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-section">
                        <h1 class="black-color f-600">Events</h1>
                        <p class="text-color mt-3 text-justify">Most importantly, ECONO-ProjectEX is committed to
                            collaborate with the international project management community, and offer tremendous
                            advantages to Micro, Small and Medium-sized enterprises (MSMEs): Executives/ Sponsors,
                            Entrepreneurs, Consultants, Contractors, Teachers, Students, Project/ Senior Managers,
                            Project Management Offices (PMOs) among others who are eager to shift and serve their
                            industries.</p>
                        <!-- <a href="#"><button class="btn mt-3 common-btn">Load More<i class="bi bi-arrow-right ms-3"></i></button></a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="conference">
        <div class="container">
            <h1 class="f-600 white-color">Conferences</h1>
            <p class="white-color mt-4 text-justify">Most importantly, ECONO-ProjectEX is committed to collaborate with
                the international project management community, and offer tremendous advantages to Micro, Small and
                Medium-sized enterprises (MSMEs): Executives/ Sponsors, Entrepreneurs, Consultants, Contractors,
                Teachers, Students, Project/ Senior Managers, Project Management Offices (PMOs) among others who are
                eager to shift and serve their industries.</p>
            <!-- <a href="#"><button class="btn mt-3">Load More<i class="bi bi-arrow-right ms-3"></i></button></a> -->
        </div>
    </div>
    
    <div class="webinar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="video-box">
                        <video autoplay="" loop="" controls="" width="100%" height="480">
                            <source type="video/mp4" src="{{ assets('frontend/images/webinar.mp4') }}">
                        </video>
                    </div>
                </div>
                <div class="col-md-5">
                    <h1 class="black-color f-600">Webinar</h1>
                    <p class="text-color mt-3 text-justify">Most importantly, ECONO-ProjectEX is committed to
                        collaborate with the international project management community, and offer tremendous advantages
                        to Micro, Small and Medium-sized enterprises (MSMEs): Executives/ Sponsors, Entrepreneurs,
                        Consultants, Contractors, Teachers, Students, Project/ Senior Managers, Project Management
                        Offices (PMOs) among others who are eager to shift and serve their industries.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="interviews">
        <div class="container">
            <h1 class="black-color text-center mb-4 f-600">Interviews</h1>
            <div class="video-box common-shadow">
                <div class="rwd-media">
                    <iframe width="448" height="252" src="https://www.youtube.com/embed/LfaMVlDaQ24?si=JrXVLDl3rkamXQdd" title="YouTube video player" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                </div>
            </div>
            <p class="text-color mt-3 text-justify">Most importantly, ECONO-ProjectEX is committed to collaborate with
                the international project management community, and offer tremendous advantages to Micro, Small and
                Medium-sized enterprises (MSMEs): Executives/ Sponsors, Entrepreneurs, Consultants, Contractors,
                Teachers, Students, Project/ Senior Managers, Project Management Offices (PMOs) among others who are
                eager to shift and serve their industries.</p>
        </div>
    </div>
    <!-- <div class="business-links">
        <div class="container">
            <h1 class="black-color text-center text-capitalize">News <b class="main-color">&</b> Updates</h1>
            <div class="business-link-contents">
                <div class="link-box mb-3">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <div class="left-section">
                                <img src="{{ assets('frontend/images/business-links-1.jpg') }}" alt="image" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="right-section">
                                <h4 class="black-color mb-4 f-600">ECONO-ProjectEX provides effective</h4>
                                <p class="text-color">In a fully digital world ECONO-ProjectEX provides effective
                                    consultive/adivisory. change management, managed & technical implimentation services
                                    tailored to address the entire breadth of your bsiness needs and success.</p>
                                <br>
                                <p class="black-color">We're focussed on helping Micro, Small and Medium-seized
                                    enterprices(MSMEs)</p>
                                <a href="#"><button class="btn learn-more-btn mt-2">Learn More<i class="bi bi-arrow-right ms-3"></i></button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="link-box mb-3">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <div class="left-section">
                                <img src="{{ assets('frontend/images/business-links-1.jpg') }}" alt="image" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="right-section">
                                <h4 class="black-color mb-4 f-600">ECONO-ProjectEX provides effective</h4>
                                <p class="text-color">In a fully digital world ECONO-ProjectEX provides effective
                                    consultive/adivisory. change management, managed & technical implimentation services
                                    tailored to address the entire breadth of your bsiness needs and success.</p>
                                <br>
                                <p class="black-color">We're focussed on helping Micro, Small and Medium-seized
                                    enterprices(MSMEs)</p>
                                <a href="#"><button class="btn learn-more-btn mt-2">Learn More<i class="bi bi-arrow-right ms-3"></i></button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="link-box mb-3">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <div class="left-section">
                                <img src="{{ assets('frontend/images/business-links-1.jpg') }}" alt="image" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="right-section">
                                <h4 class="black-color mb-4 f-600">ECONO-ProjectEX provides effective</h4>
                                <p class="text-color">In a fully digital world ECONO-ProjectEX provides effective
                                    consultive/adivisory. change management, managed & technical implimentation services
                                    tailored to address the entire breadth of your bsiness needs and success.</p>
                                <br>
                                <p class="black-color">We're focussed on helping Micro, Small and Medium-seized
                                    enterprices(MSMEs)</p>
                                <a href="#"><button class="btn learn-more-btn mt-2">Learn More<i class="bi bi-arrow-right ms-3"></i></button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="link-box mb-3">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <div class="left-section">
                                <img src="{{ assets('frontend/images/business-links-1.jpg') }}" alt="image" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="right-section">
                                <h4 class="black-color mb-4 f-600">ECONO-ProjectEX provides effective</h4>
                                <p class="text-color">In a fully digital world ECONO-ProjectEX provides effective
                                    consultive/adivisory. change management, managed & technical implimentation services
                                    tailored to address the entire breadth of your bsiness needs and success.</p>
                                <br>
                                <p class="black-color">We're focussed on helping Micro, Small and Medium-seized
                                    enterprices(MSMEs)</p>
                                <a href="#"><button class="btn learn-more-btn mt-2">Learn More<i class="bi bi-arrow-right ms-3"></i></button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <a href="#"><button class="btn common-btn mt-5 load-more-btn">Load More<i class="bi bi-arrow-down ms-2"></i></button></a>
                </div>
            </div>
        </div>
    </div> -->
</section>
@endsection