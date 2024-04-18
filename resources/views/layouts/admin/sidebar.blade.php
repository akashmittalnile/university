<aside id="sidebar">
    <div class="sidebar-title">
        <img src="{{ isset(adminData()->business_logo) ? assets('uploads/logo/'.adminData()->business_logo) : assets('frontend/images/logo.png') }}" alt="logo" class="img-fluid sidebar-logo" />
    </div>

    <ul class="sidebar-list">
        <li class="sidebar-list-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}">
                <i class="bi bi-grid me-2"></i>Dashboard
            </a>
        </li>
        <li class="sidebar-list-item {{ Route::is('admin.users*') ? 'active' : '' }}">
            <a href="{{ route('admin.users.index') }}">
                <i class="bi bi-person-check me-2"></i>User
                    Management
            </a>
        </li>
        <li class="sidebar-list-item {{ Route::is('admin.plans*') ? 'active' : '' }}">
            <a href="{{ route('admin.plans.index') }}">
                <i class="bi bi-award me-2"></i>Manage
                    Membership Plans
            </a>
        </li>
        <li class="sidebar-list-item {{ Route::is('admin.transaction*') ? 'active' : '' }}">
            <a href="{{ route('admin.transaction.logs') }}">
                <i class="bi bi-cash-coin me-2"></i>Manage Transaction Logs
            </a>
        </li>

        <li class="sidebar-list-item sidebar-subnav {{ (Route::is('admin.manage.home') || Route::is('admin.manage.videos') || Route::is('admin.manage.affiliate-badges') || Route::is('admin.manage.testimonial') || Route::is('admin.affiliate.badges') || Route::is('admin.about') || Route::is('admin.team.member') || Route::is('admin.gallery') || Route::is('admin.markNetwork') || Route::is('admin.affiliate') || Route::is('admin.markBurnet')) ? 'active' : '' }}">
            <a data-bs-toggle="collapse" data-bs-target="#collapseContent">
                <i class="bi bi-file-richtext me-2"></i> Manage Page Content <i class="bi bi-chevron-down"></i>
            </a>

            <ul id="collapseContent" class="collapse  {{ (Route::is('admin.manage.home') || Route::is('admin.manage.videos') || Route::is('admin.manage.affiliate-badges') || Route::is('admin.manage.testimonial') || Route::is('admin.affiliate.badges') || Route::is('admin.about') || Route::is('admin.team.member') || Route::is('admin.gallery') || Route::is('admin.markNetwork') || Route::is('admin.affiliate') || Route::is('admin.markBurnet')) ? 'show' : '' }}">
                <li class="sidebar-list-item {{ (Route::is('admin.manage.home') || Route::is('admin.manage.videos') || Route::is('admin.manage.affiliate-badges') || Route::is('admin.manage.testimonial') || Route::is('admin.affiliate.badges')) ? 'active' : '' }}">
                    <a href="{{ route('admin.manage.home') }}">
                        <i class="bi bi-list-ul me-2"></i>Manage Home
                    </a>
                </li>
                <li class="sidebar-list-item {{ (Route::is('admin.about') || Route::is('admin.team.member')) ? 'active' : '' }}">
                    <a href="{{ route('admin.about') }}">
                        <i class="bi bi-list-ul me-2"></i>Manage About Us
                    </a>
                </li>
                <li class="sidebar-list-item {{ Route::is('admin.gallery') ? 'active' : '' }}">
                    <a href="{{ route('admin.gallery') }}">
                        <i class="bi bi-card-image me-2"></i>Accomplishment Gallery
                    </a>
                </li>
                <li class="sidebar-list-item {{ Route::is('admin.markNetwork') ? 'active' : '' }}">
                    <a href="{{ route('admin.markNetwork') }}">
                        <i class="bi bi-files me-2"></i>Mark Network
                    </a>
                </li>
                <li class="sidebar-list-item {{ Route::is('admin.affiliate') ? 'active' : '' }}">
                    <a href="{{ route('admin.affiliate') }}">
                        <i class="bi bi-box-arrow-up-right me-2"></i>Business Services
                    </a>
                </li>
                <li class="sidebar-list-item {{ Route::is('admin.markBurnet') ? 'active' : '' }}">
                    <a href="{{ route('admin.markBurnet') }}">
                        <i class="bi bi-buildings me-2"></i>Mark Burnet Foundation
                    </a>
                </li>
            </ul>
        </li>
    
        <li class="sidebar-list-item sidebar-subnav  {{ (Route::is('admin.ebooks*') || Route::is('admin.podcasts*') || Route::is('admin.product*') || Route::is('admin.blog*')) ? 'active' : '' }}" >
            <a  data-bs-toggle="collapse" data-bs-target="#collapseResources">
                <i class="bi bi-gear me-2"></i> Resources <i class="bi bi-chevron-down"></i>
            </a>
            <ul id="collapseResources" class="collapse {{ (Route::is('admin.ebooks*') || Route::is('admin.podcasts*') || Route::is('admin.product*') || Route::is('admin.blog*')) ? 'show' : '' }}">
                <li class="sidebar-list-item {{ Route::is('admin.ebooks*') ? 'active' : '' }}">
                    <a href="{{ route('admin.ebooks') }}">
                        <i class="bi bi-file-text me-2"></i>Manage E-book
                    </a>
                </li>
                <li class="sidebar-list-item {{ Route::is('admin.podcasts*') ? 'active' : '' }}">
                    <a href="{{ route('admin.podcasts') }}">
                        <i class="bi bi-file-text me-2"></i>Manage Podcast
                    </a>
                </li>
                <li class="sidebar-list-item {{ Route::is('admin.product*') ? 'active' : '' }}">
                    <a href="{{ route('admin.product') }}">
                        <i class="bi bi-file-text me-2"></i>Manage Products
                    </a>
                </li>

                <li class="sidebar-list-item {{ Route::is('admin.blog*') ? 'active' : '' }}">
                    <a href="{{ route('admin.blog') }}">
                        <i class="bi bi-file-text me-2"></i>Manage Blogs
                    </a>
                </li>
            </ul>
        </li>

        <li class="sidebar-list-item {{ Route::is('admin.social.media*') ? 'active' : '' }}">
            <a href="{{ route('admin.social.media') }}">
                <i class="bi bi-link me-2"></i>Manage
                    Social Media Links
            </a>
        </li>
        <li class="sidebar-list-item {{ (Route::is('admin.contacts') || Route::is('admin.business.hours')) ? 'active' : '' }}">
            <a href="{{ route('admin.contacts') }}">
                <i class="bi bi-person-rolodex me-2"></i>Contact Us
            </a>
        </li>
        <li class="sidebar-list-item logout-item">
            <a href="{{ route('admin.logout') }}" id="trigger-logout-btn logout-btn">
                <i class="bi-box-arrow-left me-2"></i>
                Logout
            </a>
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
