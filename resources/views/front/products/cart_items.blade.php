<?php use App\Models\Cart;
use App\Models\Product;
?>
<!-- checkout -->
<div class="checkout">
    <div class="container">
        <h3>Your shopping cart contains:<span class="totalCartItems">[ {{ totalCartItems() }} ] Products</span></h3>
        <div class="table-responsive">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>SL No.</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Product Name</th>
                        <th>Unit Price</th>
                        <th>Weight</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                @foreach ($userCartItems as $item)
                    <?php $attrPrice = Product::getDiscountedAttrPrice($item['product_id']); ?>
                <tbody>
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
                                    <input style="max-width: 27px; text-align:center" type="text"
                                        value="{{ $item['quantity'] }}">&nbsp;
                                    <button style="height: 27px" type="button"
                                        class="btnItemUpdate qtyMinus entry value-minus dumbbutton"
                                        data-cartid="{{ $item['id'] }}" > - </button>&nbsp;
                                    <button style="height: 27px" type="button"
                                        class="btnItemUpdate qtyPlus entry value-plus dumbbutton"
                                        data-cartid="{{ $item['id'] }}"> + </button>
                                </div>
                            </div>
                        </td>
                        <td class="invert">{{ $item['product']['product_name'] }}</td>
                        <td class="invert">{{ $attrPrice['product_price'] }}</td>
                        <td class="invert">{{ $item['product']['product_weight'] }}</td>
                        <td class="invert">
                            <div class="rem btnItemDelete" data-cartid="{{ $item['id'] }}">
                                <div style="" class="close1"></div>
                            </div>
                            <script>
                                $(document).ready(function(c) {
                                    $('.close1').on('click', function(c) {
                                        $('.rem1').fadeOut('slow', function(c) {
                                            $('.rem1').remove();
                                        });
                                    });
                                });
                            </script>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
        <!--Coupon -->
        <table class="timetable_sub">
            <tbody>
                <tr>
                    <td>
                        <form id="ApplyCoupon" method="post" action="javascript:void(0);" class="form-horizontal" @if (Auth::check()) user="1" @endif>
                            @csrf
                            <div class="control-group">
                                <label class="control-label"><strong> COUPON CODE: </strong> </label>
                                <div class="controls">
                                    <input name="code" id="code" type="text" class="input-medium"
                                        placeholder="Enter Coupon Code" required="">
                                    <button type="submit" class="btn trance"> APPLY </button>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
        <!--// Coupon -->
        <?php $total_price = 0; ?>
        <div class="checkout-left">
            <div class="checkout-left-basket">
                <h4>Overview</h4>
                <ul>
                    @foreach ($userCartItems as $item)
                    <?php $attrPrice = Product::getDiscountedAttrPrice($item['product_id']); ?>
                        <li>{{ $item['product']['product_name'] }} <i> -> </i>{{ $item['quantity'] }}x

                            <span>{{ $attrPrice['product_price'] * $item['quantity'] }}.Php </span>
                        </li>
                        <?php $total_price = $total_price + $attrPrice['final_price'] *
                        $item['quantity']; ?>
                    @endforeach
                    <li>Coupon Discount <i> -> </i>
                        <span class="couponAmount">
                            @if (Session::has('couponAmount'))
                                - {{ Session::get('couponAmount') }}.Php
                            @else
                                - 0.Php
                            @endif
                        </span>
                    </li>
                    <li class="totalbs">Total <i>-</i>
                        <span>{{ $total_price - Session::get('couponAmount') }}.Php</span></li>
                </ul>
            </div>
            <div class="checkout-right-basket">
                <a href="{{ '/' }}"><span class="" aria-hidden="true"></span>Continue Shopping</a>
            </div>
            <div class="checkout-right-basket">
                <a href="{{ 'checkout' }}"><span class="" aria-hidden="true"></span>To checkout</a>
            </div>
        </div>
    </div>
</div>
<!-- //checkout -->
