<?php
use App\Models\Section;
$sections = Section::sections();
?>
<!-- header -->
<div class="header">
    <div class="container">
        <div class="w3l_login">
            @if (Auth::check())
                <a href="{{ URL('account') }}"><span class="glyphicon glyphicon-user" aria-hidden="true"> </a>
                <a href="{{ URL('logout') }}"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></a>
                <a href="{{ URL('orders') }}"><span class="glyphicon glyphicon-gift" aria-hidden="true"></a>
            @else
                <a href="{{ URL('login-register') }}"><span class="glyphicon glyphicon-log-in"
                        aria-hidden="true"></span></a>
            @endif
        </div>
        <div class="w3l_logo">
            <h1><a href="{{URL('/')}}">Rayeallistic<span>Always high quality</span></a></h1>
        </div>
        <div class="cart box_1">
            <a href="{{ '/cart' }}">
                <div class="total">
                    <span class="totalCartItems">Total: [ {{ totalCartItems() }} ] items in cart</span>
                </div>
                <img src="{{ asset('images/front_images/bag.png') }}" alt="" />
            </a>
            <p><a href="{{ '/cart' }}" class="simpleCart_empty">To Cart</a></p>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<div class="navigation">
    <div class="container">
        <nav class="navbar navbar-default">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header nav_2">
                <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse"
                    data-target="#bs-megadropdown-tabs">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="/" class="act">Home</a></li>
                    <!-- Mega Menu -->
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown">Products <b class="caret"></b></a>
                        <ul class="dropdown-menu multi-column columns-3">
                            <div class="row">
                                @foreach ($sections as $section)
                                    <div class="col-sm-3">
                                        <ul class="multi-column-dropdown">
                                            <h6>{{ $section['name'] }}</h6>
                                            <li class="devider"></li>
                                            @foreach ($section['categories'] as $category)
                                                <li class="devider"></li>
                                                <li><a
                                                        href="{{ $category['url'] }}">{{ $category['category_name'] }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                                <div class="col-sm-3">
                                    <div class="w3ls_products_pos">
                                    @foreach($getddImg as $ddImg)
                                        <h4>{{$ddImg['first']}}<i>{{$ddImg['second']}}</i></h4>
                                        <img src="{{ asset('images/banner_images/' . $ddImg['ddImg']) }}" alt=" "
                                            class="img-responsive" />
                                    @endforeach
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </ul>
                    </li>
                    <li><a href="{{URL('aboutUs')}}">About Us</a></li>
                    <li><a href="{{URL('contactUs')}}">Contact Us</a></li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- //header -->
