
@include('front.info.newsletter')
<!-- footer -->
<div class="footer">
    <div class="container">
        <div class="w3_footer_grids">
            <div class="col-md-3 w3_footer_grid">
                <h3>Contact</h3>
                <p>Can we do something to improve or need help? Feel free to contact us.</p>
                <ul class="address">
                    @foreach ($getInfo as $info)
                    <li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>{{$info['address']}}
                        <span>Manila.</span></li>
                    <li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a
                            href="mailto:info@example.com">{{$info['email']}}</a></li>
                    <li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>{{$info['phone']}}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-3 w3_footer_grid">
                <h3>Information</h3>
                <ul class="info">
                    <li><a href="{{URL('aboutUs')}}">About Us</a></li>
                    <li><a href="{{URL('contactUs')}}">Contact Us</a></li>
                    <li><a href="{{URL('faq')}}">FAQ's</a></li>
                </ul>
            </div>
            <div class="col-md-3 w3_footer_grid">
                <h3>Products</h3>
                <ul class="info">
                    @foreach ($randomProducts as $product)
                        <li><a href="{{ URL('product/' . $product['id']) }}">{{ $product['product_name'] }}&nbsp;from&nbsp;{{ $product['brand']['name'] }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-3 w3_footer_grid">
                <h3>Profile</h3>
                <ul class="info">
                    <li><a href="{{'/cart'}}">My Cart</a></li>
                </ul>
                <h4>Follow Us</h4>
                <div class="agileits_social_button">
                    <ul>
                        <li><a href="#" class="facebook"> </a></li>
                        <li><a href="#" class="twitter"> </a></li>
                        <li><a href="#" class="google"> </a></li>
                        <li><a href="#" class="pinterest"> </a></li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="footer-copy">
        <div class="footer-copy1">
            <div class="footer-copy-pos">
                <a href="#home1" class="scroll"><img src="{{ asset('images/front_images/arrow.png') }}" alt=" "
                        class="img-responsive" /></a>
            </div>
        </div>
        <div class="container">
            <p>&copy; 2021 Rayeallistic cosmetics | Design by Ray Corp</p>
        </div>
    </div>
</div>
<!-- //footer -->
