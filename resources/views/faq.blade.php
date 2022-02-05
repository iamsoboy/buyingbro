@extends('layouts.frontend')

@section('title', 'FAQ')

@section('content')
    <!-- Start page-top-banner section -->
    <section class="page-top-banner section-gap-full relative" data-stellar-background-ratio="0.5">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row section-gap-half">
                <div class="col-lg-12 text-center">
                    <h1>Frequently asked questions</h1>
                    <h4>Got any questions? We've got answers!</h4>
                </div>
            </div>
        </div>
    </section>
    <!-- End about-top-banner section -->

    <!-- Start faq section -->
    <section class="faq-section section-gap-full">
        <div class="container">
            <div class="section-title">
                <h2 class="text-center">Frequently Asked Questions</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <dl class="accordion">

                        @foreach($faqs as $faq)
                            <dt>
                                <a href="#">{{$faq->title}}</a>
                            </dt>
                            <dd>
                                {!! $faq->content !!}
                            </dd>
                        @endforeach

                    </dl>
                </div>
            </div>
        </div>
    </section>
    <!-- End faq section -->
@endsection
