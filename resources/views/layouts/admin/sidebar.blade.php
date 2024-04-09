<aside id="sidebar">
    <div class="sidebar-title">
        <img src="{{ isset(adminData()->business_logo) ? assets('uploads/logo/'.adminData()->business_logo) : assets('frontend/images/logo.png') }}" alt="logo" class="img-fluid sidebar-logo" />
    </div>

    <ul class="sidebar-list">
        
        <a href="{{ route('admin.dashboard') }}">
            <li class="sidebar-list-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid me-2"></i>Dashboard
            </li>
        </a>
        <a href="{{ route('admin.users.index') }}">
            <li class="sidebar-list-item {{ Route::is('admin.users*') ? 'active' : '' }}">
                <i class="bi bi-person-check me-2"></i>User
                    Management
            </li>
        </a>
        <a href="{{ route('admin.plans.index') }}">
            <li class="sidebar-list-item {{ Route::is('admin.plans*') ? 'active' : '' }}">
                <i class="bi bi-clipboard2-data me-2"></i>Manage
                    Membership Plans
            </li>
        </a>
        <a href="{{ route('admin.transaction.logs') }}">
            <li class="sidebar-list-item {{ Route::is('admin.transaction*') ? 'active' : '' }}">
                <i class="bi bi-clipboard2-data me-2"></i>Manage
                    Transaction Logs
            </li>
        </a>
        <a href="{{ route('admin.ebooks') }}">
            <li class="sidebar-list-item {{ Route::is('admin.ebooks*') ? 'active' : '' }}">
                <i class="bi bi-file-text me-2"></i>Manage
                    E-book
            </li>
        </a>
        <a href="{{ route('admin.podcasts') }}">
            <li class="sidebar-list-item {{ Route::is('admin.podcasts*') ? 'active' : '' }}">
                <i class="bi bi-file-text me-2"></i>Manage
                    Podcast
            </li>
        </a>
        <a href="{{ route('admin.product') }}">
            <li class="sidebar-list-item {{ Route::is('admin.product*') ? 'active' : '' }}">
                <i class="bi bi-file-text me-2"></i>Manage
                    Products
            </li>
        </a>
        <a href="{{ route('admin.blog') }}">
            <li class="sidebar-list-item {{ Route::is('admin.blog*') ? 'active' : '' }}">
                <i class="bi bi-file-text me-2"></i>Manage
                    Blogs
            </li>
        </a>
        <a href="{{ route('admin.social.media') }}">
            <li class="sidebar-list-item {{ Route::is('admin.social.media*') ? 'active' : '' }}">
                <i class="bi bi-file-text me-2"></i>Manage
                    Social Media Links
            </li>
        </a>
        <div class="side-head mt-3">
            <p class="white-color m-0 p-0">Manage Page Content</p>
        </div>
        <!-- <a href="{{ route('admin.image') }}">
            <li class="sidebar-list-item {{ Route::is('admin.image') ? 'active' : '' }}">
                <i class="bi bi-card-image me-2"></i>Manage Image
            </li>
        </a> -->
        <a href="{{ route('admin.manage.home') }}">
            <li class="sidebar-list-item {{ (Route::is('admin.manage.home') || Route::is('admin.manage.videos') || Route::is('admin.manage.affiliate-badges') || Route::is('admin.manage.testimonial') || Route::is('admin.affiliate.badges')) ? 'active' : '' }}">
                <i class="bi bi-list-ul me-2"></i>Manage Home
            </li>
        </a>
        <a href="{{ route('admin.about') }}">
            <li class="sidebar-list-item {{ (Route::is('admin.about') || Route::is('admin.team.member')) ? 'active' : '' }}">
                <i class="bi bi-list-ul me-2"></i>Manage About Us
            </li>
        </a>
        <a href="{{ route('admin.gallery') }}">
            <li class="sidebar-list-item {{ Route::is('admin.gallery') ? 'active' : '' }}">
                <i class="bi bi-card-image me-2"></i>Accomplishment
                    Gallery
            </li>
        </a>
        <a href="{{ route('admin.markNetwork') }}">
            <li class="sidebar-list-item {{ Route::is('admin.markNetwork') ? 'active' : '' }}">
                <i class="bi bi-files me-2"></i>Mark Network
            </li>
        </a>
        <a href="{{ route('admin.affiliate') }}">
            <li class="sidebar-list-item {{ Route::is('admin.affiliate') ? 'active' : '' }}">
                <i class="bi bi-box-arrow-up-right me-2"></i>Business Services
            </li>
        </a>
        <a href="{{ route('admin.markBurnet') }}">
            <li class="sidebar-list-item {{ Route::is('admin.markBurnet') ? 'active' : '' }}">
                <i class="bi bi-buildings me-2"></i>Mark Burnet
                    Foundation
            </li>
        </a>
        <!-- <a href="{{ route('admin.resources') }}">
            <li class="sidebar-list-item {{ Route::is('admin.resources') ? 'active' : '' }}">
                <i class="bi bi-book me-2"></i>Resources
            </li>
        </a> -->
        <a href="{{ route('admin.contacts') }}">
            <li class="sidebar-list-item {{ (Route::is('admin.contacts') || Route::is('admin.business.hours')) ? 'active' : '' }}">
                <i class="bi bi-person-rolodex me-2"></i>Contact
                    Us
            </li>
        </a>
        <a href="{{ route('admin.logout') }}" id="trigger-logout-btn logout-btn">
            <li class="sidebar-list-item logout-item">
                <i class="bi-box-arrow-left me-2"></i>
                Logout
            </li>
        </a>
    </ul>
</aside>
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
<!-- End Sidebar -->
