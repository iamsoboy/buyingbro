@extends('layouts.frontend')

@section('title', 'Contact Us')

@section('contact')

    <!-- Start page-top-banner section -->
    <section class="page-top-banner section-gap-full relative" data-stellar-background-ratio="0.5">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row section-gap-half">
                <div class="col-lg-12 text-center">
                    <h1>Contact Us</h1>
                    <h4>Drop us Some Line</h4>
                </div>
            </div>
        </div>
    </section>
    <!-- End about-top-banner section -->

    <!-- Start contact section -->
    <section class="contact-section contact-page-section padding-top-120" id="contact-section">
        <div class="container">
            <div class="row address-wrap justify-content-center">
                <div class="col-lg-3 col-md-4 col-sm-6 single-address-col">
                    <div class="div">
                        <i class="ti ti-mobile"></i>
                        <p>
                            {!! setting('site.site_phone') !!}
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 single-address-col">
                    <div class="div">
                        <i class="ti ti-map-alt"></i>
                        <p>
                            {!! setting('site.site_address') !!}
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12 single-address-col">
                    <div class="div">
                        <i class="ti ti-email"></i>
                        <p>
                           {!! setting('site.site_email') !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center form-row">
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
                @if ( !session()->has('success_message'))
                <div class="col-lg-9">
                    <form id="contact-form" action="{{ route('contact.store') }}" method="POST">
                    @csrf
                        <div class="row contact-form-wrap justify-content-center">
                            <div class="col-md-6 contact-name form-col">
                                <input name="name" id="name" value="{{ old('name') }}" class="form-control" type="text" placeholder="Name*"
                                    onfocus="this.placeholder=''" onblur="this.placeholder='Name*'">
                                    <div>{{ $errors->first('name') }}</div>
                            </div>

                            <div class="col-md-6 contact-email form-col">
                                <input name="email" id="email" value="{{ old('email') }}" class="form-control" type="email" placeholder="E-mail*"
                                    onfocus="this.placeholder=''" onblur="this.placeholder='Email*'">
                                    <div id="msg">{{ $errors->first('email') }}</div>
                            </div>
                            <div class="col-lg-12">
                                <textarea name="message" id="message" value="{{ old('message') }}" class="form-control" rows="8" placeholder="Message"
                                    onfocus="this.placeholder=''" onblur="this.placeholder='Message*'"></textarea>
                                    <div id="msg">{{ $errors->first('message') }}</div>
                            </div>
                            {{--<div class="col-md-6 contact-email form-col justify-center">
                                {!! NoCaptcha::display() !!}
                            </div>--}}

                            <button type="submit" class="primary-btn" value="Send Message">Send Message</button>
                            <!--<button type="submit" class="btn btn-primary btn-block mx-auto">Send Message</button>-->


                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </section>
    <!-- End contact section -->

@endsection
