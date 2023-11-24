<?php use App\Models\Product; ?>
@extends('layouts.front_layout.front_layout')
@section('content')
    <!-- banner -->
    <div class="banner10" id="home1">
        <div class="container">
            <h2>Your Orders Details</h2>
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
                <li>Your orders Details</li>
            </ul>
        </div>
    </div>
    <!-- //breadcrumbs -->
    <div class="checkout">
        <div class="container">

            <h3> Order #{{ $orderDetails['id'] }} Details</h3>
            <hr class="soft" />

            <div class="row">
                <div class="span4">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td colspan="2"><strong>Order Details</strong></td>
                        </tr>
                        <tr>
                            <td>Order Date</td>
                            <td>{{ date('d-m-Y', strtotime($orderDetails['created_at'])) }}</td>
                        </tr>
                        <tr>
                            <td>Order Status</td>
                            <td>{{ $orderDetails['order_status'] }}</td>
                        </tr>
                        @if (!empty($orderDetails['courier_name']))
                            <tr>
                                <td>Courier Name</td>
                                <td>{{ $orderDetails['courier_name'] }}</td>
                            </tr>
                        @endif
                        @if (!empty($orderDetails['tracking_number']))
                            <tr>
                                <td>Tracking Number</td>
                                <td>{{ $orderDetails['tracking_number'] }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td>Order Total</td>
                            <td>{{ $orderDetails['grand_total'] }}.Php</td>
                        </tr>
                        <tr>
                            <td>Shipping Charges</td>
                            <td>{{ $orderDetails['shipping_charges'] }}.Php</td>
                        </tr>
                        <tr>
                            <td>Coupon Code</td>
                            <td>{{ $orderDetails['coupon_code'] }}</td>
                        </tr>
                        <tr>
                            <td>Coupon Amount</td>
                            <td>{{ $orderDetails['coupon_amount'] }}</td>
                        </tr>
                        <tr>
                            <td>Payment Method</td>
                            <td>{{ $orderDetails['payment_method'] }}</td>
                        </tr>
                    </table>
                </div>
                <div class="span4">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td colspan="2"><strong>Delivery Address</strong></td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>{{ $orderDetails['name'] }}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{{ $orderDetails['address'] }}</td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>{{ $orderDetails['city'] }}</td>
                        </tr>
                        <tr>
                            <td>Province</td>
                            <td>{{ $orderDetails['province'] }}</td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>{{ $orderDetails['country'] }}</td>
                        </tr>
                        <tr>
                            <td>Pincode</td>
                            <td>{{ $orderDetails['pincode'] }}</td>
                        </tr>
                        <tr>
                            <td>Mobile</td>
                            <td>{{ $orderDetails['mobile'] }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>Product Image</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Product Color</th>
                            <th>Product Qty</th>
                        </tr>
                    </thead>
                    @foreach ($orderDetails['orders_products'] as $product)
                        <tbody>
                            <tr>
                                <td>
                                    <?php $getProductImage =
                                    Product::getProductImage($product['product_id']); ?>
                                    <a target="_blank" href="{{ url('product/' . $product['product_id']) }}"><img
                                            style="width: 80px;"
                                            src="{{ asset('images/product_images/small/' . $getProductImage) }}"></a>
                                </td>
                                <td>{{ $product['product_code'] }}</td>
                                <td>{{ $product['product_name'] }}</td>
                                <td>{{ $product['product_color'] }}</td>
                                <td>{{ $product['product_qty'] }}</td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
