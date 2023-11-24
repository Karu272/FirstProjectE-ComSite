<?php use App\Models\Product; ?>
@extends('layouts.front_layout.front_layout')
@section('content')
    <!-- banner -->
    <div class="banner10" id="home1">
        <div class="container">
            <h2>Checkout</h2>
        </div>
    </div>
    <!-- //banner -->
    <!-- breadcrumbs -->
    <div class="breadcrumb_dress">
        <div class="container">
            <ul>
                <li><a href="{{ URL('/') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a>
                    <i>/</i></li>
                <li>Checkout</li>
            </ul>
        </div>
    </div>
    <!-- //breadcrumbs -->
    <div class="checkout">
        <div class="container">
            <div class="span9">
                <hr class="soft" />
                @if (Session::has('success_message'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php Session::forget('success_message'); ?>
                @endif
                @if (Session::has('error_message'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('error_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php Session::forget('error_message'); ?>
                @endif
                <form name="checkoutForm" id="checkoutForm" action="{{ url('/checkout') }}" method="post">@csrf
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                        <tr>
                            <td class="invert"> <strong>DELIVERY ADDRESSES</strong></td>
                            <td class="invert"><a href="{{ url('add-edit-delivery-address') }}">Add</a> </td>
                        </tr>
                        @foreach ($deliveryAddresses as $address)
                            <tr>
                                <td class="invert">
                                    <div class="control-group" style="float:left; margin-top: -2px; margin-right: 5px;">
                                        <input type="radio" id="address{{ $address['id'] }}" name="address_id"
                                            value="{{ $address['id'] }}" shipping_charges="{{ $address['shipping_charges']}}" total_price="{{ $total_price }}" coupon_amount="{{ Session::get('couponAmount') }}">
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">{{ $address['name'] }}, {{ $address['address'] }},
                                            {{ $address['city'] }}-{{ $address['pincode'] }},
                                            {{ $address['province'] }}, {{ $address['country'] }}
                                            ({{ $address['mobile'] }})</label>
                                    </div>
                                </td>
                                <td class="invert"><a
                                        href="{{ url('/add-edit-delivery-address/' . $address['id']) }}">Edit</a> | <a
                                        href="{{ url('/delete-delivery-address/' . $address['id']) }}"
                                        class="addressDelete">Delete</a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>SL No.</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Weight</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total_price = 0; ?>
                            @foreach ($userCartItems as $item)
                                <?php $attrPrice = Product::getDiscountedAttrPrice($item['product_id']); ?>
                                <tr>
                                    <td class="invert">{{ $item['product']['product_code'] }}</td>
                                    @if (isset($item['product']['product_image']))
                                        <?php $product_image_path = 'images/product_images/small/' .
                                        $item['product']['product_image']; ?>
                                    @else
                                        <?php $product_image_path = ''; ?>
                                    @endif
                                    @if (!empty($item['product']['product_image']) && file_exists($product_image_path))
                                        <td class="invert-image"><a><img style="width: 50px;"
                                                    src="{{ asset('images/product_images/small/' . $item['product']['product_image']) }}"
                                                    alt=" " class="img-responsive" /></a></td>
                                    @else
                                        <td class="invert-image"><a><img style="width: 50px;"
                                                    src="{{ asset('images/product_images/noimg.jpg') }}" alt=" "
                                                    class="img-responsive" /></a></td>
                                    @endif
                                    <td class="invert">
                                        <div class="quantity">
                                            <div class="quantity-select">
                                                <input style="max-width: 24px; text-align:center" type="text"
                                                    value="{{ $item['quantity'] }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="invert">{{ $attrPrice['product_price'] }}.Php</td>
                                    <td class="invert">{{ $item['product']['product_weight'] }}.g</td>
                                </tr>
                                <?php $total_price = $total_price + $attrPrice['final_price'] *
                                $item['quantity']; ?>
                            @endforeach
                            <tr>
                                <td colspan="4" style="text-align:center" class="invert">Sub Total: </td>
                                <td colspan="4" class="invert">{{ $total_price }}.Php</td>
                            </tr>
                            <tr>
                                <td class="invert" colspan="4" style="text-align:center">Coupon Discount: </td>
                                <td class="couponAmount">
                                    @if (Session::has('couponAmount'))
                                        -{{ Session::get('couponAmount') }}.Php
                                    @else
                                        0.php
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="invert" colspan="4" style="text-align:center">Shipping Charges: </td>
                                <td class="shipping_charges"> 0.php </td>
                            </tr>
                            <tr>
                                <td class="invert" colspan="4" style="text-align:center"><strong>GRAND TOTAL
                                        ({{ $total_price }} -  <span class="couponAmount"> 0 </span> + <span class="shipping_charges">0 .Php</span> ) =</strong>
                                </td>
                                <td class="invert label label-important" style="display:block"> <strong class="grand_total">
                                        {{ $grand_total = $total_price - Session::get('couponAmount') }} .Php
                                        <?php Session::put('grand_total', $grand_total); ?>
                                    </strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                    <table class="timetable_sub">
                        <tbody>
                            <tr>
                                <td class="invert">
                                    <div class="control-group">
                                        <label class="control-label"><strong> PAYMENT METHODS: </strong> </label>
                                        <div class="controls">
                                            <span>
                                                <input type="radio" name="payment_gateway" id="COD"
                                                    value="COD"><strong>COD</strong>&nbsp;&nbsp;
                                                    <input type="radio" name="payment_gateway" id="Paypal"
                                                    value="Paypal">&nbsp;&nbsp;<img style="width: 50px" src="{{ asset('images/credit/paypal.png') }}" alt="">
                                            </span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-large pull-right">Place Order <i
                            class="icon-arrow-right"></i></button>
                </form>
            </div>
        </div>
    </div>
@endsection
