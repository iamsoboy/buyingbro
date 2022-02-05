@extends('layouts.shopmenu')

@section('title', 'Checkout')

@section('extra_script')
    <link rel="stylesheet" href="{{asset('css/stripe.css')}}">
    <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('content')

   <!-- Start page-top-banner section -->
   <section class="page-top-banner section-gap-full relative" data-stellar-background-ratio="0.5">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row section-gap-half">
                <div class="col-lg-12 text-center">
                    <h1>Checkout</h1>
                    <h4></h4>
                </div>
            </div>
        </div>
    </section>
    <!-- End about-top-banner section -->

    <!-- Start price section -->
    <section class="price-section section-gap-full" id="price-section">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-12 pb-4">
                @if (session()->has('success_message'))
                    <div class="alert alert-success mb-6">
                    <strong>{{session()->get('success_message')}}</strong>
                    </div>
                 @endif

                @if (session()->has('msg'))
                    <div class="alert alert-warning mb-6">
                        <strong>{{session()->get('msg')}}</strong>
                    </div>
                @endif

                @if (count($errors) > 0 )
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{!! $error !!}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                </div>


                <div class="col-lg-6 price-left" x-data="{ selected: '' }">
                    <h3>
                        Billing Details
                    </h3>
                        <form id="payment-form" name="myform" action="#" method="POST">
                        @csrf
                        <div class="row contact-form-wrap justify-content-left">

                            <div class="col-md-6 contact-name form-col">
                                <input name="name" id="name" class="form-control" type="text" value="{{ old('name') ?? $user->name }}" placeholder="Full Name*"
                                       onfocus="this.placeholder=''" onblur="this.placeholder='Full Name*'">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 contact-email form-col">
                                <input name="email" id="email" class="form-control" type="email" value="{{ old('email') ?? $user->email }}" placeholder="E-mail*"
                                       onfocus="this.placeholder=''" onblur="this.placeholder='Email*'">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 contact-phone form-col">
                                <input name="phone" id="phone" class="form-control" type="text" value="{{ old('phone') ?? $user->userprofile->mobile }}" placeholder="Phone Number*"
                                       onfocus="this.placeholder=''" onblur="this.placeholder='Phone Number*'">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 contact-name form-col">
                                <input name="address" id="address" class="form-control" type="text" value="{{ old('address') ?? $user->userprofile->address }}" placeholder="Address*"
                                       onfocus="this.placeholder=''" onblur="this.placeholder='Address*'">
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 contact-name form-col">
                                <input name="zipcode" id="zipcode" class="form-control" type="text" value="{{ old('zipcode') ?? $user->userprofile->postcode }}" placeholder="Zip Code*"
                                       onfocus="this.placeholder=''" onblur="this.placeholder='Zip Code*'">
                                @error('zipcode')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 contact-name form-col">
                                <select name="state" id="state" class="form-control" type="text" placeholder="State*"
                                        onfocus="this.placeholder=''" onblur="this.placeholder='State*'">
                                    <option selected>{{ old('state') ?? $user->userprofile->state }}</option>
                                    <option>...</option>
                                </select>
                                @error('state')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-12 contact-name form-col">
                                <select name="country" id="country" class="form-control" type="text" placeholder="Country*"
                                        onfocus="this.placeholder=''" onblur="this.placeholder='Country*'">
                                    <option selected>{{ old('country') ?? $user->userprofile->country }}</option>
                                    <option>...</option>
                                </select>
                                @error('country')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-12 contact-name form-col">
                                <select x-model="selected" name="payment_method" id="payment_method" class="form-control" type="text" placeholder="Payment Method"
                                        onfocus="this.placeholder='Payment Method'" onblur="this.placeholder='Payment Method'">
                                    <option value="">Payment Method</option>
                                    @foreach($gateways as $gateway)
                                    <option value="{{$gateway->id}}">{{$gateway->name}}</option>
                                    @endforeach
                                </select>
                                @error('payment_method')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!--Stripe form starts here -->
                                <div class="col-lg-12 contact-name form-col" x-show="selected ==='7'">
                                    <input name="name_on_card" id="name_on_card" class="form-control mb-4" type="text" value="{{ old('name_on_card') }}" placeholder="Name on Card*"
                                           onfocus="this.placeholder=''" onblur="this.placeholder='Name on Card*'">
                                    @error('name_on_card')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror


                                <div id="card-element">
                                    <!--Stripe.js injects the Card Element-->
                                </div>
                                <!-- We'll put the error messages in this element -->
                                <div id="card-errors" role="alert"></div>
                                <!--Stripe form ends here -->
                                </div>


                            <div class="row">
                                <div class="col-md-12 align-content-center">
                                    <button type="submit" id="place-order" class="primary-btn primary-btn-w d-block mx-auto">PLACE ORDER</button>
                                </div>
                            </div>

                        </div>
                        <!--</form> Billing closing form commented out -->
                    </form>
                </div>

                <div class="col-lg-6 d-flex price-right">
                    <div class="single-price main">
                        <div class="top-wrap">
                            <i class="ti ti-shopping-cart-full"></i>
                            <h2>Order Summary</h2>
                        </div>
                        <div class="bottom-wrap">
                            <ul>
                                @foreach(Cart::instance('default')->content() as $item)
                                    <li class="d-flex justify-content-between align-items-center">
                                        <span>{{$item->name}}</span>
                                        <span>{{ currency($item->price) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="bottom-wrap">
                                <li class="d-flex justify-content-between align-items-center">
                                    <span>Subtotal</span>
                                    <span>{{ currency(unset_number(Cart::subtotal())) }}</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center">
                                    <span>V.A.T(7.5%)</span>
                                    <span>{{ currency(unset_number(Cart::tax())) }}</span>
                                </li>
                                <!--<li class="d-flex justify-content-between align-items-center">
                                    <span>Coupon Discount</span>
                                    <span> %</span>
                                </li>-->
                                <h4>
                                    <li class="d-flex justify-content-between align-items-center">
                                        <span>Total Cost</span>
                                        <span>{{ currency(unset_number(Cart::total())) }}</span>
                                    </li>
                                </h4>
                            </div>
                            <!--<div class="bottom-wrap">
                                <button type="submit" id="paystack" class="btn btn-primary-w btn-block mx-auto">PLACE ORDER</button>
                            </div>-->


                            <!--<a href="#" class="primary-btn primary-btn-w d-block mx-auto">PLACE ORDER</a>-->
                        </div>


                    </div>

                    <div class="single-price mx-0">
                        <div class="top-wrap">
                            <i class="ti ti-wallet"></i>
                            <h4>Wallet Balance</h4>
                            <p class="relative">Pay via wallet</p>
                            <h2 class="relative">{{ currency($user->userprofile->deposit_balance) }}</h2>
                        </div>
                        <div class="bottom-wrap">
                            <form action="{{ route('checkout.wallet') }}" method="POST">
                            @csrf
                            <input type="hidden" name="refid" id="refid" value="{{ $referenceCode }}">

                            <button type="submit" class="btn btn-primary btn-block mx-auto">PAY</button>
                            </form>
                            <!--<button class="primary-btn d-block mx-auto">Pay</button>-->
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- End price section -->

@endsection

@section('form-action')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            // Function to change form action.
            $("#payment_method").change(function() {
                var selected = $(this).val();
                switch (selected) {
                    case "7":
                        var id = $(this).closest("form").attr('id');
                        if($(id)==="payment-form") {
                            $("#payment-form").attr('action', "{{route('paywithstripe')}}");
                        } else {
                            $("form#myform").prop('id', 'payment-form');
                            $("#payment-form").attr('action', "{{route('paywithstripe')}}");
                        }
                        break;
                    case "6":
                        var id = $(this).closest("form").attr('id');
                        if($(id)==="myform") {
                            $("#myform").attr('action', "{{route('buyMyBux')}}");
                        } else{
                            $("form#payment-form").prop('id', 'myform');
                            $("#myform").attr('action', "{{route('buyMyBux')}}");

                        }
                        break;
                    case "1":
                        var id = $(this).closest("form").attr('id');
                        if($(id)==="myform") {
                            $("#myform").attr('action', "{{route('pay')}}");
                        } else{
                            $("form#payment-form").prop('id', 'myform');
                            $("#myform").attr('action', "{{route('pay')}}");
                        }
                        break;
                    default:
                        var id = $(this).closest("form").attr('id');
                        if($(id)==="myform") {
                            $("#myform").attr('action', "#");
                        } else{
                            $("form#payment-form").prop('id', 'myform');
                            $("#myform").attr('action', "#");
                        }
                }
            });

            // Function For Back Button
            $(".back").click(function() {
                parent.history.back();
                return false;
            });

            $("#place-order").click(function(){
                $("#myform").submit(); // Submit the form
            });
        });
    </script>
@endsection

@section('extra_js')
    <script>
        (function () {
            // A reference to Stripe.js initialized with your real test publishable API key.
            var stripe = Stripe("pk_live_51IdGvvCkcP2iQJWWNGS63jl4xhimdEb9RTTBzkyiXP7ZOxVZkRPbvYme9s9hl5RiXd7jzZlE11x08fz1bNEo2ApK00aF5qPYLX");

            var elements = stripe.elements();

            var style = {
                base: {
                    color: "#32325d",
                    fontFamily: 'Arial, sans-serif',
                    fontSmoothing: "antialiased",
                    fontSize: "16px",
                    "::placeholder": {
                        color: "#32325d"
                    }
                },
                invalid: {
                    fontFamily: 'Arial, sans-serif',
                    color: "#fa755a",
                    iconColor: "#fa755a"
                }
            };

            var card = elements.create("card", { style: style, hidePostalCode: true });
            // Stripe injects an iframe into the DOM
            card.mount("#card-element");

            card.on("change", function (event) {
                // Disable the Pay button if there are no card details in the Element
                //document.querySelector("#place-order").disabled = event.empty;
                document.querySelector("#card-errors").textContent = event.error ? event.error.message : "";
            });

            var form = document.getElementById("payment-form");
            form.addEventListener("submit", function(event) {
                event.preventDefault();

                //disable the submit button to avoid repeated clicks
                document.getElementById('place-order').disabled = true;

                var data = {
                    name: document.getElementById('name_on_card').value,
                    address_line1: document.getElementById('address').value,
                    address_state: document.getElementById('state').value,
                    address_zip: document.getElementById('zipcode').value,
                    address_country: document.getElementById('country').value
                }

                stripe.createToken(card, data).then(function (result) {
                    if (result.error){
                        var errorElement = document.getElementById('card-error');
                        errorElement.textContent = result.error.message;

                        //document.querySelector("#card-error").textContent = result.error ? result.error.message : "";
                        //enable the submit button
                        document.getElementById('place-order').disabled = false;
                    } else {
                        //Send token to your server
                        stripeTokenHandler(result.token);
                    }

                });
                // Complete payment when the submit button is clicked
                //payWithCard(stripe, card, data.clientSecret);
            });

                //Generate Stripe Token
            function stripeTokenHandler(token) {
                //Insert the token ID to the form, so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                //Submit the form
                form.submit();
            }

        })();
    </script>

@endsection
