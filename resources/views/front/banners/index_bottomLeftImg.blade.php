<!-- banner-bottom1 -->
<div class="banner-bottom1">
    <div class="agileinfo_banner_bottom1_grids">
        <div class="col-md-7 agileinfo_banner_bottom1_grid_left"
            style="background:url({{ asset('images/banner_images/' . $getLeftImg['indexBottomLeft']) }})">
            <h3><span>{{ $getLeftImg['first'] }} <i>{{ $getLeftImg['second'] }}</i></span></h3>
            <a href="#">Shop Now</a>
        </div>
        <div class="col-md-5 agileinfo_banner_bottom1_grid_right"
            style="background:url({{ asset('images/banner_images/' . $getRightImg['rightImg']) }})">
            <h4>{{ $getRightImg['first'] }}</h4>
            <div class="timer_wrap">
                <div id="counter"> </div>
            </div>
            <script src="{{ URL('js/front_js/jquery.countdown.js') }}"></script>
            <script src="{{ URL('js/front_js/script.js') }}"></script>
        </div>
    </div>
</div>
<!-- //banner-bottom1 -->
