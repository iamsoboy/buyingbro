<!-- Start footer section -->
<footer class="footer-section section-gap-half">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6 footer-cols">
                    <a href="#">
                        <img src="img/logo-w.png" alt="">
                    </a>
                    <p class="copyright-text">&copy; <script>document.write(new Date().getFullYear());</script> Design With
                        <i class="fa fa-heart" aria-hidden="true"></i> By <br>
                        <a href="#" target="_blank">BuyingBro</a>
                    </p>
                </div>
                <div class="col-lg-3 col-sm-6 footer-cols">
                    <h4>Resources</h4>
                    <ul>
                        <li><a href="{{route('index')}}">Home</a></li>
                        <li><a href="{{route('about.create')}}">About Us</a></li>
                        <li><a href="{{route('contact.index')}}">Contact Us</a></li>
                        <li><a href="{{route('news.create')}}">Blog</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-sm-6 footer-cols">
                    <h4>Help</h4>
                    <ul>
                        <li><a href="{{route('terms')}}">Terms & condition</a></li>
                        <li> <a href="{{route('privacy')}}">Privacy</a></li>
                        <li> <a href="{{route('howitworks')}}">How It Works</a></li>
                        <li> <a href="{{route('faq')}}">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-sm-6 footer-cols">
                    <h4>Get in touch</h4>
                    <ul>
                        <li>
                            <a href="tel:+15058190857">{!! setting('site.site_phone') !!}</a>
                        </li>
                        <li>
                            <a href="email:{!! setting('site.site_email') !!}">{!! setting('site.site_email') !!}</a>
                        </li>
                        <li>
                            <a href="#">
                                {!! setting('site.site_address') !!}
                            </a>
                        </li>
                    </ul>
                    <ul id="social">
                        {{--
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
                        --}}
                        <li>
                            <a target="_blank" href="https://instagram.com/buyingbro">
                                <i class="fa fa-instagram" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- End footer section -->

    <div class="scroll-top">
        <i class="ti-angle-up"></i>
    </div>
