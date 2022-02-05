<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">
    <!-- Author Meta -->
    <meta name="author" content="">
    <!-- Meta Description -->
    <meta name="description" content="Buy and Sell your Unwanted Gift Cards">
    <!-- Meta Keyword -->
    <meta name="keywords" content="Buy, Sell, Gift Cards">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>{{config('app.name')}} - Payment Instructions</title>

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
    <link rel="stylesheet" href="{{asset('css/payment.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">

</head>

<body class="blank">

    <div class="wrapper">

        <!-- Main content-->
        <section>
            <div class="container-center lg animated slideInDown">


                <div class="view-header">
                    <!--<div class="header-icon">
                        <i class="fas fa-cash-register"></i>
                    </div>-->
                    <div class="header-title">
                        <h3>Payment Instructions</h3>
                        <small>Follow these instructions to complete your payment</small>
                    </div>
                </div>

                <div class="panel ">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-filled">
                                    <div class="panel-body">
                                        <div align="center">

                                            <span class="stat-text" style="padding-bottom: 15px;">
                                                <p>Your payment request has been sent to Nigeria Pay-By-Bank.</p>
                                                <p><strong>To complete the payment please do the following:</strong></p>

                                                    {!! $params['paymentInstructions'] !!}
                                                <!--
                                                <p>Use your phone's camera or a QR scanner app on your phone to scan the QR code.<br><br>
                                                iPhone / Android users, click on the link below to open the payment screen on your phone's browser.
                                                <br><br>
                                                <strong><a href="https://tinyurl.com/yemxdvtv" target="popup" onclick="window.open(&#39;https://tinyurl.com/yemxdvtv&#39;,&#39;popup&#39;,&#39;width=600,height=600&#39;); return false;">CLICK HERE to Open Payment Screen</a></strong>
                                                <br><br>
                                                Payment will be processed by <strong>Wallettec</strong></p> -->
                                                    <p>
                                                        <img src="{{ $params['invoiceURL'] }}" style="background-color: white;">
                                                    </p>

                                            </span>
                                            <a href="{{ route('shop.myBux', 'mybux') }}"><button class="btn btn-danger">Cancel Payment</button></a>
                                            <a href="{{ route('getStatus', ['id' =>$params['transactionId']]) }}"><button class="btn btn-success">Confirm Payment</button></a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>
        <!-- End main content-->

    </div>

</body>

</html>
