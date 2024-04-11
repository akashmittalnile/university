@extends('layouts.admin.app')
@section('heading','Dashboard')
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
            for ($i = 1; $i < strlen($arr[1]); $i++) { $str .=$arr[1][$i]; } $arr[1]=$str; @endphp <div>
                <a style="width: 18%;" href="{{ route('admin.dashboard.download.report', $arr[1]) }}"><button style="border-radius: 0 !important; padding: 11px 35px !important;" class="d-btn download-btn outline-btn">Download Report<i class="bi bi-cloud-arrow-down ms-2"></i></button></a>
        </div>
        <div class="transaction-details">
            <div class="transation-detail-box common-card common-shadow">
                <!-- <button class="btn" id="partners" onclick="showContent('partners')">
                                Membership Transaction
                            </button>
                            <button class="btn" id="supporters" onclick="showContent('supporters')">
                                E-Book Transaction
                            </button> -->
                <form action="" method="get">
                    <div class="search-box ms-auto d-flex" style="width: 70%;">
                        <div class="input-group mb-2" style="width: 100%;">

                            <input type="text" class="form-control common-shadow" name="search" placeholder="Search by user name, amount" value="{{ request()->has('search') ? request('search') : '' }}" aria-describedby="basic-addon2" />

                            <input type="date" max="{{date('Y-m-d')}}" id="dateDetail" value="{{ request()->has('receive_date') ? request('receive_date') : '' }}" name="receive_date" class="form-control common-shadow" />

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

<div class="col-md-12">
    <div class="Overview-card">
        <div class="Overview-card-chart">
            <div class="" id="transactionchart"></div>
        </div>
    </div>
</div>
</div>

<!-- End Main -->
<input type="hidden" data-json="{{ json_encode($transactionArr) }}" id="student_graph">
<script>
    let dataOverStudent = [];
    $(document).ready(function() {
        let arrOver = $("#student_graph").data('json');
        arrOver.map(ele => {
            dataOverStudent.push(ele);
        })
    })
    $(function() {
        var options1 = {
            series: [{
                name: "Users",
                data: dataOverStudent,
            }, ],
            chart: {
                height: 350,
                type: 'area',

                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                }
            },
            title: {
                text: "Users Subscription Per Month ({{date('Y')}})",
                align: 'center',
            },
            dataLabels: {
                enabled: true,
                style: {
                    colors: ['#5ccd61']
                },
            },
            legend: {
                markers: {
                    fillColors: ['#5ccd61']
                }
            },
            tooltip: {
                marker: {
                    fillColors: ['#5ccd61'],
                },

            },
            stroke: {
                curve: 'smooth',
                colors: ['#5ccd61']
            },
            fill: {
                colors: ['#5ccd61']
            },
            markers: {
                colors: ['#5ccd61']
            },
            xaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                title: {
                    display: true,
                    text: 'Months',
                    font: {
                        size: 15
                    }
                },
            },
            yaxis: {
                tickAmount: 4,
                floating: false,
                labels: {
                    style: {
                        colors: '#555',
                    },
                    offsetY: -7,
                    offsetX: 0,
                },
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                title: {
                    display: true,
                    text: 'Total Amount',
                    font: {
                        size: 15
                    }
                },
            }
        };

        var chart = new ApexCharts(document.querySelector("#transactionchart"), options1);
        chart.render();
    });
</script>

@endsection