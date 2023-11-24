@extends('layouts.front_layout.front_layout')
@section('content')

<!-- banner -->
   <div class="banner10" id="home1">
    <div class="container">
        <h2>Your Orders</h2>
    </div>
</div>
<!-- //banner -->

<!-- breadcrumbs -->
<div class="breadcrumb_dress">
    <div class="container">
        <ul>
            <li><a href="{{ URL('/') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a>
                <i>/</i></li>
            <li>Your orders</li>
        </ul>
    </div>
</div>
<!-- //breadcrumbs -->
<div class="checkout">
    <div class="container">
        <h3>Here is your ordered <span class="totalCartItems">Products</span></h3>

        <div class="table-responsive">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Order ID</th>
                        <th scope="col">Order Products</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Grand Total</th>
                        <th scope="col">Created On</th>                        
                        <th scope="col">Shipping Details</th>
                    </tr>
                </thead>
                    @foreach ($orders as $order)
                    <tbody>
                        <tr>
                            <td scope="row"><a href="{{ url('orders/' . $order['id']) }}">{{ $order['id'] }}</a></td>
                            <td>
                                @foreach ($order['orders_products'] as $pro)
                                    {{ $pro['product_code'] }}<br>
                                @endforeach
                            </td>
                            <td>{{ $order['payment_method'] }}</td>
                            <td>{{ $order['grand_total'] }}.Php</td>
                            <td>{{ date('d-m-Y', strtotime($order['created_at'])) }}
                            </td>
                            <td><a style="text-decoration: underline;" href="{{ url('orders/' . $order['id']) }}">View
                                    Details</a></td>
                        </tr>
                    </tbody>
                    @endforeach
             </table>
        </div>    
    </div>
</div>
</div>
@endsection
