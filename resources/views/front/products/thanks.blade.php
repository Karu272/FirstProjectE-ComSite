@extends('layouts.front_layout.front_layout')
@section('content')
    <!-- banner -->
    <div class="banner10" id="home1">
        <div class="container">
            <h2>Rayeallistic Thanks you!</h2>
        </div>
    </div>
    <!-- //banner -->
    <!-- breadcrumbs -->
    <div class="breadcrumb_dress">
        <div class="container">
            <ul>
                <li><a href="{{ URL('/') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a>
                    <i>/</i></li>
                <li>THANK YOU!</li>
            </ul>
        </div>
    </div>
    <!-- //breadcrumbs -->
    <div id="myModal88" role="dialog" aria-labelledby="myModal88">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="margin-top: 20px" class="modal-title" id="myModalLabel">Thank you!</h4>
                    <hr class="soft" />
                    <div align="center">
                        <h3>YOUR ORDER HAS BEEN PLACED SUCCESSFULLY</h3>
                        <br>
                        <p>Your order number is {{ Session::get('order_id') }} and grand total is {{ Session::get('grand_total') }}.Php</p>
                    </div>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    @include('front.banners.home_page_banners')
    <br>
    <br>
    <br>
    <br>
@endsection
<?php
Session::forget('grand_total');
Session::forget('order_id');
Session::forget('couponCode');
Session::forget('couponAmount');
?>
