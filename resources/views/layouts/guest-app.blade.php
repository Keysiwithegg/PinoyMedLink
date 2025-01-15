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

        .hidden-link {
            visibility: hidden;
        }

        .get-quote {
            gap: 20px; /* or any specific pixel value you want */
        }

        .mobile-only {
            display: none;
        }

        @media (max-width: 768px) {
            .hidden-link {
                visibility: visible;
            }

            .mobile-only {
                display: block;
            }
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
                        <li><a href="{{url('/contact')}}">Contact Us</a></li>
                    </ul>
                    <!-- End Contact -->
                </div>
                <div class="col-lg-6 col-md-7 col-12">
                    <!-- Top Contact -->
                    <ul class="top-contact">
                        <li><i class="fa fa-phone"></i>22545760</li>
                        <li><i class="fa fa-envelope"></i><a href="mailto:support@yourmail.com">admin@medsphere.top</a></li>
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
                                    <li class="hidden-link"><a href="{{url('/')}}">Home</a></li>
                                    <li class="mobile-only"><a href="{{url('/contact')}}">Contact</a></li>
                                    <li class="mobile-only"><a href="{{url('/login')}}">Login</a></li>
                                    <li class="mobile-only"><a href="{{url('/register')}}">Register</a></li>
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
@yield('content')

@extends('layouts.guest-footer')

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
