<div class="main-title d-flex align-items-center">
    <div class="page-title d-flex align-items-center">
        @hasSection('back')
        <a href="@yield('back')"><i class="bi bi-arrow-left-circle-fill main-color me-3"></i></a>
        @endif
        @hasSection('heading')
        <h3 class="font-weight-bold black-color">
            @yield('heading')
        </h3>
        @endif
        @hasSection('count')
        <div class="count-bg ms-2">
            <p class=" white-color">@yield('count')</p>
        </div>
        @endif
    </div>
    <div class="profile-link">
        <a href="#">
            <div class="d-flex align-items-center">
                <div class="profile-pic">
                    <img src="{{ isset(auth()->user()->profile) ? assets("uploads/profile/".auth()->user()->profile) : assets('admin/images/no-image.jpg')}}" alt="profile image" class="img-fluid me-2" />
                </div>
                <div class="button-link">
                    <a href="{{ route('admin.profile') }}" class="profile-name">{{auth()->user()->name ?? 'Admin Profile'}}<i class="bi bi-arrow-right ms-2"></i></a>
                </div>
            </div>
        </a>
    </div>
</div>