@extends('layouts.admin.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/user-management.css') }}" />
@endpush
@push('js')
    <script src="{{ asset('admin/js/dashboard.js') }}"></script>
@endpush
@section('content')
    <main class="main-container dashboard">
        <div class="main-title d-flex align-items-center">
            <div class="page-title d-flex align-items-center">
                <h3 class="font-weight-bold black-color">
                    User Management
                </h3>
                <div class="count-bg ms-2">
                    <p class=" white-color">{{ sprintf('%02d', $count) }}</p>
                </div>
            </div>
            <div class="profile-link">
                <a href="#">
                    <div class="d-flex align-items-center">
                        <div class="profile-pic">
                            <img src="{{ isset(auth()->user()->profile) ? asset("uploads/profile/".auth()->user()->profile) : asset('admin/images/profile-image.jpg')}}" alt="profile image" class="img-fluid me-2" />
                        </div>
                        <div class="button-link">
                            <a href="{{ route('admin.profile') }}" class="profile-name">{{auth()->user()->name ?? 'Admin Profile'}}<i
                                    class="bi bi-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="main-cards">
                    <div class="transaction-details">
                        <form action="" method="get">
                            <div class="search-box ms-auto d-flex">
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control common-shadow" name="search"
                                        placeholder="Search by user name, email, phone number"
                                        value="{{ request()->has('search') ? request('search') : '' }}"
                                        aria-describedby="basic-addon2" />
                                    <button class="search-btn">
                                        <i class="bi bi-search"></i>
                                    </button>
                                    <button class="search-btn bg-danger" type="button" onclick="location.replace('{{ route('admin.users.index') }}')"><i class="bi bi-arrow-clockwise"></i></button>
                                </div>
                            </div>
                        </form>

                        <div class="transation-detail-box">
                            <div class="pay-details">
                                <table class="table table-hover common-shadow">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-capitalize">
                                                Name
                                            </th>
                                            <th scope="col" class="text-capitalize">
                                                Email Id
                                            </th>
                                            <th scope="col" class="text-capitalize">
                                                Phone Number
                                            </th>
                                            <th scope="col" class="text-capitalize text-center">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $item)
                                            <tr>
                                                <td class="text-capitalize">{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>+1 {{ $item->phone }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        {{-- <a href="#"><button class="outline-btn ">
                                                                Restrict
                                                            </button></a> --}}
                                                        <a href="{{ route('admin.users.view.details', encrypt_decrypt('encrypt', $item->id)) }}"><button class="common-btn ms-2">
                                                                View
                                                            </button></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td align="center" colspan="4">No records found</td>
                                            </tr>
                                        @endforelse
                                    </table>
                                </div>
                            {{$users->appends(Request::except('page'))->links('pagination::bootstrap-4')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
