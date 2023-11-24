@extends('layouts.front_layout.front_layout')
@section('content')
    <!-- banner -->
    <div class="banner10" id="home1">
        <div class="container">
            <h2>PAYPAL</h2>
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
                        <h3>YOUR ORDER HAS BEEN PLACED</h3>
                        <br>
                        <p>Your order number is {{ Session::get('order_id') }} and total payable amount is {{ Session::get('grand_total') }}.Php</p>
                        <br>
                        <p>Please make payment by clicking on below Payment button.</p>
                        <br>
                        <br>
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                            <input type="hidden" name="cmd" value="_xclick">
                            <input type="hidden" name="business" value="paypal@rayeallistic.com">
                            <input type="hidden" name="item_name" value="{{ Session::get('order_id')}}">
                            <input type="hidden" name="currency_code" value="PHP">
                            <input type="hidden" name="amount" value="{{ Session::get('grand_total')}}">
                            <input type="hidden" name="first_name" value="{{ $nameArr[0] }}">
                            <input type="hidden" name="last_name" value="{{ $nameArr[1] }}">
                            <input type="hidden" name="address1" value="{{ $orderDetails['address'] }}">
                            <input type="hidden" name="address2" value="">
                            <input type="hidden" name="country" value="{{ $orderDetails['country'] }}">
                            <input type="hidden" name="city" value="{{ $orderDetails['city'] }}">
                            <input type="hidden" name="province" value="{{ $orderDetails['province'] }}">
                            <input type="hidden" name="pincode" value="{{ $orderDetails['pincode'] }}">
                            <input type="hidden" name="email" value="{{ $orderDetails['email'] }}">
                            <input type="hidden" name="return" value="{{ url('paypal/success') }}">
                            <input type="hidden" name="cancel_return" value="{{ url('paypal/fail') }}">
                            <input type="hidden" name="notify_url" value="{{ url('paypal/ipn') }}">
                            <input type="image" name="submit"
                              src="https://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif"
                              alt="PayPal - The safer, easier way to pay online">
                          </form>
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
Session::forget('couponCode');
Session::forget('couponAmount');
?>
