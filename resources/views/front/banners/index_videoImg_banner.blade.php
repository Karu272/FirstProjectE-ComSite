

    <!-- video banner -->
    <div class="col-md-5 wthree_banner_bottom_left">
        <div class="video-img" style="
    background: url({{ asset('images/banner_images/' . $getVideoImg['indexPageVideoImg']) }}); no-repeat center;
    -webkit-background-size: cover;
    background-size: cover;
    -moz-background-size: cover;
 -o-background-size: cover;
 -ms-background-size: cover;
 min-height: 455px;
    ">

<a class="play-icon popup-with-zoom-anim" href="#small-dialog">
    <span class="glyphicon glyphicon-expand" aria-hidden="true"></span>
</a>
</div>
<!-- pop-up-box -->
<link href="{{ URL('css/front_css/popuo-box.css') }}" rel="stylesheet" type="text/css" property="" media="all" />
<script src="{{ URL('js/front_js/jquery.magnific-popup.js') }}" type="text/javascript"></script>
<!--//pop-up-box -->
<div id="small-dialog" class="mfp-hide">
    <video width="320" height="240" controls>
        <source src="{{ asset('video/product_videos/received_323631985458343.mp4') }}" type="video/mp4">
    </video>
</div>
<script>
    $(document).ready(function() {
        $('.popup-with-zoom-anim').magnificPopup({
            type: 'inline',
            fixedContentPos: false,
            fixedBgPos: true,
            overflowY: 'auto',
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300,
            mainClass: 'my-mfp-zoom-in'
        });

    });

</script>
</div>
<!-- // video banner -->
