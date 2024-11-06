@extends('layouts.app')


@section('content')

    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        /* Section Styles */
        #pricing-table {
            padding: 60px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-title h2 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .section-title p {
            font-size: 1.1rem;
            color: #666;
        }

        /* Pricing Table Styles */
        .single-table {
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: 15px 0;
            text-align: center;
            transition: transform 0.3s;
        }

        .single-table:hover {
            transform: scale(1.05);
        }

        .table-head {
            padding: 20px;
            background-color: #007bff;
            color: #fff;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .table-head .icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .table-head .title {
            font-size: 1.5rem;
        }

        .price {
            font-size: 2rem;
            margin-top: 10px;
        }

        .table-list {
            list-style-type: none;
            padding: 0;
            margin: 20px 0;
        }

        .table-list li {
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .table-list li:last-child {
            border-bottom: none;
        }

        .table-bottom {
            padding: 20px;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

    </style>
    <section id="pricing-table" class="pricing-table section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Affordable Plans</h2>
                        <img src="img/section-img.png" alt="#">
                        <p>Choose the plan that suits your needs and budget. Quality care at a reasonable price.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Free Tier -->
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="single-table">
                        <div class="table-head">
                            <div class="icon">
                                <i class="icofont icofont-tag"></i>
                            </div>
                            <h4 class="title" style="color: white">Free Tier</h4>
                            <div class="price">
                                <p class="amount">₱0</p>
                            </div>
                        </div>
                        <ul class="table-list">
                            <li><i class="icofont icofont-ui-check"></i>1 doctor, 1 nurse</li>
                            <li><i class="icofont icofont-ui-check"></i>Up to 20 patients</li>
                            <li><i class="icofont icofont-ui-check"></i>Basic records management</li>
                            <li><i class="icofont icofont-ui-check"></i>Appointment scheduling</li>
                            <li><i class="icofont icofont-ui-check"></i>Email support</li>
                        </ul>
                        <div class="table-bottom">
                            <a class="btn" href="{{route('checkout')}}">Book Now</a>
                        </div>
                    </div>
                </div>
                <!-- Starter Tier -->
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="single-table">
                        <div class="table-head">
                            <div class="icon">
                                <i class="icofont icofont-rocket"></i>
                            </div>
                            <h4 class="title" style="color: white">Starter Tier</h4>
                            <div class="price">
                                <p class="amount">₱1500</p>
                            </div>
                        </div>
                        <ul class="table-list">
                            <li><i class="icofont icofont-ui-check"></i>3 doctors, 3 nurses</li>
                            <li><i class="icofont icofont-ui-check"></i>Up to 100 patients</li>
                            <li><i class="icofont icofont-ui-check"></i>All Free Tier features</li>
                            <li><i class="icofont icofont-ui-check"></i>Prescription management</li>
                            <li><i class="icofont icofont-ui-check"></i>Email and chat support</li>
                        </ul>
                        <div class="table-bottom">
                            <a class="btn" href="{{route('checkout')}}">Book Now</a>
                        </div>
                    </div>
                </div>
                <!-- Professional Tier -->
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="single-table">
                        <div class="table-head">
                            <div class="icon">
                                <i class="icofont icofont-star"></i>
                            </div>
                            <h4 class="title" style="color: white">Professional Tier</h4>
                            <div class="price">
                                <p class="amount">₱5000php</p>
                            </div>
                        </div>
                        <ul class="table-list">
                            <li><i class="icofont icofont-ui-check"></i>10 doctors, 10 nurses</li>
                            <li><i class="icofont icofont-ui-check"></i>Up to 500 patients</li>
                            <li><i class="icofont icofont-ui-check"></i>All Starter Tier features</li>
                            <li><i class="icofont icofont-ui-check"></i>Advanced telehealth</li>
                            <li><i class="icofont icofont-ui-check"></i>Phone and chat support</li>
                        </ul>
                        <div class="table-bottom">
                            <a class="btn" href="{{route('checkout')}}">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
