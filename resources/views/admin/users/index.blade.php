@extends('layouts.admin.app')
@push('css')
    <link rel="stylesheet" href="{{ assets('admin/css/user-management.css') }}" />
@endpush
@push('js')
    <script src="{{ assets('admin/js/dashboard.js') }}"></script>
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
                            <img src="{{ isset(auth()->user()->profile) ? assets("uploads/profile/".auth()->user()->profile) : assets('admin/images/no-image.jpg')}}" alt="profile image" class="img-fluid me-2" />
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
                    @php
                        $full = url()->full();
                        $current = url()->current();
                        $arr = explode($current, $full);
                        $str = '';
                        for ($i = 1; $i < strlen($arr[1]); $i++) {
                            $str .= $arr[1][$i];
                        }
                        $arr[1] = $str;
                    @endphp
                    <div>
                        <a style="width: 18%;" href="{{ route('admin.users.download.list', $arr[1]) }}"><button style="border-radius: 0 !important; padding: 11px 35px !important;" class="d-btn download-btn outline-btn">Download Report<i class="bi bi-cloud-arrow-down ms-2"></i></button></a>
                    </div>
                    <div class="transaction-details">
                        <form action="" method="get">
                            <div class="search-box ms-auto d-flex" style="width: 100%;">
                                <div class="input-group mb-2" style="margin-left: 30%;">


                                    <input style="width: 25%;" type="text" class="form-control common-shadow" name="search" placeholder="Search by name, email, phone number" value="{{ request()->has('search') ? request('search') : '' }}" aria-describedby="basic-addon2" />

                                    <input title="Registered On" style="width: 10%;" type="date" class="form-control common-shadow" name="date" id="userDate" value="{{ request()->has('date') ? request('date') : '' }}">

                                    <select name="status" id="userStatus" class="form-control common-shadow" style="cursor: pointer;">
                                        <option @if(request()->status == "") selected @endif value="">All Users</option>
                                        <option @if(request()->status == "0") selected @endif value="0">Pending Users</option>
                                        <option @if(request()->status == "1") selected @endif value="1">Active Users</option>
                                        <option @if(request()->status == "2") selected @endif value="2">Inactive Users</option>
                                        <option @if(request()->status == "3") selected @endif value="3">Rejected Users</option>
                                    </select>

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
                                                User Image
                                            </th>
                                            <th scope="col" class="text-capitalize">
                                                Name
                                            </th>
                                            <th scope="col" class="text-capitalize">
                                                Email Id
                                            </th>
                                            <th scope="col" class="text-capitalize">
                                                Phone Number
                                            </th>
                                            <th scope="col" class="text-capitalize">
                                                Status
                                            </th>
                                            <th scope="col" class="text-capitalize">
                                                Registered On
                                            </th>
                                            <th scope="col" class="text-capitalize text-center">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $item)
                                            <tr>
                                                <td style="width: 11%;">
                                                    <div class="profile-img">
                                                        <img src="{{ isset($item->profile) ? assets("uploads/profile/".$item->profile) : assets('admin/images/no-image.jpg') }}" alt="">
                                                    </div>
                                                </td>
                                                <td class="text-capitalize">{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>+1 {{ $item->phone }}</td>
                                                <td>@if($item->status==0) Pending @elseif($item->status == 1) Active @elseif($item->status == 2) Inactive @elseif($item->status == 3) Rejected @endif</td>
                                                <td>{{ date('d M, Y', strtotime($item->created_at)) }}</td>
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
                                                <td align="center" colspan="5">No records found</td>
                                            </tr>
                                        @endforelse
                                    </table>
                                </div>
                                <div class="d-flex justify-content-center">
                                    {{$users->appends(Request::except('page'))->links('pagination::bootstrap-4')}}
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
