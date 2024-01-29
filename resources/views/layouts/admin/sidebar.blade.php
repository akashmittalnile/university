<aside id="sidebar">
    <div class="sidebar-title">
        <img src="{{ asset('/admin/images/logo.png') }}" alt="logo" class="img-fluid sidebar-logo" />
    </div>

    <ul class="sidebar-list">
        <li class="sidebar-list-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}"><i class="bi bi-grid me-2"></i>Dashboard</a>
        </li>
        <li class="sidebar-list-item {{ Route::is('admin.users*') ? 'active' : '' }}">
            <a href="{{ route('admin.users.index') }}"><i class="bi bi-person-check me-2"></i>User
                Management</a>
        </li>
        <li class="sidebar-list-item {{ Route::is('admin.plans*') ? 'active' : '' }}">
            <a href="{{ route('admin.plans.index') }}"><i class="bi bi-clipboard2-data me-2"></i>Manage
                Membership Plans</a>
        </li>
        <li class="sidebar-list-item {{ Route::is('admin.ebooks*') ? 'active' : '' }}">
            <a href="{{ route('admin.ebooks') }}"><i class="bi bi-file-text me-2"></i>Manage
                E-book</a>
        </li>
        <li class="sidebar-list-item {{ Route::is('admin.podcasts*') ? 'active' : '' }}">
            <a href="{{ route('admin.podcasts') }}"><i class="bi bi-file-text me-2"></i>Manage
                Podcast</a>
        </li>
        <li class="sidebar-list-item {{ Route::is('admin.product*') ? 'active' : '' }}">
            <a href="{{ route('admin.product') }}"><i class="bi bi-file-text me-2"></i>Manage
                Products</a>
        </li>
        <li class="sidebar-list-item {{ Route::is('admin.blog*') ? 'active' : '' }}">
            <a href="{{ route('admin.blog') }}"><i class="bi bi-file-text me-2"></i>Manage
                Blogs</a>
        </li>
        <div class="side-head mt-3">
            <p class="white-color m-0 p-0">Manage Page Content</p>
        </div>
        <li class="sidebar-list-item {{ Route::is('admin.about') ? 'active' : '' }}">
            <a href="{{ route('admin.about') }}"><i class="bi bi-list-ul me-2"></i>About Us</a>
        </li>
        <li class="sidebar-list-item {{ Route::is('admin.image') ? 'active' : '' }}">
            <a href="{{ route('admin.image') }}"><i class="bi bi-card-image me-2"></i>Manage Image</a>
        </li>
        <li class="sidebar-list-item {{ Route::is('admin.gallery') ? 'active' : '' }}">
            <a href="{{ route('admin.gallery') }}"><i class="bi bi-card-image me-2"></i>Accomplishment
                Gallery</a>
        </li>
        <li class="sidebar-list-item {{ Route::is('admin.markNetwork') ? 'active' : '' }}">
            <a href="{{ route('admin.markNetwork') }}"><i class="bi bi-files me-2"></i>Mark Network</a>
        </li>
        <li class="sidebar-list-item {{ Route::is('admin.affiliate') ? 'active' : '' }}">
            <a href="{{ route('admin.affiliate') }}"><i class="bi bi-box-arrow-up-right me-2"></i>Affiliate Links</a>
        </li>
        <li class="sidebar-list-item {{ Route::is('admin.markBurnet') ? 'active' : '' }}">
            <a href="{{ route('admin.markBurnet') }}"><i class="bi bi-buildings me-2"></i>Mark Burnet
                Foundation</a>
        </li>
        <li class="sidebar-list-item {{ Route::is('admin.resources') ? 'active' : '' }}">
            <a href="{{ route('admin.resources') }}"><i class="bi bi-book me-2"></i>Resources</a>
        </li>
        <li class="sidebar-list-item {{ Route::is('admin.contacts') ? 'active' : '' }}">
            <a href="{{ route('admin.contacts') }}"><i class="bi bi-person-rolodex me-2"></i>Contact
                Us</a>
        </li>
        <li class="sidebar-list-item logout-item">
            <a href="javascript:void(0)" id="logout-btn">Logout</a>
            <a href="{{ route('admin.logout') }}" class="d-none" id="trigger-logout-btn">l</a>
        </li>
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
