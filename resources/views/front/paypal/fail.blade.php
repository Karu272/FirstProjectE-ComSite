@extends('layouts.front_layout.front_layout')
@section('content')
    <!-- banner -->
    <div class="banner10" id="home1">
        <div class="container">
            <h2>Fail...</h2>
        </div>
    </div>
    <!-- //banner -->
    <!-- breadcrumbs -->
    <div class="breadcrumb_dress">
        <div class="container">
            <ul>
                <li><a href="{{ URL('/') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a>
                    <i>/</i></li>
                <li>SORRY...</li>
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
                        <h3>YOUR ORDER HAS FAILED. PLEASE TRY AGAIN...</h3>
                        <br>
                        <p>If there are any problems, please contact us<a href="{{ url('info/contactUs')}}">HERE</a></p>
                        <br>
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
