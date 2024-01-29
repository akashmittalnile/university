@extends('layouts.frontend.app')
@push('css')
<link rel="stylesheet" href="{{ asset('frontend/css/membership-plan.css') }}">
<style>
    .stripe-button-el {
        opacity: 1;
    }
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
                                <p class="pricing">{{ $item->currency == 'inr' ? '₹' : "$" }}{{ number_format($item->price, 2, '.', ',') }}</p>
                                <hr>
                                <ul class="features">
                                    @foreach ($item->description as $text)
                                        <li class="text-capitalize">{{ $text }}</li>
                                    @endforeach
                                </ul>

                                @if ($item->price == 0)
                                    <a href="javascript:void(0)">
                                        <button class="btn learn-more-btn" @if (!auth()->user()) onclick="location.replace('{{ route('signin') }}')" @endif>Free</button>
                                    </a>
                                @else
                                    <a href="javascript:void(0)"> 
                                        <button type="button"
                                            @if (!auth()->user()) onclick="location.replace('{{ route('signin') }}')" @else onclick="openPaymentForm(this,{{ $item->id }})" 
                                            data-name="{{ $item->name }}" data-amount="{{ $item->price * 100 }}"
                                            data-key="{{ env('STRIPE_PUBLISH') }}"
                                            data-currency="{{ $item->currency }}"
                                            data-plan_id="{{ $item->id }}"
                                            data-email="{{ auth()->user()->email }}"
                                            data-image="{{ asset('frontend/images/logo.png') }}" @endif
                                            class="btn learn-more-btn">Buy Now</button>
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
                    <button class="btn common-btn yes-btn ms-3 mx-2" id="confirm_button" data-name="{{ $item->name }}" data-amount="{{ $item->price * 100 }}" data-key="{{ env('STRIPE_PUBLISH') }}" data-currency="{{ $item->currency }}" data-email="{{ auth()->user()->email }}" data-image="{{ asset('assets/vendor/images/logo.svg') }}" onclick="openPaymentForm(this,{{ $item->id }})">
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
    function openPaymentForm(ele, plan_id) {

        $("#payment_form").show();
        $("#plan_id").val(ele.getAttribute("data-plan_id"));
        var s = document.createElement("script");
        s.src = "https://checkout.stripe.com/checkout.js";
        s.setAttribute('class', "stripe-button");
        s.setAttribute("data-key", ele.getAttribute("data-key"))
        s.setAttribute("data-name", ele.getAttribute("data-name"));
        s.setAttribute("data-amount", ele.getAttribute("data-amount"));
        s.setAttribute("data-currency", ele.getAttribute("data-currency"));
        s.setAttribute("data-description", ele.getAttribute("data-description"));
        s.setAttribute("data-email", ele.getAttribute("data-email"));

        s.setAttribute("data-image", ele.getAttribute("data-image"));
        $("#payment_form").append(s);



        setTimeout(() => {
            $(".stripe-button-el").click();
        }, 2000);


    }
</script>
@endpush