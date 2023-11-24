@extends('layouts.front_layout.front_layout')
@section('content')
    <?php use App\Models\Product; ?>
    @include('front.banners.index_top_banner')
    <!-- breadcrumbs -->
    <div class="breadcrumb_dress">
        <div class="container">
            <ul>
                <li><a href="{{ URL('/') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a>
                    <i>/</i>
                </li>
            </ul>
        </div>
    </div>
    <!-- //breadcrumbs -->
    <div class="banner-bottom">
        <div class="container">
            @include('front.banners.index_videoImg_banner')
            <!-- Product random display -->
            <div class="col-md-7 wthree_banner_bottom_right">
                <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab"
                                aria-controls="home">Some Of Our Exclusive Products</a></li>
                        <li role="presentation"><a href="#skirts" role="tab" id="skirts-tab" data-toggle="tab"
                                aria-controls=""></a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
                            <div class="agile_ecommerce_tabs">
                                <!--1-->
                                @foreach ($randomProducts as $product)
                                    <div class="col-md-4 agile_ecommerce_tab_left">
                                        <div class="hs-wrapper">
                                            @if (isset($product['product_image']))
                                                <?php $product_image_path = 'images/product_images/small/' .
                                                $product['product_image']; ?>
                                            @else
                                                <?php $product_image_path = ''; ?>
                                            @endif
                                            @if (!empty($product['product_image']) && file_exists($product_image_path))
                                                <a href="{{ URL('product/' . $product['id']) }}">
                                                    <img src="{{ asset('images/product_images/small/' . $product['product_image']) }}"
                                                        alt=" " class="img-responsive" /></a>
                                            @else
                                                <img src="{{ asset('images/product_images/noimg.jpg') }}" alt=" "
                                                    class="img-responsive" />
                                            @endif
                                        </div>
                                        <h5 style="margin-bottom: 10px"><a
                                                href="{{ URL('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                        </h5>
                                        <p>from</p>
                                        <ul style="margin-top: 10px"><a>{{ $product['brand']['name'] }}</a></ul>
                                        <?php $discounted_price =
                                        Product::getDiscountedPrice($product['id']); ?>
                                        <div class="simpleCart_shelfItem">
                                            @if ($discounted_price > 0)
                                                <del>{{ $product['product_price'] }}.Php</del>
                                            @else
                                                <div>
                                                    <h4>{{ $product['product_price'] }}.Php</h4>
                                                </div>
                                            @endif
                                            @if ($discounted_price > 0)
                                                <h4>{{ $discounted_price }}.Php</h4>
                                            @endif
                                            <button class="trance">
                                                <p style="margin-top: 14px"><a class="item_add"
                                                        href="{{ URL('product/' . $product['id']) }}">View Item</a></p>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                                <!--end-->
                                <div class="clearfix"> </div>
                            </div>
                        </div>
                        <!--here-->
                    </div>
                </div>
            </div>
            <!-- products random display -->
        </div>
    </div>
    @include('front.banners.home_page_banners')
    @include('front.banners.index_bottomLeftImg')
    <!-- new-products -->
    <div class="new-products">
        <div class="container">
            <div class="agileinfo_new_products_grids">
                <div class="clearfix"></div>
                <h3>New Products</h3>
                @foreach ($newProducts as $product)
                    <div class="col-md-3 agile_ecommerce_tab_left">
                        <div class="hs-wrapper">
                            <!-- For some reason pic doesn't exist -->
                            @if (isset($product['product_image']))
                                <?php $product_image_path = 'images/product_images/small/' .
                                $product['product_image']; ?>
                            @else
                                <?php $product_image_path = ''; ?>
                            @endif
                            @if (!empty($product['product_image']) && file_exists($product_image_path))
                                <a href="{{ URL('product/' . $product['id']) }}">
                                    <img style="width: 100%" src="{{ asset($product_image_path) }}" alt=""></a>
                            @else
                                <img style="width: 100%" src="{{ asset('images/product_images/noimg.jpg') }}" alt="">
                            @endif
                        </div>
                        <h5 style="margin-bottom: 10px"><a
                                href="{{ URL('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                        </h5>
                        <p>from</p>
                        <ul style="margin-top: 10px"><a>{{ $product['brand']['name'] }}</a></ul>
                        <?php $discounted_price = Product::getDiscountedPrice($product['id']); ?>
                        <div class="simpleCart_shelfItem">

                            @if ($discounted_price > 0)
                                <del>{{ $product['product_price'] }}.Php</del>
                            @else
                                <div>
                                    <h4>{{ $product['product_price'] }}.Php</h4>
                                </div>
                            @endif

                            @if ($discounted_price > 0)
                                <h4>{{ $discounted_price }}.Php</h4>
                            @endif

                            <button class="trance">
                                <p style="margin-top: 14px"><a class="item_add"
                                        href="{{ URL('product/' . $product['id']) }}">View Item</a></p>
                            </button>
                        </div>
                    </div>
                @endforeach
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!-- //new-products -->
@endsection
