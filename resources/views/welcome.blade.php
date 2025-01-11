@extends('layouts.guest-app')


@section('content')
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


@endsection
