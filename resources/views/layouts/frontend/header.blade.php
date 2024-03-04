<div id="header">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-default navbar-fixed-top">
            <div class="navbar-brand d-block d-lg-none" href="#">
                <a href="index.html"><img src="{{ asset('frontend/images/logo.png') }}" alt=""></a>
            </div>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="toggler-icon length-1 top-bar"></span>
                <span class="toggler-icon length-2 middle-bar"></span>
                <span class="toggler-icon length-3 bottom-bar"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('accomplishment') }}">Accomplishment Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('markNetwork') }}">Mark Network</a>
                    </li>
                </ul>
                <div class="navbar-brand d-none d-lg-block" href="#">
                    <a href="{{ route('home') }}"><img src="{{ asset('frontend/images/logo.png') }}" alt=""
                            class="img-fluid"></a>
                </div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('affiliate') }}">Business Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('markBurnet') }}">Mark Burnet Foundation</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Resources
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('resources') }}">Resources</a></li>
                            <li><a class="dropdown-item" href="{{ route('e_book') }}">E-Book</a></li>
                            <li><a class="dropdown-item" href="{{ route('podcast') }}">Podcast</a></li>
                            <li><a class="dropdown-item" href="{{ route('blogs') }}">Blogs</a></li>
                            <li><a class="dropdown-item" href="{{ route('products') }}">Products</a></li>
                        </ul>
                    </li>
                    @if (auth()->user())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.subscription') }}">Subscription</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0)" id="logout-btn">Logout</a></li>
                                <a href="{{ route('user.logout') }}" class="d-none" id="trigger-logout-btn">l</a>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                More
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('home') }}#contact">Contact Us</a></li>
                                <li><a class="dropdown-item" href="{{ route('signup') }}">Sign Up</a></li>
                                <li><a class="dropdown-item" href="{{ route('signin') }}">Sign In</a></li>
                            </ul>
                        </li>
                    @endif


                </ul>
            </div>
        </nav>
    </div>
</div>
<script>
    $(document).on("click", "#logout-btn", function() {
        Swal.fire({
            title: "Are you sure?",
            text: "You want to logout?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Logout"
        }).then((result) => {
            if (result.isConfirmed) {
                $("#trigger-logout-btn")[0].click();
            }
        });
    });
</script>