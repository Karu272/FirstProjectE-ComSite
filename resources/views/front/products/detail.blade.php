@extends('layouts.front_layout.front_layout')
@section('content')
    <?php use App\Models\Product; ?>
    <!-- banner -->
    <div class="banner10" id="home1">
        <div class="container">
            <h2>Single Page</h2>
        </div>
    </div>
    <!-- //banner -->
    <!-- breadcrumbs -->
    <div class="breadcrumb_dress">
        <div class="container">
            <ul>
                <li><a href="{{ URL('/') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a>
                    <i>/</i></li>

                <li><a
                        href="{{ URL('/' . $productDetails['category']['url']) }}">{{ $productDetails['category']['category_name'] }}</a>
                    <i>/</i></li>
                <li class="active">{{ $productDetails['product_name'] }}</li>
            </ul>
        </div>
    </div>
    <!-- //breadcrumbs -->
    <!-- single -->
    <div class="single">
        <div class="container">
            <div class="col-md-4 single-left">
                <div class="flexslider">
                    <ul class="slides">
                        @foreach ($productDetails['images'] as $image)
                            <li data-thumb="{{ asset('images/product_images/medium/' . $image['image']) }}">
                                <div class="thumb-image"> <img
                                        src="{{ asset('images/product_images/medium/' . $image['image']) }}"
                                        data-imagezoom="true" class="img-responsive"> </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- flixslider -->
                <script defer src="{{ URL('js/front_js/jquery.flexslider.js') }}"></script>
                <link rel="stylesheet" href="{{ URL('css/front_css/flexslider.css') }}" type="text/css" media="screen" />
                <script>
                    // Can also be used with $(document).ready()
                    $(window).load(function() {
                        $('.flexslider').flexslider({
                            animation: "slide",
                            controlNav: "thumbnails"
                        });
                    });
                </script>
                <!-- flixslider -->
                <!-- zooming-effect -->
                <script src="{{ URL('js/front_js/imagezoom.js') }}"></script>
                <!-- //zooming-effect -->
            </div>
            <div class="col-md-8 single-right">
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
                <h2>{{ $productDetails['product_name'] }}</h2>
                <p>from</p>
                <h3>{{ $productDetails['brand']['name'] }}</h3>
                <div class="rating1">
                    <span class="starRating">
                        <input id="rating5" type="radio" name="rating" value="5">
                        <label for="rating5">5</label>
                        <input id="rating4" type="radio" name="rating" value="4">
                        <label for="rating4">4</label>
                        <input id="rating3" type="radio" name="rating" value="3" checked>
                        <label for="rating3">3</label>
                        <input id="rating2" type="radio" name="rating" value="2">
                        <label for="rating2">2</label>
                        <input id="rating1" type="radio" name="rating" value="1">
                        <label for="rating1">1</label>
                    </span>
                </div>
                <form action="{{ URL('add-to-cart') }}" method="post">@csrf
                    <input type="hidden" name="product_id" value="{{ $productDetails['id'] }}">
                    <div class="description">
                        <h5><i>Description</i></h5>
                        <p>{{ $productDetails['description'] }}</p>
                    </div>
                    <div class="description">
                        <h5><i>Color</i></h5>
                        <p>{{ $productDetails['product_color'] }}</p>

                        <h5><i>Code</i></h5>
                        <p>{{ $productDetails['product_code'] }}</p>

                        <h5><i>Weight</i></h5>
                        <p>{{ $productDetails['product_weight'] }}</p>

                        <h5><i>Products left</i></h5>
                        <p>In stock: {{ $total_stock }}</p>
                    </div>
                    <!-- Quintity start -->
                    <div style="margin-bottom: 20px" class="color-quality">
                        <div class="color-quality-left">
                            <h5>Quantity :</h5>
                            <div class="quantity">
                                <input type="number" name="quantity" required="" class="quantity" placeholder="Qty.">
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <h5 style="margin-bottom: 20px"><i>Price</i></h5>
                    <div class="simpleCart_shelfItem">
                        <?php $discounted_price = Product::getDiscountedPrice($productDetails['id']); ?>
                        @if ($discounted_price > 0)
                            <del>{{ $productDetails['product_price'] }}.Php</del>
                        @else
                            <div style="margin-bottom: 20px">
                                <h4>{{ $productDetails['product_price'] }}.Php</h4>
                            </div>
                        @endif

                        @if ($discounted_price > 0)
                            <h4 style="margin-bottom: 20px">{{ $discounted_price }}.Php</h4>
                        @endif

                        <button class="trance" type="submit">
                            <p><a class="item_add">Add to cart</a></p>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- // single -->
        <!-- review etc -->
        <div class="additional_info">
            <div class="container">
                <div class="sap_tabs">
                    <div id="horizontalTab1" style="display: block; width: 100%; margin: 0px;">
                        <ul>
                            <li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><span>Product Information</span>
                            </li>
                            <li class="resp-tab-item" aria-controls="tab_item-1" role="tab"><span>Reviews</span></li>
                        </ul>
                        <div class="tab-1 resp-tab-content additional_info_grid" aria-labelledby="tab_item-0">
                            <h3>{{ $productDetails['product_name'] }}</h3>
                            <p>{{$productDetails['meta_description']}}</p>
                        </div>

                        <div class="tab-2 resp-tab-content additional_info_grid" aria-labelledby="tab_item-1">
                            <h4>Reviews</h4>
                            @foreach($getReview as $review)
                            <div class="additional_info_sub_grids">
                                <div class="col-xs-2 additional_info_sub_grid_left">
                                    <img src="{{ asset('images/brand_logos/logo-1.png') }}" alt=" " class="img-responsive" />
                                </div>
                                <div class="col-xs-10 additional_info_sub_grid_right">
                                    <div class="additional_info_sub_grid_rightl">
                                        <a href="">{{$review['name']}}</a>
                                        <h5>{{  date('j F, Y, g:i a', strtotime($review['created_at'])) }}</h5>
                                        <p>{{$review['text']}}</p>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            @endforeach
                            @include('front.products.review')
                        </div>
                    </div>
                </div>
                <script src="{{ URL('js/front_js/easyResponsiveTabs.js') }}" type="text/javascript"></script>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#horizontalTab1').easyResponsiveTabs({
                            type: 'default', //Types: default, vertical, accordion
                            width: 'auto', //auto or any width like 600px
                            fit: true // 100% fit in a container
                        });
                    });

                </script>
            </div>
        </div>
        <!-- // review etc -->
        <!-- Bottom slider -->
        <div class="w3l_related_products">
            <div class="container">
                <h3>Related Products</h3>
                <ul id="flexiselDemo2">
                    @foreach ($relatedProducts as $product)
                        <li>
                            <div class="w3l_related_products_grid">
                                <div class="agile_ecommerce_tab_left dresses_grid">
                                    <div class="">
                                        <!-- For some reason pic doesn't exist -->
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
                                    <h5 style="margin-bottom: 20px"><a
                                            href="{{ URL('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                    </h5>
                                    <p>from</p>
                                    <ul style="margin-top: 20px"><a
                                            href="{{ URL('product/' . $product['id']) }}">{{ $productDetails['brand']['name'] }}</a>
                                    </ul>
                                    <?php $discounted_price = Product::getDiscountedPrice($product['id']);
                                    ?>
                                    <div class="simpleCart_shelfItem">

                                        @if ($discounted_price > 0)
                                            <del>{{ $product['product_price'] }}.Php</del>
                                        @else
                                            <div style="margin-top: 20px; margin-bottom: 20px">
                                                <h4>{{ $product['product_price'] }}.Php</h4>
                                            </div>
                                        @endif

                                        @if ($discounted_price > 0)
                                            <h4 style="margin-bottom: 20px">{{ $discounted_price }}.Php</h4>
                                        @endif

                                        <button class="trance" type="submit">
                                            <p style="margin-top: 14px"><a class="item_add"
                                                    href="{{ URL('product/' . $product['id']) }}">View Item</a></p>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <!-- bottom slider script -->
                <script type="text/javascript">
                    $(window).load(function() {
                        $("#flexiselDemo2").flexisel({
                            visibleItems: 4,
                            animationSpeed: 1000,
                            autoPlay: true,
                            autoPlaySpeed: 3000,
                            pauseOnHover: true,
                            enableResponsiveBreakpoints: true,
                            responsiveBreakpoints: {
                                portrait: {
                                    changePoint: 480,
                                    visibleItems: 1
                                },
                                landscape: {
                                    changePoint: 640,
                                    visibleItems: 2
                                },
                                tablet: {
                                    changePoint: 768,
                                    visibleItems: 3
                                }
                            }
                        });

                    });
                </script>
                <script type="text/javascript" src="{{ URL('js/front_js/jquery.flexisel.js') }}"></script>
                <!-- / bottom slider script -->
            </div>
        </div>
        <!-- /bottom slider -->
        <!-- //single -->
    @endsection
