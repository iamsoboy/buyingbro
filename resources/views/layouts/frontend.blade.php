<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Author Meta -->
    <meta name="author" content="">
    <!-- Meta Description -->
    <meta name="description" content="Buy and Sell your Unwanted Gift Cards">
    <!-- Meta Keyword -->
    <meta name="keywords" content="Buy, Sell, Gift Cards">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>{{config('app.name')}} - @yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:400,300,500,600,700" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="{{asset ('img/favicon.png')}}" type="image/png">

    <!--
CSS
============================================= -->

    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">

</head>

<body>

    <!-- Preloader
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div> -->

    <!-- Start header section -->
    <header class="header-area" id="header-area">
        <div class="dope-nav-container breakpoint-off">
            <div class="container">
                <div class="row">
                    <!-- dope Menu -->
                    <nav class="dope-navbar justify-content-between" id="dopeNav">

                        <!-- Logo -->
                        <a class="nav-brand" href="/">
                            <img src="{{asset('img/logo.png')}}" alt="">
                        </a>

                        <!-- Navbar Toggler -->
                        <div class="dope-navbar-toggler">
                            <span class="navbarToggler">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </div>

                        <!-- Menu -->
                        <div class="dope-menu">

                            <!-- close btn -->
                            <div class="dopecloseIcon">
                                <div class="cross-wrap">
                                    <span class="top"></span>
                                    <span class="bottom"></span>
                                </div>
                            </div>

                            <!-- Nav Start -->
                            <div class="dopenav">
                                <ul id="nav">
                                    <li>
                                        <a href="/">Home</a>
                                    </li>
                                    <li>
                                        <a href="{{route('shop.index')}}">Shop</a>
                                    </li>
                                    <li>
                                        <a href="{{route('about.create')}}">About Us</a>
                                    </li>
                                    <li>
                                        <a href="http://localhost/purchase/blog/">Blog</a>
                                    </li>
                                    <li>
                                        <a href="{{route('contact.index')}}">Contact Us</a>
                                    </li>
                                    @if (Auth::guest())
                                    <li>
                                    	<a class="video-btn primary-btn" href="{{ route('login') }}">Login</a>
                                    </li>
                                    @else
                                    <li>
                                    	<a class="video-btn primary-btn" href="{{ route('index') }}">Dashboard</a>
                                    </li>
                                    @endif
                                </ul>

                            </div>
                            <!-- Nav End -->
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Start header section -->

@yield('content')

@yield('blog')

@yield('blogpost')

@yield('contact')

@yield('about')

@yield('terms')

@include('layouts.footer')

    {!! NoCaptcha::renderJs() !!}

    <!--
JS
============================================= -->
    <script src="{{asset('js/vendor/jquery-2.2.4.min.js')}}"></script>
    <script src="{{asset('js/vendor/popper.min.js')}}"></script>
    <script src="{{asset('js/jquery.easing.1.3.js')}}"></script>
    <script src="{{asset('js/vendor/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.parallax-scroll.js')}}"></script>
    <script src="{{asset('js/dopeNav.js')}}"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/waypoints.min.js')}}"></script>
    <script src="{{asset('js/jquery.stellar.min.js')}}"></script>
    <script src="{{asset('js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
</body>

</html>
