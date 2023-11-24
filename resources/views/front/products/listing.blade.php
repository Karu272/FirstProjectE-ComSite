@extends('layouts.front_layout.front_layout')
@section('content')
    <?php use App\Models\Product;
    ?>
    <!-- banner -->
    <div class="banner10" id="home1">
        <div class="container">
            <h2>Cosmetics<span>Make</span>Us<i>Shine like Stars</i></h2>
        </div>
    </div>
    <!-- //banner -->
    <!-- breadcrumbs -->
    <div class="breadcrumb_dress">
        <div class="container">
            <ul>
                <li><a href="{{ URL('/') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a>
                    <i>/</i>
                </li>
                <li><?php echo $categoryDetails['breadcrumbs']; ?></li>
            </ul>
        </div>
    </div>
    <!-- /breadcrumbs -->
    <!-- sidebar -->
    <div class="dresses">
        <div class="container">
            <div class="w3ls_dresses_grids">

                <div class="col-md-4 w3ls_dresses_grid_left">
                    <div class="w3ls_dresses_grid_left_grid">
                        <h3>Sections</h3>
                        <div class="w3ls_dresses_grid_left_grid_sub">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <!-- start -->
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-title asd">
                                            <a class="pa_italic" role="button" data-toggle="collapse"
                                                data-parent="#accordion" href="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span><i
                                                    class="glyphicon glyphicon-minus" aria-hidden="true"></i>New Arrivals
                                            </a>
                                        </h4>
                                    </div>
                                    <!-- dropdown end -->
                                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                                        aria-labelledby="headingOne">
                                        <div class="panel-body panel_text">
                                            @foreach ($newProducts as $product)
                                                <ul>
                                                    <li><a
                                                            href="{{ URL('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- finish -->
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingTwo">
                                        <h4 class="panel-title asd">
                                            <a class="pa_italic collapsed" role="button" data-toggle="collapse"
                                                data-parent="#accordion" href="#collapseTwo" aria-expanded="false"
                                                aria-controls="collapseTwo">
                                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span><i
                                                    class="glyphicon glyphicon-minus" aria-hidden="true"></i>Categories
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
                                        aria-labelledby="headingTwo">
                                        <div class="panel-body panel_text">
                                            @foreach ($sideBarCategories as $category)
                                                <ul>
                                                    <li><a
                                                            href="{{ $category['url'] }}">{{ $category['category_name'] }}</a>
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="panel_bottom">
                                <li><a href="#">Summer Store</a></li>
                                <li><a href="#">New In Clothing</a></li>
                                <li><a href="#">New In Shoes</a></li>
                                <li><a href="#">Latest Watches</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Second -->
                    <div class="w3ls_dresses_grid_left_grid">
                        <h3>Brands</h3>
                        <div class="w3ls_dresses_grid_left_grid_sub">
                            <div class="ecommerce_color">
                                @foreach ($sideBarBrands as $brands)
                                    <ul class="panel_bottom">
                                        <span type="button" data-toggle="modal"
                                            data-target="#myModal{{ $brands['id'] }}"><a>¤ {{ $brands['name'] }}
                                                ¤</a></span>
                                        <!-- Modal -->
                                        <div class="modal" id="myModal{{ $brands['id'] }}" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" id="{{ $brands['id'] }}">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 style="margin-top: 20px">{{ $brands['name'] }}</h3>
                                                    </div>
                                                    <br>
                                                    <h4 style="margin: 20px 20px 20px 20px">{{ $brands['description'] }}
                                                    </h4>
                                                    <!-- For some reason pic doesn't exist -->
                                                    @if (isset($brands['brand_logo']))
                                                        <?php $brand_image_path = 'images/brand_logos/' .
                                                        $brands['brand_logo']; ?>
                                                    @else
                                                        <?php $brand_image_path = ''; ?>
                                                    @endif
                                                    @if (!empty($brands['brand_logo']) && file_exists($brand_image_path))
                                                        <img style="width: 300px; margin-left: 20px;"
                                                            src="{{ asset('images/brand_logos/' . $brands['brand_logo']) }}"
                                                            alt=" " class="img-responsive" />
                                                    @else
                                                        <img style="width: 300px; margin-left: 20px;"
                                                            src="{{ asset('images/product_images/noimg.jpg') }}" alt=" "
                                                            class="img-responsive" />
                                                    @endif
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </ul>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Third -->
                    <!-- <div class="w3ls_dresses_grid_left_grid">
                            <h3>Something</h3>
                            <div class="w3ls_dresses_grid_left_grid_sub">
                                <div class="ecommerce_color ecommerce_size">
                                    <ul>
                                        <li><a href="#">Medium</a></li>
                                        <li><a href="#">Large</a></li>
                                        <li><a href="#">Extra Large</a></li>
                                        <li><a href="#">Small</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div> -->
                </div>
                <!-- /sidebar -->
                <!-- banner -->
                <div class="col-md-8 w3ls_dresses_grid_right">
                    <div class="col-md-6 w3ls_dresses_grid_right_left">
                        <div class="w3ls_dresses_grid_right_grid1">
                                <img src="{{ asset('images/banner_images/' . $getListleftImg['listleftImg']) }}" alt=" " class="img-responsive" />
                                <div class="w3ls_dresses_grid_right_grid1_pos1">
                                    <h3>{{$getListleftImg['first']}}<span>{{$getListleftImg['second']}}</span>{{$getListleftImg['third']}}</h3>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-6 w3ls_dresses_grid_right_left">
                        <div class="w3ls_dresses_grid_right_grid1">
                            <img src="{{ asset('images/banner_images/' . $getListrightImg['listrightImg']) }}" alt=" " class="img-responsive" />
                            <div class="w3ls_dresses_grid_right_grid1_pos">
                                <h3>{{$getListrightImg['first']}}<span>{{$getListrightImg['second']}}</span>{{$getListrightImg['third']}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                    <!-- /banner -->
                    <!-- sort panel -->
                    <div class="w3ls_dresses_grid_right_grid2">
                        <div class="w3ls_dresses_grid_right_grid2_left">
                            <!--Pagination -->
                            <div class="pagination">
                                @if (isset($_GET['sort']) && !empty($_GET['sort']))
                                    <h3>{{ $categoryProducts->appends(['sort' => $_GET['sort']])->links() }}</h3>
                                @else
                                    <h3>{{ $categoryProducts->links() }}</h3>
                                @endif
                            </div>
                        </div>
                        <!--//Pagination -->
                        <form name="sortProducts" id="sortProducts">
                            <div class="w3ls_dresses_grid_right_grid2_right">
                                <select name="sort" id="sort" class="select_item">
                                    <option value="">Default Sorting</option>
                                    <option value="product_latest" @if (isset($_GET['sort']) && $_GET['sort'] == 'product_latest') selected="" @endif>Latest Products</option>
                                    <option value="product_name_a_z" @if (isset($_GET['sort']) && $_GET['sort'] == 'product_name_a_z') selected="" @endif>Name A - Z</option>
                                    <option value="product_name_z_a" @if (isset($_GET['sort']) && $_GET['sort'] == 'product_name_z_a') selected="" @endif>Name Z - A</option>
                                    <option value="price_lowest" @if (isset($_GET['sort']) && $_GET['sort'] == 'price_lowest') selected="" @endif>Lowst Price</option>
                                    <option value="price_higest" @if (isset($_GET['sort']) && $_GET['sort'] == 'price_higest') selected="" @endif>Highest Price</option>
                                </select>
                            </div>
                        </form>
                        <div class="clearfix"> </div>
                    </div>
                    <!-- /sort panel -->
                    <!-- Product -->
                    @foreach ($categoryProducts as $product)
                        <div class="w3ls_dresses_grid_right_grid3">
                            <div class="col-md-4 agileinfo_new_products_grid agileinfo_new_products_grid_dresses">
                                <div class="agile_ecommerce_tab_left dresses_grid">
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
                                                <img src="{{ asset('images/product_images/small/' . $product['product_image']) }}"
                                                    alt=" " class="img-responsive" /></a>
                                        @else
                                            <img src="{{ asset('images/product_images/noimg.jpg') }}" alt=" "
                                                class="img-responsive" />
                                        @endif
                                        <div class="">
                                        </div>
                                    </div>
                                    <h5 style="margin-bottom: 14px"><a
                                            href="{{ URL('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                    </h5>
                                    <p>from</p>
                                    <ul style="margin-top: 14px"><a
                                            href="{{ URL('product/' . $product['id']) }}">{{ $product['brand']['name'] }}</a>
                                    </ul>
                                    <?php $discounted_price = Product::getDiscountedPrice($product['id']);
                                    ?>
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
                            </div>
                        </div>
                    @endforeach
                    <!--/ Product -->
                </div><!-- //banner -->
            </div>
        </div>
    </div><!-- //sidebar -->
    <!-- Bottom slider -->
    <div class="w3l_related_products">
        <div class="container">
            <h3>Related Products</h3>
            @foreach ($featuredItemsChunk as $key => $featuredItem)
                <ul id="flexiselDemo2">
                    @foreach ($featuredItem as $item)
                        <li>
                            <div class="w3l_related_products_grid">
                                <div class="agile_ecommerce_tab_left dresses_grid">
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
                                                <img src="{{ asset('images/product_images/small/' . $item['product_image']) }}"
                                                    alt=" " class="img-responsive" /></a>
                                        @else
                                            <img src="{{ asset('images/product_images/noimg.jpg') }}" alt=" "
                                                class="img-responsive" />
                                        @endif
                                    </div>
                                    <h5 style="margin-bottom: 20px"><a
                                            href="{{ URL('product/' . $product['id']) }}">{{ $item['product_name'] }}</a>
                                    </h5>
                                    <p>from</p>
                                    <ul style="margin-top: 20px"><a>{{ $product['brand']['name'] }}</a></ul>
                                    <div class="simpleCart_shelfItem">
                                        @if ($discounted_price > 0)
                                            <del>{{ $item['product_price'] }}.Php</del>
                                        @else
                                            <div style="margin-top: 14px; margin-bottom: 5px">
                                                <h4>{{ $item['product_price'] }}.Php</h4>
                                            </div>
                                        @endif
                                        @if ($discounted_price > 0)
                                            <h4>{{ $discounted_price }}.Php</h4>
                                        @endif
                                        <button class="trance">
                                            <p style="margin-top: 20px"><a class="item_add"
                                                    href="{{ URL('product/' . $product['id']) }}">View Item</a></p>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endforeach
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
@endsection
