@extends('layouts.shopmenu')

@section('title', 'Shop')

@section('content')

<!-- Start page-top-banner section -->
<section class="page-top-banner section-gap-full relative" data-stellar-background-ratio="0.5">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row section-gap-half">
                <div class="col-lg-12 text-center">
                    <h1>Buy Gift Cards</h1>
                    <h4>Get the best discount opportunity for gift cards</h4>
                </div>
            </div>
        </div>
    </section>
    <!-- End about-top-banner section -->

    <!-- Start service section -->
    <section class="service-section section-gap-full">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 pb-30">

                    <div class="row">

                        @foreach ($brands as $brand)
                        <div class="col-lg-4 col-md-4 pb-30">
                            <div class="single-service">
                                 <a href="{{ route('shop.show', $brand->slug) }}"><img src="{{ asset('storage/'.$brand->image.'') }}" alt="{{$brand->name}}"/></a>
                                 <a href="{{ route('shop.show', $brand->slug)}}">  <h4>{{$brand->name}}</h4> </a>
                                    <span class="badge orange-bg">{{ count($brand->products) }} Card(s)</span>
                                    <p>
                                    Save up to
                                    {{100 - $brand->percentage}}%
                                    </p>
                            </div>
                        </div>
                        @endforeach

                    </div>

                    <nav>
                        <ul class="pagination">
                            <li class="page-item">
                            {{$brands->links()}}
                            </li>
                        </ul>
                    </nav>

                </div>


                <div class=" col-lg-4 col-md-4 pb-30">
                <section class="blog-lists-section">
                    <div class="sidebar-wrap">
                        <div class="single-widget search-widget">
                            <h4 class="widget-title">Search Here</h4>
                            <div class="sidebar-form">
                                <form action="#" class="relative">
                                    <input type="text" placeholder="Search"  onfocus="this.placeholder=''" onblur="this.placeholder='Search'">
                                    <button type="submit">
                                        <i class="ti-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="single-widget tags-widget">
                            <h4 class="widget-title">Tags</h4>
                            <ul>
                                @foreach ($tags as $tag)
                                    <li><a href="{{ route('shop.show', $tag->slug)}}">{{$tag->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="single-widget social-widget">
                            <h4 class="widget-title">Social Links</h4>
                            <ul>
                                <li>
                                    <a target="_blank" href="#">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a target="_blank" href="#">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a target="_blank" href="#">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                </li>
                                <li>
                                    <a target="_blank" href="#">
                                        <i class="fa fa-instagram" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a target="_blank" href="#">
                                        <i class="fa fa-linkedin" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    </section>
                </div>




            </div>






        </div>
    </section>
    <!-- End service section -->

@endsection
