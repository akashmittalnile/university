@extends('layouts.admin.app')
@push('css')
    <link rel="stylesheet" href="{{ assets('admin/css/dashboard.css') }}" />
    <style>
        th,
        tr {

            height: 19px !important;

        }
    </style>
@endpush
@push('js')
    <script src="{{ assets('admin/js/dashboard.js') }}"></script>
@endpush
@section('content')
    <!-- Main -->
    <main class="main-container dashboard">
        <div class="main-title d-flex align-items-center">
            <div class="page-title">
                <h3 class="font-weight-bold black-color">Dashboard</h3>
            </div>
            <div class="profile-link">
                <a href="#">
                    <div class="d-flex align-items-center">
                        <div class="profile-pic">
                            <img src="{{ isset(auth()->user()->profile) ? assets("uploads/profile/".auth()->user()->profile) : assets('admin/images/no-image.jpg')}}" alt="profile image"
                                class="img-fluid me-2" />
                        </div>
                        <div class="button-link">
                            <a href="{{ route('admin.profile') }}" class="profile-name">{{ auth()->user()->name ?? 'Admin Profile' }}<i
                                    class="bi bi-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row g-3 my-2">
            <div class="col-md-4 top-cards">
                <a href="{{ route('admin.users.index') }}" style="text-decoration: none;">
                    <div class="p-3 bg-white common-card float-card common-shadow align-items-center">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <div>
                                    <p class="fs-6 text-color">
                                        Total Users
                                    </p>
                                    <h4 class="mt-2 f-600 black-color">
                                        {{ $total_users }}
                                    </h4>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="img-bg">
                                    <img src="{{ assets('/admin/images/users.png') }}" alt="" class="img-fluid" />
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                
            </div>
            <div class="col-md-4">
                <div class="p-3 bg-white h-100 common-card float-card common-shadow align-items-center">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div>
                                <p class="fs-6 text-color">
                                    Total Subscription Payment
                                </p>
                                <h4 class="mt-2 f-600 black-color">
                                    {{ ($transactions->first() && $transactions->first()->plan ? ($transactions->first()->plan->currency = 'inr' ? '₹' : '$') : "$") . number_format($total_earning, 2, '.', ',') }}
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="img-bg">
                                <img src="{{ assets('/admin/images/payment.png') }}" alt="" class="img-fluid" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 bg-white h-100 common-card float-card common-shadow align-items-center">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div>
                                <p class="fs-6 text-color">
                                    Total Subscribed User
                                </p>
                                <h4 class="mt-2 f-600 black-color">
                                    {{ $subscribe_users ?? 0 }}
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="img-bg">
                                <img src="{{ assets('/admin/images/payment.png') }}" alt="" class="img-fluid" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                    <a style="margin-left: 80%; width: 20%;" href="{{ route('admin.dashboard.download.report', $arr[1]) }}"><button class="d-btn download-btn outline-btn">Download Report<i class="bi bi-cloud-arrow-down ms-2"></i></button></a>
                    <div class="transaction-details">
                        <div class="transation-detail-box common-card common-shadow">
                            <button class="btn" id="partners" onclick="showContent('partners')">
                                Membership Transaction
                            </button>
                            {{-- <button class="btn" id="supporters" onclick="showContent('supporters')">
                                E-Book Transaction
                            </button> --}}

                            <form action="" method="get">
                                <div class="search-box ms-auto d-flex">
                                    <div class="input-group mb-2" style="width: 96.5%;">
                                        <input type="text" class="form-control common-shadow" name="search" placeholder="Search by user name, amount" value="{{ request()->has('search') ? request('search') : '' }}" aria-describedby="basic-addon2" />

                                        <input type="date" max="{{date('Y-m-d')}}" id="dateDetail" value="{{ request()->has('receive_date') ? request('receive_date') : '' }}" name="receive_date" class="form-control common-shadow"/>

                                        <button class="search-btn">
                                            <i style="color: white;" class="bi bi-search"></i>
                                        </button>
                                        <button class="search-btn bg-danger" type="button" onclick="location.replace('{{ route('admin.dashboard') }}')"><i style="color: white;" class="bi bi-arrow-clockwise"></i></button>
                                    </div>
                                </div>
                            </form>

                            <div class="content active" id="partnersContent">
                                <div class="pay-details">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-capitalize">
                                                    Sr No.
                                                </th>
                                                <th scope="col" class="text-capitalize">
                                                    Name
                                                </th>
                                                <th scope="col" class="text-capitalize">
                                                    Subscription Plan
                                                </th>
                                                <th scope="col" class="text-capitalize">
                                                    Amount Paid
                                                </th>
                                                <th scope="col" class="text-capitalize">
                                                    Billing Type
                                                </th>
                                                <th scope="col" class="text-capitalize">
                                                    Billing Due Date
                                                </th>
                                                <th scope="col" class="text-capitalize">
                                                    amount received on
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($transactions as $i => $item)
                                                @if ($item->user && $item->plan)
                                                    <tr>
                                                        <th scope="row">{{ $i + 1 }}</th>
                                                        <td class="text-capitalize">{{ $item->user->name }}</td>
                                                        <td>{{ $item->plan->name }}</td>
                                                        <td>${{ number_format((float)($item->plan->price), 2, '.', ',') }}
                                                        </td>
                                                        <td>{{ ucfirst($item->plan->type) }}</td>
                                                        <td>
                                                            {{ date('d M Y', strtotime('+1 month'.$item->receive_date)) }}
                                                        </td>
                                                        <td>
                                                            {{ date('d M Y, h:i:s a', strtotime($item->receive_date)) }}

                                                        </td>
                                                    </tr>
                                                @endif
                                            @empty
                                                <tr>
                                                    <td align="center" colspan="7">No records found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="content" id="supportersContent">
                                <li>
                                    <i class="bi bi-patch-check-fill me-2"></i>Host, Digital Transformation Series
                                    (TPL)
                                </li>
                                <li>
                                    <i class="bi bi-patch-check-fill me-2"></i>Host, Reasoning with Project
                                    Delivery Manager Series (UWI)
                                </li>
                                <li>
                                    <i class="bi bi-patch-check-fill me-2"></i>PMOGA Judging Committee, PMO Global
                                    Awards
                                </li>
                                <li>
                                    <i class="bi bi-patch-check-fill me-2"></i>Mentor, Allô™ Community
                                </li>
                                <li>
                                    <i class="bi bi-patch-check-fill me-2"></i>Mentor, University of the West
                                    Indies (UWI)
                                </li>
                                <li>
                                    <i class="bi bi-patch-check-fill me-2"></i>Mentor, Institution of Engineering
                                    and Technology (IET)
                                </li>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- End Main -->
@endsection
