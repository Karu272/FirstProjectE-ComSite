@extends('layouts.front_layout.front_layout')
@section('content')
    <!-- banner -->
    <div class="banner10" id="home1">
        <div class="container">
            <h2>About<i>Us</i></h2>
        </div>
    </div>
    <!-- //banner -->

    <!-- breadcrumbs -->
    <div class="breadcrumb_dress">
        <div class="container">
            <ul>
                <li><a href="{{ URL('/') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a>
                    <i>/ About Us</i>
                </li>
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
                    <!-- // Third -->
                </div>
                <!-- /sidebar -->

                <!-- Content -->
                <div class="w3ls_dresses_grid_right_grid3">
                    @foreach ($getInfo as $info)
                        <div class="modal-header">
                            <h3 class="faqInner">{{ $info['title'] }}</h3>
                        </div>
                        <h4 class="faqMargin">{{ $info['text'] }}
                            <div class="footer">
                                <button class="trance">
                                    <p style="margin-top: 14px"><a class="item_add"
                                            href="{{ URL('/') }}">Back</a></p>
                                </button>
                            </div>
                    @endforeach
                </div>
                <!-- // content -->
            </div>
        </div>
    </div>
@endsection
