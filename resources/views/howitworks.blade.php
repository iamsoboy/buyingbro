@extends('layouts.frontend')

@section('title', 'How It Works')

@section('content')
    <!-- Start page-top-banner section -->
    <section class="page-top-banner section-gap-full relative" data-stellar-background-ratio="0.5">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row section-gap-half">
                <div class="col-lg-12 text-center">
                    <h1>How it Works</h1>
                    <h4>Join us to save thousands each year.</h4>
                </div>
            </div>
        </div>
    </section>
    <!-- End about-top-banner section -->

    <!-- Start service section -->
    <section class="service-section section-gap-full">
        <div class="container">
            <div class="section-title">
                <h2 class="text-center">You want to buy?</h2>
            </div>
            <div class="row">
                <div class="col-lg-4  col-md-6 pb-30">
                    <div class="single-service">
                        <i class="ti-shopping-cart-full"></i>
                        <h4>Look Around</h4>
                        <p>
                            Save up to 30% on discounted gift cards from 4,000+ brands on our marketplace.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4  col-md-6 pb-30">
                    <div class="single-service">
                        <i class="ti-save-alt"></i>
                        <h4>Save Everywhere</h4>
                        <p>
                            Use discounted gift cards to pay for everything you want on your favourite shop.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4  col-md-6 pb-30">
                    <div class="single-service">
                        <i class="ti-bar-chart"></i>
                        <h4>Checkout</h4>
                        <p>
                            Most cards are delivered electronically within minutes.
                            Log into your account online or check your email to redeem your cards.
                        </p>
                    </div>
                </div>
            </div>

            <div class="section-title">
                <h2 class="text-center">You want to sell?</h2>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 ">
                    <div class="single-service">
                        <i class="ti-search"></i>
                        <h4>Earn Cash</h4>
                        <p>
                            Look for unwanted or unused gift cards, new or partially used.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 ">
                    <div class="single-service">
                        <i class="ti-money"></i>
                        <h4>Submit For Sale</h4>
                        <p>
                            Login or Register to sell your cards, and you will get a selling price.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 ">
                    <div class="single-service">
                        <i class="ti-wallet"></i>
                        <h4>Get Paid</h4>
                        <p>
                            Receive funds via Direct Bank Deposit, PayPal or check when you sell.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End service section -->

    <!-- Start cta section -->
    <section class="cta-section section-gap-half relative">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row section-gap-half">
                <div class="col-lg-12 text-center">
                    <h1>"Great way to earn some extra cash"</h1>
                    <h4>Selling off unwanted gift cards.</h4>
                    <a class="primary-btn" href="{{route('register')}}">Register</a>
                </div>
            </div>
        </div>
    </section>
    <!-- End cta section -->
@endsection
