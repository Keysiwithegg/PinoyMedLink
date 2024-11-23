<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{env('APP_NAME')}}</title>

        <link rel="icon" href="{{ asset('new-icon.png') }}">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <!-- Nice Select CSS -->
        <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
        <!-- Font Awesome CSS -->
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
        <!-- icofont CSS -->
        <link rel="stylesheet" href="{{ asset('css/icofont.css') }}">
        <!-- Slicknav -->
        <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}">
        <!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="{{ asset('css/owl-carousel.css') }}">
        <!-- Datepicker CSS -->
        <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
        <!-- Animate CSS -->
        <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
        <!-- Magnific Popup CSS -->
        <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">

        <style>
            html {
                scroll-behavior: smooth;
            }

            .get-quote {
                gap: 20px; /* or any specific pixel value you want */
            }

        </style>
        <!-- Medipro CSS -->
        <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
        <link rel="stylesheet" href="{{ asset('style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

    </head>
    <body>

    <!-- Preloader -->
    <div class="preloader">
        <div class="loader">
            <div class="loader-outter"></div>
            <div class="loader-inner"></div>

            <div class="indicator">
                <svg width="16px" height="12px">
                    <polyline id="back" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                    <polyline id="front" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                </svg>
            </div>
        </div>
    </div>
    <!-- End Preloader -->

    <!-- Header Area -->
    <header class="header" >
        <!-- Topbar -->
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-5 col-12">
                        <!-- Contact -->
                        <ul class="top-link">
                            <li><a href="{{url('/contact')}}">Contact</a></li>
                        </ul>
                        <!-- End Contact -->
                    </div>
                    <div class="col-lg-6 col-md-7 col-12">
                        <!-- Top Contact -->
                        <ul class="top-contact">
                            <li><i class="fa fa-phone"></i>22545760</li>
                            <li><i class="fa fa-envelope"></i><a href="mailto:support@yourmail.com">support@yourmail.com</a></li>
                        </ul>
                        <!-- End Top Contact -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Topbar -->
        <!-- Header Inner -->
        <div class="header-inner">
            <div class="container">
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-12">
                            <!-- Start Logo -->
                            <div class="logo">
                                <a href="{{url('/')}}"><img src="{{asset('img/logo-new.png')}}" alt="#"></a>
                            </div>
                            <!-- End Logo -->
                            <!-- Mobile Nav -->
                            <div class="mobile-nav"></div>
                            <!-- End Mobile Nav -->
                        </div>
                        <div class="col-lg-7 col-md-9 col-12">
                            <!-- Main Menu -->
                            <div class="main-menu">
                                <nav class="navigation">
                                    <ul class="nav menu">
                                        <li><a href="{{url('/')}}">Home</a></li>
                                        <li><a href="{{url('/contact')}}">Contact Us</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <!--/ End Main Menu -->
                        </div>
                        <div class="col-lg-2 col-12">
                            <div class="get-quote d-flex gap-3">
                                <a href="{{route('login')}}" class="btn">Login</a>
                                <a href="{{route('register')}}" class="btn">Register</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Header Inner -->
    </header>
    <!-- End Header Area -->

    <!-- Slider Area -->
    <section class="slider">
        <div class="hero-slider">
            <!-- Start Single Slider -->
            <div class="single-slider" style="background-image:url('img/1.png')">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="text">
                                <h1>Welcome to <span>Tondo Foreshore</span> Super Health Center & <span>Lying-In Clinic</span></h1>
                                <p>Providing compassionate healthcare and reliable lying-in services to the Tondo community. Your health is our priority.</p>
                                <div class="button">
                                    <a href="#" class="btn">Contact Us!</a>
                                    <a href="#" class="btn primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End Single Slider -->
            <!-- Start Single Slider -->
            <div class="single-slider" style="background-image:url('img/2.png')">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="text">
                                <h1>We Provide <span>Medical</span> Services That <span>Help People!</span></h1>
                                <p>At Tondo Foreshore Super Health Center & Lying-In Clinic, we are dedicated to improving lives by offering compassionate care and accessible healthcare solutions for everyone in need.</p>
                                <div class="button">
                                    <a href="#" class="btn">Contact Us!</a>
                                    <a href="#" class="btn primary">About Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Start End Slider -->
            <!-- Start Single Slider -->
            <div class="single-slider" style="background-image:url('img/3.png')">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="text">
                                <h1>We Provide <span>Medical</span> Services That You Can <span>Trust!</span></h1>
                                <p>Committed to serving the people of Manila and uplifting the health and well-being of communities across the country. Together, we build a healthier future for everyone.</p>
                                <div class="button">
                                    <a href="#" class="btn primary">Contact Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End Single Slider -->
        </div>
    </section>
    <!--/ End Slider Area -->

    <!-- Start Schedule Area -->
    <section class="schedule">
        <div class="container">
            <div class="schedule-inner">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <!-- single-schedule -->
                        <div class="single-schedule first">
                            <div class="inner">
                                <div class="icon">
                                    <i class="fa fa-ambulance"></i>
                                </div>
                                <div class="single-content">
                                    <span>Quick Care</span>
                                    <h4>Emergency Cases</h4>
                                    <p>We provide immediate help for urgent needs, ensuring timely medical attention.</p>
                                    <a href="#">LEARN MORE<i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <!-- single-schedule -->
                        <div class="single-schedule middle">
                            <div class="inner">
                                <div class="icon">
                                    <i class="icofont-chat"></i>
                                </div>
                                <div class="single-content">
                                    <span>Get Answers</span>
                                    <h4>Chat Feature</h4>
                                    <p>Reach out to our team via chat to get quick answers to your health concerns.</p>
                                    <a href="#">LEARN MORE<i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-12">
                        <!-- single-schedule -->
                        <div class="single-schedule last">
                            <div class="inner">
                                <div class="icon">
                                    <i class="icofont-ui-clock"></i>
                                </div>
                                <div class="single-content">
                                    <h4>Opening Hours</h4>
                                    <ul class="time-sidual">
                                            <li class="day">Monday - Friday <span>8.00-20.00</span></li>
                                        <li class="day">Saturday <span>9.00-18.30</span></li>
                                        <li class="day">Sunday - Thursday <span>9.00-15.00</span></li>
                                    </ul>
                                    <a href="#">LEARN MORE<i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--/End Start schedule Area -->

    <section class="Feautes section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Welcome to Tondo Foreshore Super Health Center & Lying-In Clinic</h2>
                        <img src="img/section-img.png" alt="#">
                        <p>Dedicated to providing quality healthcare and lying-in services for the Tondo community and beyond.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-12">
                    <!-- Start Single features -->
                    <div class="single-features">
                        <div class="signle-icon">
                            <i class="icofont icofont-ambulance-cross"></i>
                        </div>
                        <h3>24/7 Emergency Assistance</h3>
                        <p>Always ready to provide urgent care with compassion and expertise for any medical emergencies.</p>
                    </div>
                    <!-- End Single features -->
                </div>
                <div class="col-lg-4 col-12">
                    <!-- Start Single features -->
                    <div class="single-features">
                        <div class="signle-icon">
                            <i class="icofont icofont-medical-sign-alt"></i>
                        </div>
                        <h3>Comprehensive Pharmacy</h3>
                        <p>Offering a complete range of medicines and healthcare products to meet your needs.</p>
                    </div>
                    <!-- End Single features -->
                </div>
                <div class="col-lg-4 col-12">
                    <!-- Start Single features -->
                    <div class="single-features last">
                        <div class="signle-icon">
                            <i class="icofont icofont-stethoscope"></i>
                        </div>
                        <h3>Quality Medical Care</h3>
                        <p>Providing expert medical treatment tailored to ensure the best care for you and your family.</p>
                    </div>
                    <!-- End Single features -->
                </div>
            </div>
        </div>
    </section>


    <!-- Start Fun-facts -->
{{--    <div id="fun-facts" class="fun-facts section overlay">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-3 col-md-6 col-12">--}}
{{--                    <!-- Start Single Fun -->--}}
{{--                    <div class="single-fun">--}}
{{--                        <i class="icofont icofont-home"></i>--}}
{{--                        <div class="content">--}}
{{--                            <span class="counter">3468</span>--}}
{{--                            <p>Hospital Rooms</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- End Single Fun -->--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-md-6 col-12">--}}
{{--                    <!-- Start Single Fun -->--}}
{{--                    <div class="single-fun">--}}
{{--                        <i class="icofont icofont-user-alt-3"></i>--}}
{{--                        <div class="content">--}}
{{--                            <span class="counter">557</span>--}}
{{--                            <p>Specialist Doctors</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- End Single Fun -->--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-md-6 col-12">--}}
{{--                    <!-- Start Single Fun -->--}}
{{--                    <div class="single-fun">--}}
{{--                        <i class="icofont-simple-smile"></i>--}}
{{--                        <div class="content">--}}
{{--                            <span class="counter">4379</span>--}}
{{--                            <p>Happy Patients</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- End Single Fun -->--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-md-6 col-12">--}}
{{--                    <!-- Start Single Fun -->--}}
{{--                    <div class="single-fun">--}}
{{--                        <i class="icofont icofont-table"></i>--}}
{{--                        <div class="content">--}}
{{--                            <span class="counter">32</span>--}}
{{--                            <p>Years of Experience</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- End Single Fun -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!--/ End Fun-facts -->

    <!-- Start Why choose -->
{{--    <section class="why-choose section" >--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-12">--}}
{{--                    <div class="section-title">--}}
{{--                        <h2>We Offer Different Services To Improve Your Health</h2>--}}
{{--                        <img src="img/section-img.png" alt="#">--}}
{{--                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit praesent aliquet. pretiumts</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-6 col-12">--}}
{{--                    <!-- Start Choose Left -->--}}
{{--                    <div class="choose-left">--}}
{{--                        <h3>Who We Are</h3>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pharetra antege vel est lobortis, a commodo magna rhoncus. In quis nisi non emet quam pharetra commodo. </p>--}}
{{--                        <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. </p>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-lg-6">--}}
{{--                                <ul class="list">--}}
{{--                                    <li><i class="fa fa-caret-right"></i>Maecenas vitae luctus nibh. </li>--}}
{{--                                    <li><i class="fa fa-caret-right"></i>Duis massa massa.</li>--}}
{{--                                    <li><i class="fa fa-caret-right"></i>Aliquam feugiat interdum.</li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-6">--}}
{{--                                <ul class="list">--}}
{{--                                    <li><i class="fa fa-caret-right"></i>Maecenas vitae luctus nibh. </li>--}}
{{--                                    <li><i class="fa fa-caret-right"></i>Duis massa massa.</li>--}}
{{--                                    <li><i class="fa fa-caret-right"></i>Aliquam feugiat interdum.</li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- End Choose Left -->--}}
{{--                </div>--}}
{{--                <div class="col-lg-6 col-12">--}}
{{--                    <!-- Start Choose Rights -->--}}
{{--                    <div class="choose-right">--}}
{{--                        <div class="video-image">--}}
{{--                            <!-- Video Animation -->--}}
{{--                            <div class="promo-video">--}}
{{--                                <div class="waves-block">--}}
{{--                                    <div class="waves wave-1"></div>--}}
{{--                                    <div class="waves wave-2"></div>--}}
{{--                                    <div class="waves wave-3"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!--/ End Video Animation -->--}}
{{--                            <a href="https://www.youtube.com/watch?v=RFVXy6CRVR4" class="video video-popup mfp-iframe"><i class="fa fa-play"></i></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- End Choose Rights -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <!--/ End Why choose -->

    <!-- Start Call to action -->
    <section class="call-action overlay" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="content">
                        <h2>Do you need Emergency Medical Care? Call @ 22545760</h2>
                        <p>Our team of dedicated healthcare professionals is here to provide urgent medical care whenever you need it. Don't wait, your health is our priority.</p>
                        <div class="button">
                            <a href="#" class="btn">Contact Now</a>
                            <a href="#" class="btn second">Learn More<i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Call to action -->

    <!-- Start portfolio -->
    <section class="portfolio section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>We Take Pride in Supporting Women, Children, and Families</h2>
                        <img src="img/section-img.png" alt="#">
                        <p>Our hospital is dedicated to providing compassionate care and assistance to those in need, empowering individuals and communities alike.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="owl-carousel portfolio-slider">
                        <div class="single-pf">
                            <img src="{{asset('img/profile1.png')}}" alt="Image of a helped person">
                        </div>
                        <div class="single-pf">
                            <img src="{{asset('img/profile2.png')}}" alt="Image of a woman helped">
                        </div>
                        <div class="single-pf">
                            <img src="{{asset('img/profile3.png')}}" alt="Image of children receiving help">
                        </div>
                        <div class="single-pf">
                            <img src="{{asset('img/profile4.png')}}" alt="Image of supported families">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--/ End portfolio -->

    <!-- Start service -->
{{--    <section class="services section">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-12">--}}
{{--                    <div class="section-title">--}}
{{--                        <h2>We Offer Different Services To Improve Your Health</h2>--}}
{{--                        <img src="img/section-img.png" alt="#">--}}
{{--                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit praesent aliquet. pretiumts</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-4 col-md-6 col-12">--}}
{{--                    <!-- Start Single Service -->--}}
{{--                    <div class="single-service">--}}
{{--                        <i class="icofont icofont-prescription"></i>--}}
{{--                        <h4><a href="service-details.html">General Treatment</a></h4>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus dictum eros ut imperdiet. </p>--}}
{{--                    </div>--}}
{{--                    <!-- End Single Service -->--}}
{{--                </div>--}}
{{--                <div class="col-lg-4 col-md-6 col-12">--}}
{{--                    <!-- Start Single Service -->--}}
{{--                    <div class="single-service">--}}
{{--                        <i class="icofont icofont-tooth"></i>--}}
{{--                        <h4><a href="service-details.html">Teeth Whitening</a></h4>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus dictum eros ut imperdiet. </p>--}}
{{--                    </div>--}}
{{--                    <!-- End Single Service -->--}}
{{--                </div>--}}
{{--                <div class="col-lg-4 col-md-6 col-12">--}}
{{--                    <!-- Start Single Service -->--}}
{{--                    <div class="single-service">--}}
{{--                        <i class="icofont icofont-heart-alt"></i>--}}
{{--                        <h4><a href="service-details.html">Heart Surgery</a></h4>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus dictum eros ut imperdiet. </p>--}}
{{--                    </div>--}}
{{--                    <!-- End Single Service -->--}}
{{--                </div>--}}
{{--                <div class="col-lg-4 col-md-6 col-12">--}}
{{--                    <!-- Start Single Service -->--}}
{{--                    <div class="single-service">--}}
{{--                        <i class="icofont icofont-listening"></i>--}}
{{--                        <h4><a href="service-details.html">Ear Treatment</a></h4>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus dictum eros ut imperdiet. </p>--}}
{{--                    </div>--}}
{{--                    <!-- End Single Service -->--}}
{{--                </div>--}}
{{--                <div class="col-lg-4 col-md-6 col-12">--}}
{{--                    <!-- Start Single Service -->--}}
{{--                    <div class="single-service">--}}
{{--                        <i class="icofont icofont-eye-alt"></i>--}}
{{--                        <h4><a href="service-details.html">Vision Problems</a></h4>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus dictum eros ut imperdiet. </p>--}}
{{--                    </div>--}}
{{--                    <!-- End Single Service -->--}}
{{--                </div>--}}
{{--                <div class="col-lg-4 col-md-6 col-12">--}}
{{--                    <!-- Start Single Service -->--}}
{{--                    <div class="single-service">--}}
{{--                        <i class="icofont icofont-blood"></i>--}}
{{--                        <h4><a href="service-details.html">Blood Transfusion</a></h4>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus dictum eros ut imperdiet. </p>--}}
{{--                    </div>--}}
{{--                    <!-- End Single Service -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <!--/ End service -->








    <!-- Footer Area -->
    <footer id="footer" class="footer ">
        <!-- Footer Top -->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="single-footer">
                            <h2>About Us</h2>
                            <p>Tondo Foreshore Super Health Center & Lying-In Clinic is dedicated to providing accessible and reliable healthcare services for the people of Tondo and beyond.</p>
                            <!-- Social -->
                            <ul class="social">
                                <li><a href="#"><i class="icofont-facebook"></i></a></li>
                            </ul>
                            <!-- End Social -->
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="single-footer f-link">
                            <h2>Quick Links</h2>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Home</a></li>
                                        <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>About Us</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <ul>
{{--                                        <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>FAQ</a></li>--}}
                                        <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="single-footer">
                            <h2>Open Hours</h2>
                            <p>We are here to serve the community with extended hours to cater to your healthcare needs.</p>
                            <ul class="time-sidual">
                                <li class="day">Monday - Friday <span>8:00 AM - 8:00 PM</span></li>
                                <li class="day">Saturday <span>9:00 AM - 6:30 PM</span></li>
                                <li class="day">Sunday <span>9:00 AM - 3:00 PM</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Footer Top -->
        <!-- Copyright -->
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="copyright-content">
                            <p>© Copyright 2024  |  All Rights Reserved by Med Sphere</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Copyright -->
    </footer>
    <!--/ End Footer Area -->


    <!-- jQuery Min JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- jQuery Migrate JS -->
    <script src="{{ asset('js/jquery-migrate-3.0.0.js') }}"></script>
    <!-- jQuery UI JS -->
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <!-- Easing JS -->
    <script src="{{ asset('js/easing.js') }}"></script>
    <!-- Color JS -->
    <script src="{{ asset('js/colors.js') }}"></script>
    <!-- Popper JS -->
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <!-- Bootstrap Datepicker JS -->
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <!-- jQuery Nav JS -->
    <script src="{{ asset('js/jquery.nav.js') }}"></script>
    <!-- Slicknav JS -->
    <script src="{{ asset('js/slicknav.min.js') }}"></script>
    <!-- ScrollUp JS -->
    <script src="{{ asset('js/jquery.scrollUp.min.js') }}"></script>
    <!-- Niceselect JS -->
    <script src="{{ asset('js/niceselect.js') }}"></script>
    <!-- Tilt jQuery JS -->
    <script src="{{ asset('js/tilt.jquery.min.js') }}"></script>
    <!-- Owl Carousel JS -->
    <script src="{{ asset('js/owl-carousel.js') }}"></script>
    <!-- Counterup JS -->
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <!-- Steller JS -->
    <script src="{{ asset('js/steller.js') }}"></script>
    <!-- Wow JS -->
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <!-- Magnific Popup JS -->
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Counter Up CDN JS -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('js/main.js') }}"></script>

    </body>
</html>
