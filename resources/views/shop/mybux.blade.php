@extends('layouts.shopmenu')

@section('title', $brands->name)

@section('content')

    <!-- Start page-top-banner section -->
    <section class="page-top-banner section-gap-full relative" data-stellar-background-ratio="0.5">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row section-gap-half">
                <div class="col-lg-12 text-center">
                    <h1>Buy {{$brands->name}}</h1>
                    <h4>Your favourite brands discounted</h4>
                </div>
            </div>
        </div>
    </section>
    <!-- End about-top-banner section -->

    <!-- Start blog-lists section -->
    <section class="blog-lists-section section-gap-full">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="sidebar-wrap">
                        <div class="single-widget banner-widget">
                            <img class="img-fluid" src="{{ asset('storage/'.$brands->image.'') }}" alt="">
                        </div>

                        <div class="single-widget archive-widget">
                            <h4 class="widget-title"> {{$brands->name}} Types</h4>
                            <h5><p>Electronic Gift Cards (eCard)</p></h5>
                            <p><span style="font-size: 18px; font-weight: 400"> Electronic gift cards are transferred directly to your email account for redemption online.<br>Electronic gift card will be delivered to your email account in less than 24 hours</span></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="blog-lists">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="widget-title">{{$brands->name}}</h4>
                            </div>

                            <div class="card-body">
                                @if (session()->has('success_message'))
                                    <div class="alert alert-success mb-6">
                                        <strong>{{session()->get('success_message')}}</strong>
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form id="payment-form" name="myform" action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <div class="row contact-form-wrap justify-content-left">

                                        <div class="row">
                                            <div class="col-md-8 contact-name form-col">
                                                <label>Mobile number</label>
                                                <input name="telephone" id="telephone" class="form-control" type="text" value="{{ old('telephone')}}" placeholder="Mobile Number*"
                                                       onfocus="this.placeholder=''" onblur="this.placeholder='+2507...'">
                                                @error('telephone')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <small>Your voucher will be linked to the mobile number provided. Enter the number in international format. E.g: +2507...</small>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-8 contact-name form-col">
                                                <label>Voucher value</label>
                                                <input name="amount" id="amount" class="form-control" type="text" value="{{ old('amount')}}" placeholder="voucher value"
                                                       onfocus="this.placeholder=''" onblur="this.placeholder='voucher value'">
                                                @error('amount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <small>This is the value you would like to load onto your voucher</small>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" value="{{ Crypt::encrypt($product->id)}}">
                                        <div class="row">
                                            <div class="col-md-8 contact-name form-col">
                                                <button type="submit" class="btn btn-primary">Buy Now</button>
                                            </div>
                                        </div>

                                    </div>

                                </form>


                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End blog-lists section -->


@endsection
