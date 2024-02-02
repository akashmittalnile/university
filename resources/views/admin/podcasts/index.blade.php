@extends('layouts.admin.app')
@push('css')
<link rel="stylesheet" href="{{ asset('admin/css/manage-podcasts.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
@endpush
@push('js')
<script src="{{ asset('admin/js/manage-podcasts.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
@endpush
@section('content')
<!-- Main -->
<main class="main-container dashboard">
    <div class="main-title d-flex align-items-center">
        <div class="page-title d-flex align-items-center">
            <h3 class="font-weight-bold black-color">Manage Podcasts</h3>
            <div class="count-bg ms-2">
                <p class=" white-color">{{ sprintf('%02d', $count) }}</p>
            </div>
        </div>
        <div class="profile-link">
            <a href="#">
                <div class="d-flex align-items-center">
                    <div class="profile-pic">
                        <img src="{{ isset(auth()->user()->profile) ? asset("uploads/profile/".auth()->user()->profile) : asset('admin/images/no-image.jpg')}}" alt="profile image" class="img-fluid me-2">
                    </div>
                    <div class="button-link">
                        <a href="profile.html" class="profile-name">{{auth()->user()->name ?? 'Admin Profile'}}<i class="bi bi-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-12">
            <div class="search-items page-content">

                <div class="search-box ms-auto">
                    <form action="" method="get">
                        <div class="input-group mb-2  ms-auto">
                            <input type="text" class="form-control common-shadow" name="search" value="{{ request()->has('search') ? request('search') : '' }}" placeholder="Search by podcast title" aria-describedby="basic-addon2">
                            <button class="search-btn"><i class="bi bi-search"></i></button>
                            <button class="search-btn bg-danger" type="button" onclick="location.replace('{{ route('admin.podcasts') }}')"><i class="bi bi-arrow-clockwise"></i></button>
                        </div>
                    </form>
                </div>


                {{-- <a href="#"><button class="outline-btn ms-2">Podcast Payment Transaction
                            Loans<i class="bi bi-coin ms-2"></i></button></a> --}}
                <a href="{{ route('admin.podcasts.create') }}"><button class="common-btn ms-2">Add New Podcast<i class="bi bi-plus-circle ms-2"></i></button></a>
            </div>
            <div class="mt-1">
                <div class="transaction-details">
                    <div class="">
                        <div class="owl-carouse row">
                            @forelse ($podcasts as $item)
                            <div class="slid col-4 mb-4">
                                <div class="box-slid common-card float w-100">
                                    <div class="img-box" style="height: 75%;">
                                        <img style="height: 100%;" src="{{ asset("uploads/podcasts/$item->thumbnail") }}" alt="image" class="img-fluid">
                                    </div>
                                    <p class="text-color mt-3 text-capitalize d-none">{{ $item->name }}
                                    </p>
                                    <p class="main-color mt-3 f-500 text-capitalize">{{ $item->name }}</p>
                                    <div class="d-flex mt-3">
                                        <a href="javascript:void(0)"><button class="outline-btn" data-bs-toggle="modal" onclick="$('#delete_form').attr('action','{{ route('admin.podcasts.destroy', encrypt_decrypt('encrypt', $item->id)) }}')" data-bs-target="#deleteFile">Delete</button></a>
                                        <a href="{{ route('admin.podcasts.edit', encrypt_decrypt('encrypt', $item->id)) }}"><button class="common-btn ms-2">Edit
                                                Podcast
                                            </button></a>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center mt-5">
                                <img width="300" src="{{ asset('admin/images/no-data.svg') }}" alt="">
                                <h4 class="p-4 text-center my-2 w-100">No Podcasts found</h4>
                            </div>
                            @endforelse
                            {{$podcasts->appends(Request::except('page'))->links('pagination::bootstrap-4')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- deleteFile modal -->
<div class="modal fade" id="deleteFile" tabindex="-1" aria-labelledby="deleteFileLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="text-capitalize text-center letter-space f-600 black-color">Are you Sure?</h4>
                <h6 class="text-color text-center mt-3">Do you really want to delete the <b class="main-color">Podcast</b> ?</h6>
                <img src="images/delete.png" alt="image" class="img-fluid">
            </div>
            <form action="" method="get" id="delete_form">
                @csrf
                <div class="modal-footer justify-content-center mb-3">
                    <button type="button" class="btn outline-btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn common-btn">Yes, Delete</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection