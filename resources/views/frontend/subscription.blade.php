@extends('layouts.frontend.app')
@push('css')
<link rel="stylesheet" href="{{ assets('frontend/css/membership-plan.css') }}">
<style>
    .stripe-button-el {
        opacity: 0;
    }
    .modal-header {
        border-bottom: 0;
    }
    .modal-footer {
        border-top: 0;
    }
    .modal-body {
        padding-top: 0;
    }
    .modal .common-btn {
        background-color: rgb(236, 70, 70);color: #ffffff;padding: 10px 35px;border-radius: 5px;border: 0;box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;font-size: 14px;border: 1px solid rgb(236, 70, 70);font-size: 13px;
    }
    .modal .common-btn:hover {
        background-color: transparent;color: rgb(236, 70, 70); box-shadow: rgba(0, 0, 0, 0.15) 0px 15px 25px, rgba(0, 0, 0, 0.05) 0px 5px 10px;
    }
    .modal .outline-btn{background-color: transparent;color: #3fab40;padding: 10px 35px;border-radius: 5px;border: 0;box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;font-size: 14px;border: 1px solid #3fab40;font-size: 13px;}
    .modal .outline-btn:hover{background-color: #3fab40;color: white; box-shadow: rgba(0, 0, 0, 0.15) 0px 15px 25px, rgba(0, 0, 0, 0.05) 0px 5px 10px;}
</style>
@endpush
@section('content')
<section class="resources">
    <div class="membership-plan-details">
        <div class="container">
            <h1 class="white-color head-1 mb-4 text-center text-capitalize">Choose the plans that suits you</h1>
            <p class="text-center white-color mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ligula velit, bibendum ac tempus at, condimentum eget felis. Fusce id rhoncus arcu. Phasellus consequat erat id nulla venenatis, in consequat leo pharetra. Nam molestie, nulla rhoncus scelerisque maximus.</p>
            <div class="row">
                @forelse($plans as $item)
                    <div class="col-md-4 mb-4">
                        <div class="current-div">
                            @if($item->current_plan)
                            <div class="current-plan me-auto">
                                <p>Current Plan</p>
                            </div>
                            @endif
                            <div class="card float">
                                <h2 class="card_title">{{$item->name}}</h2>
                                @if($item->price == 0)
                                <p class="pricing">Free</p>
                                @else
                                <p class="pricing">${{ number_format($item->price, 2, '.', ',') }}</p>
                                @endif
                                <hr>
                                <ul class="features">
                                    @foreach ($item->description as $text)
                                        <li class="text-capitalize">{{ $text }}</li>
                                    @endforeach
                                </ul>

                                @if($item->current_plan)
                                    <a href="javascript:void(0)">
                                        <button disabled class="btn learn-more-btn" @if (!auth()->user()) onclick="location.replace('{{ route('signin') }}')" @endif>Subscribed</button>
                                    </a>
                                @elseif($item->price == 0)
                                    <a href="javascript:void(0)">
                                        <button disabled class="btn learn-more-btn" @if (!auth()->user()) onclick="location.replace('{{ route('signin') }}')" @endif>Free</button>
                                    </a>
                                @else
                                    <a href="javascript:void(0)"> 
                                        <button type="button"
                                            @if (!auth()->user()) onclick="location.replace('{{ route('signin') }}')" @elseif($item->current_plan_price >= $item->price) data-name="{{ $item->name }}" data-amount="{{ $item->price * 100 }}"
                                            data-key="{{ env('STRIPE_PUBLISH') }}"
                                            data-currency="{{ $item->currency }}"
                                            data-plan_id="{{ $item->id }}"
                                            data-email="{{ auth()->user()->email }}"
                                            data-description="{{ auth()->user()->name }}"
                                            data-image="{{ assets('frontend/images/logo.png') }}" @else 
                                            data-name="{{ $item->name }}" data-amount="{{ $item->price * 100 }}"
                                            data-key="{{ env('STRIPE_PUBLISH') }}"
                                            data-currency="{{ $item->currency }}"
                                            data-plan_id="{{ $item->id }}"
                                            data-email="{{ auth()->user()->email }}"
                                            data-description="{{ auth()->user()->name }}"
                                            data-image="{{ assets('frontend/images/logo.png') }}" @endif
                                            class="btn learn-more-btn @if($item->current_plan_price >= $item->price) downgrade @else buy-now @endif"> 
                                            @if($item->current_plan_price <= $item->price)
                                                Upgrade
                                            @elseif($item->current_plan_price >= $item->price)
                                                Downgrade
                                            @else
                                                Buy Now 
                                            @endif
                                        </button>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="deleteFile" tabindex="-1" aria-labelledby="deleteFileLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="text-capitalize text-center letter-space f-600 black-color">Are you Sure?</h4>
                <h6 class="text-color text-center mt-3">Do you really want to downgrade your package?</h6>
            </div>
            <form action="" method="get" id="delete_form">
                @csrf
                <div class="modal-footer justify-content-center mb-3">
                    <button type="submit" class="btn outline-btn buy-now">Yes</button>
                    <button type="button" class="btn common-btn" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>

        </div>
    </div>
</div>

@if (auth()->user())

<form class="mt-5" action="{{ route('user.purchase') }}" method="POST" id="payment_form" style="display: none">
    @csrf
    <input type="hidden" id="plan_id" name="plan_id">
    <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user() ? auth()->user()->id : 0 }}">
</form>

<!-- Modal delete-product -->
<div class="modal delete-product fade" id="delete-product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="text-center black-color f-600">
                    Are you sure you want to Downgrade your package?
                </h5>

                <p class="text-center black-color mt-2 f-500" id="delete_name">
                    Downgrading your plan will change the status of products and flyers inactive you need to update
                    the
                    status manually from the respective sections
                </p>
                <div class="d-flex justify-content-center mt-5">
                    <button class="btn common-btn yes-btn ms-3 mx-2" id="confirm_button" data-name="{{ $item->name }}" data-amount="{{ $item->price * 100 }}" data-key="{{ env('STRIPE_PUBLISH') }}" data-currency="{{ $item->currency }}" data-email="{{ auth()->user()->email }}" data-image="{{ assets('assets/vendor/images/logo.svg') }}" onclick="openPaymentForm(this,{{ $item->id }})">
                        Confirm</button>
                    <a><button class="btn outline-btn not-btn" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            Cancel
                        </button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@push('js')
<script>

    $(document).on('click', '.downgrade', function() {
        $("#deleteFile .buy-now").attr("data-plan_id", $(this).data("plan_id"))
        $("#deleteFile .buy-now").attr("data-key", $(this).data("key"))
        $("#deleteFile .buy-now").attr("data-name", $(this).data("name"));
        $("#deleteFile .buy-now").attr("data-amount", $(this).data("amount"));
        $("#deleteFile .buy-now").attr("data-currency", $(this).data("currency"));
        $("#deleteFile .buy-now").attr("data-description", $(this).data("description"));
        $("#deleteFile .buy-now").attr("data-email", $(this).data("email"));
        $("#deleteFile .buy-now").attr("data-image", $(this).data("image"));
        $("#deleteFile").modal("show");
    });

    $(document).on("click", '.buy-now', function(e) {
        e.preventDefault();
        let ele = $(this);
        $("#payment_form").show();
        $("#plan_id").val($(this).data("plan_id"));
        var s = document.createElement("script");
        s.src = "https://checkout.stripe.com/checkout.js";
        s.setAttribute('class', "stripe-button");
        s.setAttribute("data-key", $(this).data("key"))
        s.setAttribute("data-name", $(this).data("name"));
        s.setAttribute("data-amount", $(this).data("amount"));
        s.setAttribute("data-currency", $(this).data("currency"));
        s.setAttribute("data-description", $(this).data("description"));
        s.setAttribute("data-email", $(this).data("email"));
        s.setAttribute("data-image", $(this).data("image"));
        $("#payment_form").append(s);
        setTimeout(() => {
            $(".stripe-button-el").click();
        }, 2000);
    });
     
</script>
@endpush