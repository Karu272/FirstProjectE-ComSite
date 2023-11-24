@extends('layouts.front_layout.front_layout')
@section('content')
    <!-- banner -->
    <div class="banner10" id="home1">
        <div class="container">
            <h2>Account Page</h2>
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
                        Update your details</h4>
                </div>
                <div class="modal-body modal-body-sub">
                    <div class="row">
                        <div class="col-md-8 modal_body_left modal_body_left1"
                            style="border-right: 1px dotted #C2C2C2;padding-right:3em;">
                            <div class="sap_tabs">
                                <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
                                    <ul>
                                        <li class="resp-tab-item" aria-controls="tab_item-0"><span>Update details</span>
                                        </li>
                                        <li class="resp-tab-item" aria-controls="tab_item-1"><span>Update password</span>
                                        </li>
                                    </ul>
                                    <!-- // Form + header  -->
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
                                    <!-- Sign in -->
                                    <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
                                        <div class="facts">
                                            <div class="register">
                                                <form id="accountForm" action="{{ URL('/account') }}" method="post">@csrf
                                                    <input style="margin-bottom: 10px" for="name" placeholder="Name"
                                                        name="name" id="name" type="text" required=""
                                                        value="{{ $userDetails['name'] }}">
                                                    <input style="margin-bottom: 10px" for="address" placeholder="Address"
                                                        name="address" id="address" type="text" required=""
                                                        value="{{ $userDetails['address'] }}">
                                                    <input style="margin-bottom: 10px" for="city" placeholder="City"
                                                        name="city" id="city" type="text" required=""
                                                        value="{{ $userDetails['city'] }}">
                                                    <input style="margin-bottom: 10px" for="province" placeholder="Province"
                                                        name="province" id="province" type="text" required=""
                                                        value="{{ $userDetails['province'] }}">
                                                    <div class="custom-select" style="width:260px;">
                                                        <select style="" name="country" id="country">
                                                            <option value="">- Select Country -</option>
                                                            @foreach ($countries as $country)
                                                                <option value="{{ $country['country_name'] }}" @if ($country['country_name'] == $userDetails['country']) selected="" @endif>
                                                                    {{ $country['country_name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <input style="margin-bottom: 10px" for="pincode" placeholder="Pincode"
                                                        name="pincode" id="pincode" type="text" required=""
                                                        value="{{ $userDetails['pincode'] }}">
                                                    <input style="margin-bottom: 10px" for="mobile" placeholder="Mobile"
                                                        name="mobile" id="mobile" type="text" required=""
                                                        value="{{ $userDetails['mobile'] }}">
                                                    <input style="margin-bottom: 10px" for="email" placeholder="Email"
                                                        name="email" id="email" type="text" readonly=""
                                                        value="{{ $userDetails['email'] }}">
                                                    <div class="sign-up">
                                                        <input type="submit" value="Uppdate Details" />
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- // Sign in -->
                                    <!-- Registrate -->
                                    <div class="tab-2 resp-tab-content" aria-labelledby="tab_item-1">
                                        <div class="facts">
                                            <div class="register">
                                                <form id="passwordForm" action="{{ URL('/update-user-pwd') }}"
                                                    method="post">@csrf
                                                    <input for="current_pwd" placeholder="Current Password"
                                                        name="current_pwd" id="current_pwd" type="password" required=""><br>
                                                    <span id="chkPwd"></span>
                                                    <input for="new_pwd" placeholder="New Password" name="new_pwd"
                                                        id="new_pwd" type="password" required="">
                                                    <input for="confirm_pwd" placeholder="Confirm Password"
                                                        name="confirm_pwd" id="confirm_pwd" type="password" required="">
                                                    <div class="sign-up">
                                                        <input type="submit" value="Uppdate Password" />
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
                                ></div>
                            <!--// Script  -->
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
