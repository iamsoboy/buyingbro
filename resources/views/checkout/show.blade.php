@extends('layouts.shopmenu')

@section('title', 'Thankyou')

<!-- Start banner section -->
<section class="banner-section2 relative" id="banner-section">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row align-items-center fullscreen">
                <div class="col-md-6 banner-left">
                    <h1>Thank You for <br> <span>YOUR ORDER.</span></h1><br>
                    <h4>A confirmation email has been sent for<br><strong> Order No. #{{$id}}.</strong> </h4>
                    <small>You can copy your <b>Order No.: #{{$id}}</b> for any further enquires concerning this order. </small>
                    <a class="video-btn primary-btn" href="{{route('shop.index')}}">Home</a>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner section -->

@section('content')
