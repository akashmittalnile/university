@extends('layouts.admin.app')
@section('heading', 'Transaction Logs')
@section('count', sprintf('%02d', $count))
@push('css')
    <link rel="stylesheet" href="{{ assets('admin/css/dashboard.css') }}" />
@endpush
@push('js')
    <script src="{{ assets('admin/js/dashboard.js') }}"></script>
@endpush
@section('content')
    
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
                        <a style="width: 18%;" href="{{ route('admin.transaction.download.logs.list', $arr[1]) }}"><button style="border-radius: 0 !important; padding: 11px 35px !important;" class="d-btn download-btn outline-btn">Download Report<i class="bi bi-cloud-arrow-down ms-2"></i></button></a>
                    </div>
                    <div class="transaction-details">
                        <form action="" method="get">
                            <div class="search-box ms-auto d-flex" style="width: 100%;">
                                <div class="input-group mb-2" style="margin-left: 30%;">
                                    <input type="text" class="form-control common-shadow" name="search" placeholder="Search by user name, amount" value="{{ request()->has('search') ? request('search') : '' }}" aria-describedby="basic-addon2" />

                                    <input title="From Date" type="date" max="{{date('Y-m-d')}}" id="dateDetail" value="{{ request()->has('from_date') ? request('from_date') : '' }}" name="from_date" class="form-control common-shadow"/>

                                    <input title="To Date" type="date" max="{{date('Y-m-d')}}" id="dateDetail" value="{{ request()->has('to_date') ? request('to_date') : '' }}" name="to_date" class="form-control common-shadow"/>

                                    <button class="search-btn">
                                        <i class="bi bi-search"></i>
                                    </button>
                                    <button class="search-btn bg-danger" type="button" onclick="location.replace('{{ route('admin.transaction.logs') }}')"><i class="bi bi-arrow-clockwise"></i></button>
                                </div>
                            </div>
                        </form>

                        <div class="transation-detail-box">
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
                                                Amount received on
                                            </th>
                                            <th scope="col" class="text-capitalize">
                                                Purchased on
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
                                                        {{ date('d M Y', strtotime('+1 month'.$item->renew_date)) }}
                                                    </td>
                                                    <td>
                                                        {{ date('d M Y', strtotime($item->renew_date)) }}
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
                                    </table>
                                </div>
                                <div class="d-flex justify-content-center">
                                    {{$transactions->appends(Request::except('page'))->links('pagination::bootstrap-4')}}
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
@endsection
