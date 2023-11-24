<!DOCTYPE html>
<html>
<head>
    <title>Rayeallistic</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="#" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);
        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //for-mobile-apps -->
    <link href="{{ URL('css/front_css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ URL('css/front_css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ URL('css/front_css/fasthover.css') }}" rel="stylesheet" type="text/css" media="all" />
    <!-- js -->
    <script src="{{ URL('js/front_js/jquery.min.js') }}" type="text/javascript"></script>
    <!-- //js -->
    <!-- Fonts -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <!-- /fonts -->
    <!-- countdown -->
    <link rel="stylesheet" href="{{ URL('css/front_css/jquery.countdown.css') }}" />
    <!-- //countdown -->
    <!-- cart -->
    <script src="{{ URL('js/front_js/simpleCart.min.js') }}" type="text/javascript"></script>
    <!-- cart -->
    <!-- for bootstrap working -->
    <script type="text/javascript" src="{{ URL('js/front_js/bootstrap-3.1.1.min.js') }}"></script>
    <!-- //for bootstrap working -->
    <link href='//fonts.googleapis.com/css?family=Glegoo:400,700' rel='stylesheet' type='text/css'>
    <link
        href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic'
        rel='stylesheet' type='text/css'>
    <!-- start-smooth-scrolling -->
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event) {
                event.preventDefault();
                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1000);
            });
        });
    </script>
    <!-- //end-smooth-scrolling -->
</head>
<body>
    <!--Header===================================================-->
    @include('layouts.front_layout.front_header')
    <!--/Header===================================================-->

    <!--Mid part===================================================-->
    @yield('content')
    <!--/Mid part===================================================-->
    <!--Footer=============================================-->
    @include('layouts.front_layout.front_footer')
    <!--/Footer=============================================-->
    <script src="{{ URL('js/front_js/front_script.js') }}" type="text/javascript"></script>
    <script src="{{ URL('js/front_js/jquery.validate.js') }}" type="text/javascript"></script>
    <script src="{{ URL('js/front_js/google-code-prettify/prettify.js') }}"></script>
</body>
</html>
