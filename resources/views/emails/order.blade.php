<html>

<body>
    <table style="width: 700px">
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><img style="width: 120px" src="{{ asset('images/front_images/logo-1.png') }}" alt=""></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Hello {{ $name }},</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Thank you for shopping with us. Your order details are as below:- </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Order no: {{ $order_id }}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <table style="width: 95%" cellpadding="5" cellpadding="5" bgcolor="#f7f4f4">
                    <tr bgcolor="#cccccc">
                        <td>Name</td>
                        <td>Code</td>
                        <td>Color</td>
                        <td>Quantity</td>
                        <td>Price</td>
                    </tr>
                    @foreach ($orderDetails['orders_products'] as $order)
                    <tr>
                        <td>{{$order['product_name']}}</td>
                        <td>{{$order['product_code']}}</td>
                        <td>{{$order['product_color']}}</td>
                        <td>{{$order['product_qty']}}</td>
                        <td>{{$order['product_price']}} Php</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" align="right"></td>
                        <td>------------------</td>
                    </tr>
                    <tr>
                        <td colspan="4" align="right">Shipping Charges</td>
                        <td>{{$orderDetails['shipping_charges']}} Php</td>
                    </tr>
                    <tr>
                        <td colspan="4" align="right">Coupon Discount</td>
                        <td>
                            @if($orderDetails['coupon_amount'] > 0)
                                {{$orderDetails['coupon_amount']}}
                            @else
                                0
                            @endif
                        Php</td>
                    </tr>
                    <tr>
                        <td colspan="4" align="right">Grand Total</td>
                        <td>{{$orderDetails['grand_total']}} Php</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td><strong>Delivery Address :-</strong></td>
                    </tr>
                    <tr>
                        <td>{{$orderDetails['name']}}</td>
                    </tr>
                    <tr>
                        <td>{{$orderDetails['address']}}</td>
                    </tr>
                    <tr>
                        <td>{{$orderDetails['city']}}</td>
                    </tr>
                    <tr>
                        <td>{{$orderDetails['province']}}</td>
                    </tr>
                    <tr>
                        <td>{{$orderDetails['country']}}</td>
                    </tr>
                    <tr>
                        <td>{{$orderDetails['pincode']}}</td>
                    </tr>
                    <tr>
                        <td>{{$orderDetails['mobile']}}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>For any enquiries, you can contact us as at <a href="mailto:info@rayeallistic.com">info@rayeallistic.com</a></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Regards,<br> Team Rayeallistic</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
    </table>
</body>
</html>


