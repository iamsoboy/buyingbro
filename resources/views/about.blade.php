@extends('layouts.frontend')

@section('title', 'About Us')

@section('about')

 <!-- Start page-top-banner section -->
 <section class="page-top-banner section-gap-full relative" data-stellar-background-ratio="0.5">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row section-gap-half">
                <div class="col-lg-12 text-center">
                    <h1>About US</h1>
                    <h4>Everything About Us</h4>
                </div>
            </div>
        </div>
    </section>
    <!-- End about-top-banner section -->

    <!-- Start about section -->
    <section class="about-section section-gap-full relative" id="about-section">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6 col-md-6 about-left">
                    <img class="img-fluid" src="{{asset('img/homeapp.png')}}" alt="">
                </div>
                <div class="col-lg-5 col-md-5 about-right">
                    <h3>About Us</h3>
                    <h1>All the Things you Need to know About Us</h1>
                    <p>
                        Purchasebro buys various unwanted gift cards for less than their value
                        and we also sells discounted gift cards to savvy shoppers across the country.
                        It is a great way to get cash for your unwanted gift cards, and to save money
                        on all your purchases with discounted gift cards.
                    </p>
                    <a class="primary-btn" href="#">Know More</a>
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
 <!-- Start feature section -->
 <section class="feature-section section-gap-full" id="feature-section">
     <div class="container">
         <div class="row align-items-center feature-wrap">
             <div class="col-lg-4 header-left">
                 <h1>
                     An exceptionally unique experience for you
                 </h1>
                 <a class="primary-btn" href="{{route('about.create')}}">Know More
                     <span class="ti-arrow-right"></span>
                 </a>
             </div>
             <div class="col-lg-8">
                 <div class="row features-wrap">
                     <div class="col-md-6">
                         <div class="single-feature relative">
                             <div class="overlay overlay-bg"></div>
                             <span class="ti-palette"></span>
                             <h3>Awesome Design</h3>
                             <p>
                                 {{setting('site.title')}} creates a dynamic user friendly interface, like these sweet
                                 mornings of spring which you enjoy.
                             </p>
                         </div>
                     </div>
                     <div class="col-md-6">
                         <div class="single-feature relative">
                             <div class="overlay overlay-bg"></div>
                             <span class="ti-key"></span>
                             <h3>Premium Security</h3>
                             <p>
                                 A high grade secured website void of intrusion. Setting your
                                 mind at ease as you cruise through.
                             </p>
                         </div>
                     </div>
                     <div class="col-md-6">
                         <div class="single-feature relative">
                             <div class="overlay overlay-bg"></div>
                             <span class="ti-money"></span>
                             <h3>Instant Payments</h3>
                             <p>
                                 Secure and safe payment methods via Online Transfers, etc
                                 making all transactions flow effortlessly.
                             </p>
                         </div>
                     </div>
                     <div class="col-md-6">
                         <div class="single-feature relative">
                             <div class="overlay overlay-bg"></div>
                             <span class="ti-headphone-alt"></span>
                             <h3>Excellent Support</h3>
                             <p>
                                 His many legs, pitifully thin compared with the size of the rest of him, waved
                                 about helplessly as he looked.
                             </p>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!-- End feature section -->

    <!-- Start stat section -->
    <section class="stat-section section-gap-half">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-stat">
                        <i class="ti-thumb-up"></i>
                        <h1>
                            <span class="counter">2560</span>+</h1>
                        <h4>Gift Card Download</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-stat">
                        <i class="ti-face-smile"></i>
                        <h1>
                            <span class="counter">236</span>+</h1>
                        <h4>Happy Customers</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-stat">
                        <i class="ti-paint-bucket"></i>
                        <h1>
                            <span class="counter">188</span>+</h1>
                        <h4>Cup of coffee</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-stat">
                        <i class="ti-check-box"></i>
                        <h1>
                            <span class="counter">1986</span>+</h1>
                        <h4>Positive reviews</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End stat section -->

   {{-- <!-- Start team section -->
    <section class="team-section section-gap-full">
        <div class="container">
            <div class="section-title">
                <h2 class="text-center">Our Team</h2>
                <p class="text-center">Introducing the Brains behind the project.</p>
            </div>
            <div class="row">
                <div class="team-carusel  owl-carousel" id="team-carusel">
                    <div class="single-team item">
                        <img class="img-fluid" src="img/team1.jpg" alt="">
                        <div class="team-content">
                            <h4>Foto Sushi</h4>
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="single-team item">
                        <img class="img-fluid" src="img/team2.jpg" alt="">
                        <div class="team-content">
                            <h4>Philipe Cavalcante</h4>
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="single-team item">
                        <img class="img-fluid" src="img/team3.jpg" alt="">
                        <div class="team-content">
                            <h4>Cristian Newman</h4>
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="single-team item">
                        <img class="img-fluid" src="img/team4.jpg" alt="">
                        <div class="team-content">
                            <h4>Conor Sexton</h4>
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="single-team item">
                        <img class="img-fluid" src="img/team5.jpg" alt="">
                        <div class="team-content">
                            <h4>Pete Bellis</h4>
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="single-team item">
                        <img class="img-fluid" src="img/team6.jpg" alt="">
                        <div class="team-content">
                            <h4>Tanja Heffner</h4>
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="single-team item">
                        <img class="img-fluid" src="img/team1.jpg" alt="">
                        <div class="team-content">
                            <h4>Foto Sushi</h4>
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="single-team item">
                        <img class="img-fluid" src="img/team2.jpg" alt="">
                        <div class="team-content">
                            <h4>Philipe Cavalcante</h4>
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="single-team item">
                        <img class="img-fluid" src="img/team3.jpg" alt="">
                        <div class="team-content">
                            <h4>Cristian Newman</h4>
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End team section --> --}}

 <!-- Start testimonial section -->
 <section class="testimonial-section section-gap-half" id="testimonial-section" background color="gray">
     <div class="container">
         <div class="row align-items-center">
             <div class="col-lg-4 testimonial-left">
                 <h2>What People Says</h2>
                 <p>
                     Great way to earn some extra cash selling off unneeded gift cards.
                 </p>
                 <a class="primary-btn" href="{{route('contact.index')}}">Contact Us
                     <span class="ti-arrow-right"></span>
                 </a>
             </div>
             <div class="col-lg-8 testimonial-right">
                 <div class="testimonial-carusel owl-carousel" id="testimonial-carusel">
                     @foreach ($testimonials as $testimonial)
                         <div class="single-testimonial item">
                             <p>
                                 {!! $testimonial->comment !!}
                             </p>
                             <div class="user-details d-flex flex-row align-items-center">
                                 <div class="img-wrap">
                                     <img src="{{ asset('storage/'.$testimonial->image.'') }}" alt="image">
                                 </div>
                                 <div class="details">
                                     <h4>{{ $testimonial->name }}</h4>
                                     <p>{{ $testimonial->title }}</p>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!-- End testimonial section -->


@endsection
