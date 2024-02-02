@extends('layouts.admin.app')
@push('css')
<link rel="stylesheet" href="{{ asset('admin/css/user-details.css') }}" />
@endpush
@push('js')
<script src="{{ asset('admin/js/user-details.js') }}"></script>
@endpush
@section('content')
<main class="main-container dashboard">
    <div class="main-title d-flex align-items-center">
        <div class="page-title d-flex align-items-center">
            <a href="{{ route('admin.users.index') }}"><i class="bi bi-arrow-left-circle-fill main-color me-3"></i></a>
            <h3 class="font-weight-bold black-color">User Details</h3>
        </div>
        <div class="profile-link">
            <a href="#">
                <div class="d-flex align-items-center">
                    <div class="profile-pic">
                        <img src="{{ isset(auth()->user()->profile) ? asset("uploads/profile/".auth()->user()->profile) : asset('admin/images/no-image.jpg')}}" alt="profile image" class="img-fluid me-2">
                    </div>
                    <div class="button-link">
                        <a href="{{ route('admin.profile') }}" class="profile-name">{{auth()->user()->name ?? 'Admin Profile'}}<i class="bi bi-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row g-3 my-2">
        <div class="col-md-12">
            <div class="common-card">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <div class="d-flex align-items-center">
                            <div class="profile-img">
                                <img src="{{ isset($user->profile) ? asset("uploads/profile/".$user->profile) : asset('admin/images/no-image.jpg') }}" alt="">
                            </div>
                            <h6 class="black-color ms-3 f-600 text-capitalize">{{ $user->name ?? "NA" }}</h6>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <p class="black-color f-600">Mark as @if($user->status==1) Inactive @else Active @endif</p>
                        <div class="form-check mt-3 form-switch">
                            <input class="form-check-input" value="1" type="checkbox" id="flexSwitchCheckChecked" @if($user->status==1) checked @endif>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-bg">
                                <img src="{{ asset('admin/images/email-details.png') }}" alt="image" class="img-fluid">
                            </div>
                            <div class="info ms-3">
                                <p class="black-color f-600">Email Id</p>
                                <p class="mt-2">{{ $user->email ?? "NA" }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-bg">
                                <img src="{{ asset('admin/images/contact.png') }}" alt="image" class="img-fluid">
                            </div>
                            <div class="info ms-3">
                                <p class="black-color f-600">Phone No.</p>
                                <p class="mt-2">+1 {{ $user->phone }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 top-cards">
            <div class="p-3 float dashboard-card common-card float-card common-shadow  align-items-center ">
                <div class="row align-items-center">
                    @if ($currentPlan)
                    <div class="col-md-10">
                        <div>
                            <p class="fs-6 text-color">${{ number_format($currentPlan->price, 2, '.', ',') }}/{{ ucfirst($currentPlan->type) }}</p>
                            <h4 class="mt-2 f-600 black-color">{{ $currentPlan->name }}</h4>
                        </div>
                    </div>
                    @else
                    <div class="col-md-10">
                        <div>
                            <p class="fs-6 text-color"> </p>
                            <h4 class="mt-2 f-600 black-color">No Active Plan</h4>
                        </div>
                    </div>
                    @endif
                    <div class="col-md-2">
                        <div class="sub-img-bg">
                            <img src="{{ asset('admin/images/subscription-plan.png') }}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-3 float  h-100 dashboard-card common-card float-card common-shadow  align-items-center ">
                <div class="row align-items-center">
                    <div class="col-md-10">
                        <div>
                            <p class="fs-6 text-color">Total Subscription Payment</p>
                            <h4 class="mt-2 f-600 black-color">${{ number_format($total, 2, '.', ',') }}</h4>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="sub-img-bg">
                            <img src="{{ asset('admin/images/transaction.png') }}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-md-6">
            <div class="p-3 float  h-100 dashboard-card common-card float-card common-shadow  align-items-center ">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div>
                            <p class="fs-6 text-color">Total E-book purchasement Payment</p>
                            <h4 class="mt-2 f-600 black-color">$345.23</h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sub-img-bg">
                            <img src="{{ asset('admin/images/e-book.png') }}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="col-md-12">
            <div class="main-cards">
                <div class="transaction-details">
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
                    <div class="transation-detail-box  common-card common-shadow">
                        <form action="" method="get" id="dateForm">
                            <input type="date" id="dateDetail" value="{{ request()->has('receive_date') ? request('receive_date') : '' }}" name="receive_date" class="d-btn date-btn">
                        </form>
                        <button class="btn" id="partners" onclick="showContent('partners')">Membership Transaction</button>
                        <!-- <button class="btn" id="supporters" onclick="showContent('supporters')">E-Book Transaction</button> -->
                        
                        <a href="{{ route('admin.user-detail.download.report',['id' => encrypt_decrypt('encrypt', $user->id), 'arr' => $arr[1]]) }}"><button class="d-btn download-btn outline-btn">Download Report<i class="bi bi-download ms-2"></i></button></a>
                        <div class="content active" id="partnersContent">
                            <div class="pay-details">
                                <table class="table  table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-capitalize">Sr No.</th>
                                            <th scope="col" class="text-capitalize">Name</th>
                                            <th scope="col" class="text-capitalize">Subscription Plan</th>
                                            <th scope="col" class="text-capitalize">Amount Paid</th>
                                            <th scope="col" class="text-capitalize">Billing Type</th>
                                            <th scope="col" class="text-capitalize">Billing Due Date</th>
                                            <th scope="col" class="text-capitalize">Amount received on</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($transactions as $key => $item)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td class="text-capitalize">{{ $item->user->name }}</td>
                                            <td>{{ $item->plan->name }}</td>
                                            <td>{{ $item->plan->currency = 'inr' ? '₹' : '$' }}{{ number_format((int)($item->plan->price), 2, '.', ',') }}
                                            </td>
                                            <td>{{ ucfirst($item->plan->type) }}</td>
                                            <td>
                                                {{ date('d M Y', strtotime('+1 month'.$item->receive_date)) }}
                                            </td>
                                            <td>
                                                {{ date('d M Y, h:i:s a', strtotime($item->receive_date)) }}

                                            </td>
                                        </tr>
                                        @empty
                                        <tr class="text-center">
                                            <td colspan="7">No record found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- <div class="content" id="supportersContent">
                            <table class="table  table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-capitalize">Sr No.</th>
                                        <th scope="col" class="text-capitalize">Name</th>
                                        <th scope="col" class="text-capitalize">E-Book Name</th>
                                        <th scope="col" class="text-capitalize">Amount Paid</th>
                                        <th scope="col" class="text-capitalize">Billing Type</th>
                                        <th scope="col" class="text-capitalize">Billing Due Date</th>
                                        <th scope="col" class="text-capitalize">amount received on</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>John Doe</td>
                                        <td>The key to our success</td>
                                        <td>$299.00</td>
                                        <td>Monthly</td>
                                        <td>1st of Every Month</td>
                                        <td>03 Sep 2023, 09:33:12 am</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>John Doe</td>
                                        <td>Swimming in the deep end</td>
                                        <td>$299.00</td>
                                        <td>Monthly</td>
                                        <td>1st of Every Month</td>
                                        <td>03 Sep 2023, 09:33:12 am</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>John Doe</td>
                                        <td>Leadership Perspectives</td>
                                        <td>$299.00</td>
                                        <td>Monthly</td>
                                        <td>1st of Every Month</td>
                                        <td>03 Sep 2023, 09:33:12 am</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td>John Doe</td>
                                        <td>The power of the plan</td>
                                        <td>$299.00</td>
                                        <td>Monthly</td>
                                        <td>1st of Every Month</td>
                                        <td>03 Sep 2023, 09:33:12 am</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">5</th>
                                        <td>John Doe</td>
                                        <td>The key to our success</td>
                                        <td>$299.00</td>
                                        <td>Monthly</td>
                                        <td>1st of Every Month</td>
                                        <td>03 Sep 2023, 09:33:12 am</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">6</th>
                                        <td>John Doe</td>
                                        <td>Leadership PerspectivesB</td>
                                        <td>$299.00</td>
                                        <td>Monthly</td>
                                        <td>1st of Every Month</td>
                                        <td>03 Sep 2023, 09:33:12 am</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">7</th>
                                        <td>John Doe</td>
                                        <td>The key to our success</td>
                                        <td>$299.00</td>
                                        <td>Monthly</td>
                                        <td>1st of Every Month</td>
                                        <td>03 Sep 2023, 09:33:12 am</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">8</th>
                                        <td>John Doe</td>
                                        <td>Swimming in the deep end</td>
                                        <td>$299.00</td>
                                        <td>Monthly</td>
                                        <td>1st of Every Month</td>
                                        <td>03 Sep 2023, 09:33:12 am</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">9</th>
                                        <td>John Doe</td>
                                        <td>Leadership Perspectives</td>
                                        <td>$299.00</td>
                                        <td>Monthly</td>
                                        <td>1st of Every Month</td>
                                        <td>03 Sep 2023, 09:33:12 am</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">10</th>
                                        <td>John Doe</td>
                                        <td>Swimming in the deep end</td>
                                        <td>$299.00</td>
                                        <td>Monthly</td>
                                        <td>1st of Every Month</td>
                                        <td>03 Sep 2023, 09:33:12 am</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">11</th>
                                        <td>John Doe</td>
                                        <td>Swimming in the deep end</td>
                                        <td>$299.00</td>
                                        <td>Monthly</td>
                                        <td>1st of Every Month</td>
                                        <td>03 Sep 2023, 09:33:12 am</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">12</th>
                                        <td>John Doe</td>
                                        <td>The key to our success</td>
                                        <td>$299.00</td>
                                        <td>Monthly</td>
                                        <td>1st of Every Month</td>
                                        <td>03 Sep 2023, 09:33:12 am</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<script type="text/javascript">
    $(document).on('change', '#flexSwitchCheckChecked', function(e) {
        let status = ($(this).is(":checked")) ? 1 : 0;
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: "{{ route('admin.users.change.status') }}",
            data: {
                id: "{{ encrypt_decrypt('encrypt', $user->id) }}",
                status,
                '_token': "{{ csrf_token() }}"
            },
            dataType: 'json',
            success: function(result) {
                if (result.status) {
                    window.location.reload();
                } else {
                    toastr.error(result.message);
                    return false;
                }
            },
            error: function(err) {
                toastr.error(err);
            }
        });
    });

    $(document).on('change', '#dateDetail', function(e) {
        $("#dateForm").get(0).submit();
    });
</script>
@endsection