@extends('layouts.admin.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/contact.css') }}" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.3.2/ckeditor.js"></script>
@endpush
@section('content')
    <!-- Main -->
    <main class="main-container dashboard">
        <div class="main-title d-flex align-items-center">
            <div class="page-title d-flex align-items-center">
                <a href="manage-podcasts.html"><i class="bi bi-arrow-left-circle-fill main-color me-3"></i></a>
                <h3 class="font-weight-bold black-color">Manage Page Content</h3>
            </div>
            <div class="profile-link">
                <a href="#">
                    <div class="d-flex align-items-center">
                        <div class="profile-pic">
                            <img src="{{ isset(auth()->user()->profile) ? asset("uploads/profile/".auth()->user()->profile) : asset('admin/images/profile-image.jpg')}}" alt="profile image" class="img-fluid me-2">
                        </div>
                        <div class="button-link">
                            <a href="{{ route('admin.profile') }}" class="profile-name">{{auth()->user()->name ?? 'Admin Profile'}}<i
                                    class="bi bi-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-12">
                <div class="main-cards">
                    <div class="e-book-details">
                        <div class="d-flex align-items-center mb-3 justify-content-end">
                            <a href="javascript:void(0)"><button class="btn common-btn top-btn me-4">Manage Business Hours</button></a>
                            <a href="{{ route('admin.contact.download.report') }}"><button class="btn outline-btn top-btn me-4">Download Report<i class="bi bi-cloud-arrow-down ms-2"></i></button></a>
                            <p class="text-color">Home<i class="fa fa-angle-right ms-3 me-3"></i> Editors <i
                                    class="fa fa-angle-right ms-3 me-3"></i> <b class="main-color">Contact Us</b></p>
                        </div>
                        <div class="about-us">
                            <div class="transation-detail-box ">
                                <div class="pay-details">
                                    <table class="table  table-hover common-shadow">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-capitalize">Sr No.</th>
                                                <th scope="col" class="text-capitalize" style="width: 20%;">Name</th>
                                                <th scope="col" class="text-capitalize" style="width: 25%;">Address</th>
                                                <th scope="col" class="text-capitalize" style="width: 45%;">Messages</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($contact as $key => $val)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$val->name ?? "NA"}}</td>
                                                <td>{{$val->address ?? "NA"}}</td>
                                                <td>{{$val->message ?? "NA"}}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td align="center" colspan="4">No records found</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                {{$contact->appends(Request::except('page'))->links('pagination::bootstrap-4')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </main>
    <!-- End Main -->
@endsection
