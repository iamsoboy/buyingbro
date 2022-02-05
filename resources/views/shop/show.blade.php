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
                                <hr>
                            <h5><p>Physical Gift Cards</p></h5>
                            <p><span style="font-size: 18px; font-weight: 400">Physical gift cards can be redeemed in store. In some cases, they can be used online as well ( please contact your local retailer for more information). They are delivered within 5-8 business days.</span></p>

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
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                @if(count($product_brands) > 0)
                                    <div class="table-responsive">
                                        <table id="basic-datatables" class="display table table-striped table-hover" >
                                            <thead>
                                                <tr>
                                                    <th scope="col">Card Type</th>
                                                    <th scope="col">Value</th>
                                                    <th scope="col">Save</th>
                                                    <th scope="col">You Pay</th>
                                                    <th scope="col">Order</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                            @foreach ($product_brands as $product)
                                                <tr>
                                                    <td>{{ $product->type }}</td>
                                                    <td>{{ currency($product->value) }}</td>
                                                    <td>{{$product->presentDiscount()}}%</td>
                                                    <td>{{ currency($product->price) }}</td>
                                                    <td>
                                                    <form action="{{ route('cart.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ Crypt::encrypt($product->id)}}">
                                                    <button type="submit" class="btn btn-primary">Buy Now</button>
                                                    </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    <h4 class="text-center"> No {{$brands->name}} available yet.</h4>
                                    @endif


                                </div>

                            </div>


                        <nav>
                            <ul class="pagination">
                                <li class="page-item active">
                                {{$product_brands->links()}}
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End blog-lists section -->


@endsection
