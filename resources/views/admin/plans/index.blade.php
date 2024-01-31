@extends('layouts.admin.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/manage-membership-plan.css') }}" />
@endpush
@push('js')
    <script src="{{ asset('admin/js/dashboard.js') }}"></script>
    <script>
        function updatePlan(ele) {
            $("#updatePlan").modal("show");
            const form = document.getElementById("update_form");
            const nameText = document.getElementById("name");
            nameText.innerHTML = ele.getAttribute('data-name');
            form.setAttribute("action", ele.getAttribute('data-url'));
            form.podcasts.value = ele.getAttribute('data-podcasts');
            form.ebooks.value = ele.getAttribute('data-ebooks');
            form.gallery.value = ele.getAttribute('data-gallery');

        }
    </script>
@endpush
@section('content')
    <!-- Main -->
    <main class="main-container dashboard">
        <div class="main-title d-flex align-items-center">
            <div class="page-title d-flex align-items-center">
                <h3 class="font-weight-bold black-color">
                    Manage Membership Plans
                </h3>
                <div class="count-bg ms-2">
                    <p class="white-color">03</p>
                </div>
            </div>
            <div class="profile-link">
                <a href="#">
                    <div class="d-flex align-items-center">
                        <div class="profile-pic">
                            <img src="{{ isset(auth()->user()->profile) ? asset("uploads/profile/".auth()->user()->profile) : asset('admin/images/no-image.jpg')}}" alt="profile image" class="img-fluid me-2" />
                        </div>
                        <div class="button-link">
                            <a href="{{ route('admin.profile') }}" class="profile-name">{{auth()->user()->name ?? 'Admin Profile'}}<i
                                    class="bi bi-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row page-content">
            <div class="page-content">
                <div class="d-flex align-items-center justify-content-end">
                    <a href="plan-payment-transaction-logs.html"><button class="outline-btn">
                            Plan Payment Transaction Logs
                        </button></a>

                    <a href="{{ route('admin.plans.fetch') }}"><button class="common-btn ms-3">
                            Sync Plans
                        </button></a>
                </div>
                <div class="row plan-items">
                    @foreach ($plans as $item)
                        <div class="col-md-4 py-4">
                            <div class="common-card float" style="min-width: 380px">
                                <div class="monthly ms-auto">
                                    <p class="text-center"> {{ $item->type . 'ly' }}</p>
                                </div>
                                <h4 class="black-color text-center f-600 letter-space">
                                    {{ $item->name }}
                                </h4>
                                <div class="p-bg mt-3">
                                    <p class="text-center main-color">
                                        {{ $item->price == 0 ? 'Free' : ($item->currency == 'inr' ? "₹ $item->price" : "$ item->price") }}
                                    </p>
                                </div>
                                <ul class="mt-3">
                                    @foreach ($item->description as $text)
                                        <li class="text-capitalize black-color">
                                            <i class="bi bi-check-circle me-2"></i>{{ $text }}
                                        </li>
                                    @endforeach


                                </ul>
                                <div class="text-center">
                                    <a href="#"><button class="manage-plan common-btn"
                                            data-url="{{ route('admin.plans.update', $item) }}"
                                            data-podcasts='{{ $item->podcasts }}' data-ebooks='{{ $item->ebooks }}'
                                            data-gallery='{{ $item->gallary }}' data-name='{{ $item->name }}'
                                            onclick="updatePlan(this)">
                                            Manage Plan
                                        </button></a>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </main>
    <!-- End Main -->
    <!-- updatePlan modal -->
    <div class="modal fade" id="updatePlan" tabindex="-1" aria-labelledby="deleteFileLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="" id="update_form" method="post">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-capitalize text-center letter-space f-600 black-color">Update <span
                                id="name"></span> </h4>


                        @csrf
                        @method('PUT')
                        <div class="form-group py-2">
                            <label for="Podcasts">Total Podcasts</label>
                            <input type="text" class="form-control" name="podcasts" value="0">
                        </div>
                        <div class="form-group py-2">
                            <label for="Podcasts">Total ebooks</label>
                            <input type="text" class="form-control" name="ebooks" value="0">
                        </div>
                        <div class="form-group py-2">
                            <label for="Podcasts">Accomplishment Gallery</label>
                            <input type="text" class="form-control" name="gallery" value="0">
                        </div>


                    </div>

                    <div class="modal-footer justify-content-center mb-3">
                        <button type="submit" class="btn common-btn">Update</button>
                        <button type="button" class="btn outline-btn" data-bs-dismiss="modal">Close</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
