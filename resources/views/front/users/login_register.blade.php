@extends('layouts.front_layout.front_layout')
@section('content')
    <!-- banner -->
    <div class="banner10" id="home1">
        <div class="container">
            <h2>Login Page</h2>
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
                        Don't Wait, Login now!</h4>
                </div>
                <div class="modal-body modal-body-sub">
                    <div class="row">
                        <div class="col-md-8 modal_body_left modal_body_left1"
                            style="border-right: 1px dotted #C2C2C2;padding-right:3em;">
                            <div class="sap_tabs">
                                <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
                                    <ul>
                                        <li class="resp-tab-item" aria-controls="tab_item-0"><span>Sign in</span></li>
                                        <li class="resp-tab-item" aria-controls="tab_item-1"><span>Sign up</span></li>
                                    </ul>
                                    <!-- // Form + header  -->
                                    <!-- Sign in -->
                                    <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
                                        <div class="facts">
                                            <div class="register">
                                                <form action="{{ URL('/login') }}" id="loginForm" method="post">@csrf
                                                    <input for="email" name="email" id="email" placeholder="Email Address"
                                                        type="text" required="">
                                                    <input for="password" name="password" id="password"
                                                        placeholder="Password" type="password" required="">
                                                    <div class="sign-up">
                                                        <input type="submit" value="Sign in" />
                                                        <a href="{{ URL('forgot-password') }}">Forgot your password?</a>
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
                                    {{ Session::forget('success_message') }}
                                    <!-- Registrate -->
                                    <div class="tab-2 resp-tab-content" aria-labelledby="tab_item-1">
                                        <div class="facts">
                                            <div class="register">
                                                <form id="registerForm" action="{{ URL('/register') }}" method="post">@csrf
                                                    <input for="name" placeholder="Name" name="name" id="name" type="text"
                                                        required="">
                                                    <input for="email" placeholder="Email Address" id="email" name="email"
                                                        type="email" required="">
                                                    <input placeholder="Password" name="password" id="password"
                                                        type="password" required="">
                                                    <input placeholder="Confirm Password" name="conPassword"
                                                        id="conPassword" type="password" required="">
                                                    <div class="sign-up">
                                                        <input type="submit" value="Create Account" />
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Registrate -->
                                </div>
                            </div>
                            <!-- Script  -->
                            <script src="{{ URL('js/front_js/easyResponsiveTabs.js') }}" type="text/javascript"></script>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    $('#horizontalTab').easyResponsiveTabs({
                                        type: 'default', //Types: default, vertical, accordion
                                        width: 'auto', //auto or any width like 600px
                                        fit: true // 100% fit in a container
                                    });
                                });
                            </script>
                            <div id="OR" class="hidden-xs">
                                OR</div>
                            <!--// Script  -->
                        </div>
                        <!-- Social media login  -->
                        <div class="col-md-4 modal_body_right modal_body_right1">
                            <div class="row text-center sign-with">
                                <div class="col-md-12">
                                    <h3 class="other-nw">
                                        Sign in with</h3>
                                </div>
                                <div class="col-md-12">
                                    <ul class="social">
                                        <li class="social_facebook"><a href="#" class="entypo-facebook"></a></li>
                                        <li class="social_dribbble"><a href="#" class="entypo-dribbble"></a></li>
                                        <li class="social_twitter"><a href="#" class="entypo-twitter"></a></li>
                                        <li class="social_behance"><a href="#" class="entypo-behance"></a></li>
                                    </ul>
                                </div>
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
{{ Session::forget('success_message') }}
{{ Session::forget('error_message') }}
@endsection
