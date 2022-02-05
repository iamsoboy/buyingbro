@extends('layouts.shopmenu')

@section('title', 'My Cart')

@section('content')

<!-- Start page-top-banner section -->
<section class="page-top-banner section-gap-full relative" data-stellar-background-ratio="0.5">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row section-gap-half">
                <div class="col-lg-12 text-center">
                    <h1>My Cart</h1>
                    <h4></h4>
                </div>
            </div>
        </div>
</section>
    <!-- End about-top-banner section -->

<!-- Start price section -->
<section class="price-section section-gap-full" id="price-section">
        <div class="container">


            <!--Start Grid row-->
            <div class="row">

                    <!-- Start Grid column col-lg-8 -->
                      <div class="col-lg-8">

                      @if (session()->has('message'))
                          <div class="alert alert-primary mb-6">
                          <strong>{{session()->get('message')}}</strong>
                          </div>
      							      @endif

                            @if (session()->has('success_message'))
                              <div class="alert alert-success mb-6">
                                <strong>{{session()->get('success_message')}}</strong>
                              </div>
                            @endif

                            @if (count($errors) > 0 )
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                          <!-- Card card wish-list-->
                          <div class="card wish-list mb-4">

                                <div class="card-body">
                                    @if (Cart::count() > 0)
                                      <h5 class="mb-4">{{Cart::count()}} item(s) in ShoppingCart</h5>

                                        @foreach (Cart::content() as $item)
                                        <div class="row mb-4">
                                          <div class="col-md-5 col-lg-3 col-xl-3">
                                              <a href="{{route('shop.show', $item->model->brand->slug)}}">
                                                <div class="mask waves-effect waves-light">
                                                  <img class="img-fluid w-100" src="{{asset('storage/'.$item->model->brand->image.'')}}" alt="image">
                                                </div>
                                              </a>
                                          </div>
                                                <div class="col-md-7 col-lg-9 col-xl-9">
                                                    <div>
                                                            <div class="d-flex justify-content-between">
                                                                <div>
                                                                  <h4>{{$item->name}} Gift Card
                                                                  </h4>
                                                                  <p class="mb-3 text-muted text-uppercase small">Discount - {{$item->options['discount']}}%</p>
                                                                  <p class="mb-2 text-muted text-uppercase small">Card Type: {{$item->options['type']}}</p>
                                                                </div>

                                                                <div>
                                                                  <div class="def-number-input number-input safari_only mb-0 w-100">

                                                                  </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    <form action="{{route('cart.destroy', Crypt::encrypt($item->rowId))}}" method="POST" class="cartform-btn">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <button type="submit" class="cart-remove small text-uppercase mr-3"><i class="fa fa-trash mr-1"></i>Remove</button>
                                                                    </form>
                                                                    <form action="{{route('cart.wishlist', Crypt::encrypt($item->rowId))}}" method="POST" class="cartform-btn">
                                                                    @csrf
                                                                    <button type="submit" class="cart-remove small text-uppercase mr-3"><i class="fa fa-heart mr-1"></i> Wishlist </button>
                                                                    </form>
                                                                </div>
                                                                  <h6><p class="mb-0"><span><strong>{{$item->qty}} x {{ currency($item->price) }}</strong></span></p></h6>
                                                            </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <hr class="mb-4">
                                        @endforeach

                                      <p class="text-primary mb-0"><i class="fa fa-info-circle mr-1"></i> Do not delay the purchase, adding
                                        items to your cart does not mean booking them.</p>

                                </div>
                              @else
                                <div class="text-center mb-6">
                                    <h5 class="text-center">No Items in Cart!</h5>
                                      <div class="spacer"></div>
                                      <a href="{{route('shop.index')}}" class="btn btn-outline-primary mt-4" role="button">Continue Shopping</a>
                                      <div class="spacer"></div>
                                </div>
                              @endif

                          </div>
                          <!-- Card End card wish-list-->

                          <!-- Card Save for Later-->
                          <div class="card mb-4">
                              <div class="card-body">
                              <h5 class="mb-4">Wishlist</h5>
                              <div class="text-center mb-6">
                              @if (Cart::instance('wishlist')->count() > 0)
                              <h5 class="mb-4">{{Cart::instance('wishlist')->count()}} item(s) in Saved For Later</h5>
                                  <div class="table-responsive">
                                        <table id="wishlist" class="display table table-hover" >
                                            <tbody>
                                              @foreach(Cart::instance('wishlist')->content() as $item)
                                                <tr>
                                                    <td>{{$item->name}} Gift Card</td>
                                                    <td>{{ currency($item->model->value) }}</td>
                                                    <td>{{$item->options->discount}} %</td>
                                                    <td>{{ currency($item->price) }}</td>
                                                    <td>
                                                    <form action="{{route('wishlist.destroy', Crypt::encrypt($item->rowId))}}" method="POST" class="cartform-btn">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="cart-remove small text-uppercase mr-3"><i class="fa fa-trash mr-1"></i>Remove </button>
                                                    </form>
                                                    <form action="{{route('wishlistTo.cart', Crypt::encrypt($item->rowId))}}" method="POST" class="cartform-btn">
                                                    @csrf
                                                    <button type="submit" class="cart-remove small text-uppercase mr-3"><i class="fa fa-shopping-cart mr-1"></i> Move to Cart </button>
                                                    </form>
                                                    </td>
                                                </tr>
                                               @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    <h5 class="mb-4">You have no item(s) Saved For Later</h5>
                                    @endif
                                </div>
                              </div>
                          </div>
                          <!-- Card End Save for Later-->

                          @if (Cart::instance('default')->count() > 0)
                          <!-- Card Button-->
                          <div class="card mb-4">
                              <div class="card-body">
                              <div class="text-center mb-6">
                                      <div class="spacer"></div>
                                      <a href="{{route('shop.index')}}" class="btn btn-outline-primary float-left" role="button">Continue Shopping</a>
                                      <div class="spacer"></div>
                                </div>
                              </div>
                          </div>
                          <!-- Card End Button-->


                          <!-- Card -->
                          <div class="card mb-4">
                              <div class="card-body">

                                <h5 class="mb-4">We accept</h5>

                                <img class="mr-2" width="45px" src="{{asset ('img/icons/visa.svg')}}" alt="Visa">
                                <img class="mr-2" width="45px" src="{{asset ('img/icons/amex.svg')}}" alt="American Express">
                                <img class="mr-2" width="45px" src="{{asset ('img/icons/mastercard.svg')}}" alt="Mastercard">
                                <img class="mr-2" width="45px" src="{{asset ('img/icons/paypal.png')}}" alt="PayPal">
                              </div>
                          </div>
                          <!-- Card -->


                      </div>
                    <!-- End Grid column col-lg-8-->



                    <!--Start Grid column col-lg-4-->
                      <div class="col-lg-4">

                          <!-- Card -->
                          <div class="card mb-4">
                              <div class="card-body">

                                <h5 class="mb-3 text-uppercase">Your Cart Summary</h5>

                                  <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                      Subtotal:
                                      <span> {{ currency(unset_number(Cart::subtotal())) }}</span>
                                    </li>

                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                      Shipping Fee/Tax({{7.5}}%):
                                      <span>{{ currency(Cart::tax()) }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                        <div class="text-uppercase">
                                          <strong>Total Payment Due</strong>
                                        </div>
                                      <span><strong>{{ currency(unset_number(Cart::total())) }}</strong></span>
                                    </li>
                                  </ul>
                                  <a href="{{route('checkout.index')}}"
                                  button type="submit" class="btn btn-primary btn-block text-uppercase">go to
                                    checkout
                                  </a>
                              </div>
                          </div>

                      </div>
                    <!--End Grid column col-lg-4-->
                    @endif

            </div>
            <!--End Grid row-->

        </div> <!--End Container-->

        <div class="floating-shapes">
            <span data-parallax='{"x": 150, "y": -20, "rotateZ":500}'>
                <img src="img/shape/fl-shape-1.png" alt="">
            </span>
            <span data-parallax='{"x": 250, "y": 150, "rotateZ":500}'>
                <img src="img/shape/fl-shape-2.png" alt="">
            </span>
            <span data-parallax='{"x": -180, "y": 80, "rotateY":2000}'>
                <img src="img/shape/fl-shape-3.png" alt="">
            </span>
            <span data-parallax='{"x": -20, "y": 180}'>
                <img src="img/shape/fl-shape-4.png" alt="">
            </span>
            <span data-parallax='{"x": 300, "y": 70}'>
                <img src="img/shape/fl-shape-5.png" alt="">
            </span>
            <span data-parallax='{"x": 250, "y": 180, "rotateZ":1500}'>
                <img src="img/shape/fl-shape-6.png" alt="">
            </span>
            <span data-parallax='{"x": 180, "y": 10, "rotateZ":2000}'>
                <img src="img/shape/fl-shape-7.png" alt="">
            </span>
            <span data-parallax='{"x": 60, "y": -100}'>
                <img src="img/shape/fl-shape-9.png" alt="">
            </span>
            <span data-parallax='{"x": -30, "y": 150, "rotateZ":1500}'>
                <img src="img/shape/fl-shape-10.png" alt="">
            </span>
        </div>
</section>
<!-- End price section -->

@endsection
