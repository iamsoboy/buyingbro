@extends('layouts.frontend')

@section('title', 'Terms and Conditions')

@section('terms')

 <!-- Start page-top-banner section -->
 <section class="page-top-banner section-gap-full relative" data-stellar-background-ratio="0.5">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row section-gap-half">
                <div class="col-lg-12 text-center">
                    <h1>{{$privacy->title}}</h1>
                    <h4>{{$privacy->excerpt}}</h4>
                </div>
            </div>
        </div>
    </section>
    <!-- End about-top-banner section -->

    <!-- Start about section -->
    <section class="about-section section-gap-full relative" id="about-section">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-12 col-md-12">
                    {!! $privacy->body !!}
                </div>
            </div>
        </div>
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
    <!-- End about section -->
   
@endsection