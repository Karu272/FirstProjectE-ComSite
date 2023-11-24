@extends('layouts.front_layout.front_layout')
@section('content')
    <!-- banner -->
    <div class="banner10" id="home1">
        <div class="container">
            <h2>Forgot password</h2>
        </div>
    </div>
    <!-- //banner -->
    <!-- breadcrumbs -->
    <div class="breadcrumb_dress">
        <div class="container">
            <ul>
                <li><a href="{{ URL('/') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a>
                    <i>/</i></li>
            </ul>
        </div>
    </div>
    <!-- //breadcrumbs -->
    <!-- Login model -->
    <!-- Form properties  -->
    <div id="myModal88" role="dialog" aria-labelledby="myModal88">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- // Form properties  -->
                    <!-- Form + header  -->
                    <h4 style="margin-top: 20px" class="modal-title" id="myModalLabel">
                        Forgot your password? </h4>
                </div>
                <div class="modal-body modal-body-sub">
                    <div class="row">
                        <div class="col-md-8 modal_body_left modal_body_left1"
                            style="border-right: 1px dotted #C2C2C2;padding-right:3em;">
                            <div class="sap_tabs">
                                <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
                                    <!-- // Form + header  -->
                                    <!-- Sign in -->
                                    <div class="tab-1 resp-tab" aria-labelledby="tab_item-0">
                                        <div class="facts">
                                            <div class="register">
                                                <form action="{{ URL('/forgot-password') }}" id="forgotPasswordForm"
                                                    method="post">@csrf
                                                    <input for="email" name="email" id="email" placeholder="Email Address"
                                                        type="text" required="">
                                                    <div class="sign-up">
                                                        <input type="submit" value="Send reset link" />
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- // Sign in -->
                                    <!-- Success/error msg -->
                                    @if (Session::has('success_message'))
                                        <div class="alert alert-success alert-dismissible " role="alert">
                                            {{ Session::get('success_message') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    @if (Session::has('error_message'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            {{ Session::get('error_message') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    <!-- // Success/error msg -->
                                </div>
                            </div>
                        </div>
                        <!-- Social media login  -->
                        <div class="col-md-4 modal_body_right modal_body_right1">
                            <div class="row text-center sign-with">
                                <h3 class="other-nw">Issues?</h3>
                                <h3 class="other-nw">Don't worry!</h3>
                                <h3 class="other-nw">feel free to contact us</h3>
                            </div>
                        </div>
                        <!-- // Social media login  -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <!-- // Login model -->
@endsection
