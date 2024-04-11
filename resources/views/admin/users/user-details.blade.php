@extends('layouts.admin.app')
@section('heading', 'User Details')
@section('back', route('admin.users.index'))
@push('css')
<link rel="stylesheet" href="{{ assets('admin/css/user-details.css') }}" />
<style>
    .reject-btn{box-shadow: none;}
    .reject-btn:hover{
        background-color: white !important;
        box-shadow: none;
    }
</style>
@endpush
@push('js')
<script src="{{ assets('admin/js/user-details.js') }}"></script>
@endpush
@section('content')
    
    @if($user->status==0 || $user->status==3)
    <div class="d-flex align-items-center justify-content-end mt-4">
        <a href="{{ route('admin.users.approve.reject', ['id' => encrypt_decrypt('encrypt', $user->id), 'status' => encrypt_decrypt('encrypt', 1)]) }}"><button class="outline-btn">Approve</button></a>
        @if($user->status==0)
        <a href="{{ route('admin.users.approve.reject', ['id' => encrypt_decrypt('encrypt', $user->id), 'status' => encrypt_decrypt('encrypt', 3)]) }}"><button class="common-btn ms-3">Reject</button></a>
        @endif
    </div>
    @endif

    <div class="row g-3 my-2">
        <div class="col-md-12">
            <div class="common-card">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <div class="d-flex align-items-center">
                            <div class="profile-img">
                                <img src="{{ isset($user->profile) ? assets("uploads/profile/".$user->profile) : assets('admin/images/no-image.jpg') }}" alt="">
                            </div>
                            <h6 class="black-color ms-3 f-600 text-capitalize">{{ $user->name ?? "NA" }}</h6>
                        </div>
                    </div>
                    <div class="col-md-3">
                        @if($user->status == 3)
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <a href="javascript:void(0)"><button class="outline-btn border border-danger reject-btn text-danger">Rejected</button></a>
                        </div>
                        @elseif($user->status == 0)
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <a href="javascript:void(0)"><button class="outline-btn">Pending</button></a>
                        </div>
                        @else
                        <p class="black-color f-600">Mark as @if($user->status==1) Inactive @else Active @endif</p>
                        <div class="form-check mt-3 form-switch">
                            <input style="cursor: pointer;" class="form-check-input" value="1" type="checkbox" id="flexSwitchCheckChecked" @if($user->status==1) checked @endif>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-bg">
                                <img src="{{ assets('admin/images/email-details.png') }}" alt="image" class="img-fluid">
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
                                <img src="{{ assets('admin/images/contact.png') }}" alt="image" class="img-fluid">
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
                            <img src="{{ assets('admin/images/subscription-plan.png') }}" alt="" class="img-fluid">
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
                            <img src="{{ assets('admin/images/transaction.png') }}" alt="" class="img-fluid">
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
                            <img src="{{ assets('admin/images/e-book.png') }}" alt="" class="img-fluid">
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
                    <div class="transation-detail-box  common-card common-shadow row">
                        <div class="col-12">
                            <form action="" method="get" id="dateForm">
                            <input style="cursor: pointer;" type="date" id="dateDetail" value="{{ request()->has('receive_date') ? request('receive_date') : '' }}" name="receive_date" class="d-btn date-btn">
                            </form>
                            <!-- <button class="btn" id="partners" onclick="showContent('partners')">Membership Transaction</button> -->
                            <!-- <button class="btn" id="supporters" onclick="showContent('supporters')">E-Book Transaction</button> -->
                            <a href="{{ route('admin.user-detail.download.report',['id' => encrypt_decrypt('encrypt', $user->id), 'arr' => $arr[1]]) }}"><button class="d-btn download-btn outline-btn">Download Report<i class="bi bi-download ms-2"></i></button></a>
                        </div>
                        <div class="col-12 content active" id="partnersContent">
                            <div class="pay-details">
                                <table class="table  table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-capitalize">Sr No.</th>
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
                                            <td>{{ $item->plan->name }}</td>
                                            <td>{{ $item->plan->currency = 'inr' ? '₹' : '$' }}{{ number_format((float)($item->plan->price), 2, '.', ',') }}
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



<script type="text/javascript">
    $(document).on('change', '#flexSwitchCheckChecked', function(e) {
        let status = ($(this).is(":checked")) ? 1 : 2;
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
                    toastr.success("Status Changed");
                    setInterval(function(){
                        window.location.reload();
                    }, 2000)
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